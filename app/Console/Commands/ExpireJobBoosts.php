<?php

namespace App\Console\Commands;

use App\Models\Job;
use Illuminate\Console\Command;

/**
 * ══════════════════════════════════════════════
 *  FILE LOCATION:
 *  app/Console/Commands/ExpireJobBoosts.php
 * ══════════════════════════════════════════════
 *
 *  STEP 1 — app/Console/Kernel.php তে register করুন:
 *
 *   protected $commands = [
 *       \App\Console\Commands\ExpireJobBoosts::class,
 *   ];
 *
 *   protected function schedule(Schedule $schedule): void
 *   {
 *       $schedule->command('jobs:expire-boosts')->everyMinute();
 *   }
 *
 *  STEP 2 — Server এ cron যোগ করুন (একবারই):
 *   * * * * * cd /path-to-project && php artisan schedule:run >> /dev/null 2>&1
 *
 *  STEP 3 — Manually test করতে:
 *   php artisan jobs:expire-boosts
 */
class ExpireJobBoosts extends Command
{
    protected $signature   = 'jobs:expire-boosts';
    protected $description = 'Expire boost for jobs whose boost time has passed';

    public function handle(): void
    {
        $expired = Job::where('is_boosted', true)
            ->where('boosted_until', '<=', now())
            ->update([
                'is_boosted'    => false,
                'boosted_until' => null,
            ]);

        $this->info("Expired {$expired} job boost(s) at " . now()->toDateTimeString());
    }
}