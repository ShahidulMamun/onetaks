<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Continent;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\JobPost;
use App\Models\WebsiteSetting;
use App\Models\UserNotification;
use App\Models\UserTransaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Auth;


class UserJobController extends Controller
{
    // ── GET /user/create-job ──────────────────────────────────────────
    public function create()
    {
        $setting = WebsiteSetting::first();
        return view('user.jobs.create',compact('setting'));
    }

    // ── GET /user/continents ──────────────────────────────────────────
    public function continents(): JsonResponse
    {
        $continents = Continent::where('is_active', true)
            ->withCount('countries as country_count')
            ->orderBy('name')
            ->get(['id', 'name', 'code', 'emoji'])
            ->map(function ($c) {
                $c->name  = strip_tags($c->name);
                $c->code  = strtoupper(strip_tags($c->code));
                $c->emoji = $c->emoji ?: '';
                return $c;
            });

        return response()->json($continents);
    }

    // ── GET /user/continents/{id}/countries ───────────────────────────
    public function countries(int $id): JsonResponse
    {
        $continent = Continent::findOrFail($id);

        $countries = $continent->countries()
            ->get(['id', 'name', 'code'])
            ->map(function ($c) {
                $c->name = strip_tags($c->name);
                $c->code = strtoupper(strip_tags($c->code));
                return $c;
            });

        return response()->json($countries);
    }

    // ── GET /user/job-categories ──────────────────────────────────────
    public function categories(): JsonResponse
    {
        $categories = Category::where('is_active', true)
            ->withCount('subcategories as sub_count')
            ->orderBy('name')
            ->get(['id', 'name'])
            ->map(function ($c) {
                $c->name = strip_tags($c->name);
                return $c;
            });

        return response()->json($categories);
    }

    // ── GET /user/job-categories/{id}/subcategories ───────────────────
    public function subcategories(int $id): JsonResponse
    {
        $category = Category::findOrFail($id);

        $subs = $category->subcategories()
            ->get(['id', 'name', 'minimum_cost'])
            ->map(function ($s) {
                $s->name = strip_tags($s->name);
                return $s;
            });

        return response()->json($subs);
    }

    public function store(Request $request)
    {
        
         // return $request->all();
        $validator = Validator::make($request->all(), [
            'continent_id'   => 'required|exists:continents,id',
            'country_id'     => 'required|exists:countries,id',
            'category_id'    => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:sub_categories,id',
            'title'          => 'required|string|max:255',
            'description'    => 'required|string',
            'worker_need'    => 'required|integer|min:1',
            'thumbnail'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:1024',
            'has_secret_code'=> 'boolean',
            'secret_code'    => 'required_if:has_secret_code,1|nullable|string|max:20',
            'proofs'         => 'required|array|min:1',
            'proofs.*.type'  => 'required|in:text,file',
            'proofs.*.label' => 'required|string|max:255',
        ]);
        
        //validation fail message error
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        //fetch subcategory price
        $subcategory = SubCategory::findOrFail($request->subcategory_id);

        if (!$subcategory) {
          return  back()->with('error','Invalid Category');
        }

        $each_work_price = $subcategory->minimum_cost;
        
        $worker_need = $request->worker_need;
        $cost = $worker_need*$each_work_price;
        
        //fetch job post charge
        $setting = WebsiteSetting::first();
        $charge = $setting->jobpost_charge;
        $total_charge = ($cost*$charge)/100;

         $total_cost_with_charge = $cost+$total_charge;

         $user = Auth::user();

         $deposit = $user->current_deposit;

         if ($total_cost_with_charge>$deposit){
            return  back()->with('error','You have not enough deposit');
         }



        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')
                ->store('job-thumbnails', 'public');
        }

        $job = JobPost::create([
            'user_id'        => $user->id,
            'continent_id'   => $request->continent_id,
            'country_id'     => $request->country_id,
            'category_id'    => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'title'          => $request->title,
            'code'           =>  strtoupper(Str::random(10)),
            'slug'           => str_replace(' ', '-', $request->title),
            'description'    => $request->description,
            'thumbnail'      => $thumbnailPath,
            'worker_need'    => $request->worker_need,
            'worker_remaining'=> $request->worker_need,
            'budget'         => $cost,
            'worker_earn'    => $each_work_price,
            'charge_percentage'=>$charge,
            'has_secret_code'=> $request->boolean('has_secret_code'),
            'secret_code'    => $request->boolean('has_secret_code') ? $request->secret_code : null,
            'proofs'         => $request->proofs,
        ]);

        if($job){
          $user->decrement('current_deposit', $total_cost_with_charge);
            
            $message = "$".$total_cost_with_charge." has been deducted for job posting (including charge).";
            UserNotification::create([
                'user_id' => $user->id,
                'message' => $message,
                'status'  => 'pending',
            ]);


             UserTransaction::create([
            'user_id' => $user->id,
            'transaction_id' => strtoupper(uniqid()),
            'type' => "charge",
            'amount' => $total_cost_with_charge,
            'description' => "Job post cost(including charge)",
            'reference_id' => $job->id,
            'status' => 'success',
           ]);
         }


        return back()->with('success','Job posted successfully and pending for approval');

    }

    // my jobs
    public function myjobs(){
        $jobs =  JobPost::where('user_id',Auth::user()->id)->get();
        return view('user.my_jobs',compact('jobs'));
    }

    // find jobs
    public function findjobs(){

        $jobs = JobPost::where('status','active')->orderBy('created_at','desc')->get();
        return view('user.dashboard',compact('jobs'));
    }

    // job details
  public function details($code){
        
        $job = JobPost::where('code',$code)->first();

        //status check
        $status = $job->status;
        if ($status !== 'active') {

           return back()->with('error','This job not active');
        }

        //remaining worker check
        if ($job->worker_remaining==0) {
           return back()->with('error','This job is already complete');
        }

        return view('user.jobs.details',compact('job'));
    }

   // finished jobs
    public function finishedjobs(){
        return view('user.finished_job');
    }
  

}