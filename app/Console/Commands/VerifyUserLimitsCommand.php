<?php

namespace App\Console\Commands;

use App\Mail\LimitExceededMail;
use App\Models\Stat;
use App\Models\User;
use App\Models\Website;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class VerifyUserLimitsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:verify-user-limits';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verify the user limits';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = Carbon::now();

        foreach (User::where('has_websites', '=', 1)->cursor() as $user) {
            // Get the total pageviews count of user's account for the required period
            $pageviews = Stat::where('name', '=', 'pageviews')
                ->whereIn('website_id', Website::select('id')->where('user_id', '=', $user->id))
                ->whereBetween('date', [(clone $now)->startOfMonth(), (clone $now)->endOfMonth()])
                ->sum('count');

            // If the pageviews have exceeded the user's current limits
            if ($user->plan->features->pageviews != -1 && $pageviews >= $user->plan->features->pageviews) {
                // If the user's tracking was not previously disabled
                if ($user->can_track) {
                    $user->can_track = false;
                    $user->save();

                    // If the website & the user has the option to be emailed when the plan exceeds the limits
                    if ($user->email_account_limit) {
                        // Send out the email
                        try {
                            Mail::to($user->email)->locale($user->locale)->send(new LimitExceededMail());
                        } catch (\Exception $e) {}
                    }
                }
            } else {
                // If the user's tracking was not previously enabled
                if (!$user->can_track) {
                    $user->can_track = true;
                    $user->save();
                }
            }
        }

        return 0;
    }
}
