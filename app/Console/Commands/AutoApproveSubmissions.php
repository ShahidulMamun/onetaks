<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\JobSubmit;
use App\Models\UserNotification;
use App\Models\UserTransaction;

class AutoApproveSubmissions extends Command
{
    protected $signature   = 'submissions:auto-approve';
    protected $description = 'Auto approve pending submissions older than 7 days';

    public function handle()
    {
        $submissions = JobSubmit::with(['job', 'user'])
            ->where('status', 'pending')
            ->where('created_at', '<=', now()->subDays(7))
            ->get();

        if ($submissions->isEmpty()) {
            $this->info('No submissions to auto-approve.');
            return;
        }

        $count = 0;

        foreach ($submissions as $submission) {
            $job = $submission->job;

            if (!$job) continue;

            // Proof images delete
            if (!empty($submission->proof_image)) {
                $images = is_array($submission->proof_image)
                    ? $submission->proof_image
                    : json_decode($submission->proof_image, true);

                if (is_array($images)) {
                    foreach ($images as $image) {
                        Storage::disk('public')->delete($image);
                    }
                }
            }

            DB::transaction(function () use ($submission, $job) {
                $submission->update([
                    'status'      => 'approved',
                    'approved_at' => now(),
                ]);

                $submission->user->increment('total_earning',   $job->worker_earn);
                $submission->user->increment('current_earning', $job->worker_earn);
            });

            UserNotification::create([
                'user_id' => $submission->user_id,
                'title'   => 'Submit job auto-approved',
                'message' => 'Your submission for job ' . $job->code . ' has been automatically approved after 7 days.',
                'status'  => 'pending',
            ]);

            UserTransaction::create([
                'user_id'        => $submission->user_id,
                'transaction_id' => strtoupper(uniqid()),
                'type'           => 'earning',
                'amount'         => $job->worker_earn,
                'description'    => 'Auto-approved earning from job submit',
                'reference_id'   => $job->id,
                'status'         => 'success',
            ]);

            $count++;
        }

        $this->info("Auto-approved {$count} submission(s).");
    }
}