<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Continent;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\JobPost;
use App\Models\WebsiteSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Auth;


class UserJobController extends Controller
{
    // ── GET /user/create-job ──────────────────────────────────────────
    public function create()
    {
        return view('user.jobs.create');
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
            'thumbnail'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'has_secret_code'=> 'boolean',
            'secret_code'    => 'required_if:has_secret_code,1|nullable|string|max:100',
            'proofs'         => 'required|array|min:1',
            'proofs.*.type'  => 'required|in:text,image',
            'proofs.*.label' => 'required|string|max:255',
        ]);
        
        //fetch subcategory price
        $subcategory = SubCategory::where('id',$request->subcategory_id)->first();
        $each_work_price = $subcategory->minimum_cost;
        
        $worker_need = $request->worker_need;
        $cost = $worker_need*$each_work_price;
        
        //fetch job post charge
        $setting = WebsiteSetting::first();
        $charge = $setting->jobpost_charge;
        $total_charge = ($cost*$charge)/100;

        $total_cost_with_charge = $cost+$total_charge;

        


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')
                ->store('job-thumbnails', 'public');
        }
        
        $user = auth::user();

        $job = JobPost::create([
            'user_id'        => $user->id,
            'continent_id'   => $request->continent_id,
            'country_id'     => $request->country_id,
            'category_id'    => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'title'          => $request->title,
            'code'          =>  strtoupper(Str::random(8)),
            'slug'           => str_replace(' ', '-', $request->title),
            'description'    => $request->description,
            'thumbnail'      => $thumbnailPath,
            'worker_need'    => $request->worker_need,
            'budget'         => $cost,
            'worker_earn'    => $each_work_price,
            'has_secret_code'=> $request->boolean('has_secret_code'),
            'secret_code'    => $request->boolean('has_secret_code') ? $request->secret_code : null,
            'proofs'         => $request->proofs,
            'status'         => 'active',
        ]);


        return back()->with('message','Job posted successfully and pendign for approval');

        // return response()->json([
        //     'message' => 'Job posted successfully!',
        //     'job'     => $job->load(['continent', 'country', 'category', 'subcategory']),
        // ], 201);
    }

    // my jobs
    public function myjobs(){
        return view('user.my_jobs');
    }

    // find jobs
    public function findjobs(){
        return view('user.find_jobs');
    }
   // finished jobs
    public function finishedjobs(){
        return view('user.finished_job');
    }
   // browse deal
   public function browsedeal(){
        return view('user.browse_deal'); 
    }

 // deal create

 public function dealcreate(){
    return view('user.deal_create'); 
    }

// my deal post
  public function mydealpost(){
    return view('user.my_deal_post'); 
    }

// dealorder
public function dealorder(){
    return view('user.deal_order'); 
    } 
// add deposit
public function adddeposit(){
    return view('user.deposit'); 
    }

// deposithistory
public function deposithistory(){
    return view('user.deposit_history'); 
    }

}