<?php

namespace App\Console\Commands;

use App\Models\Scheduler;
use App\Notifications\SendDatabaseNotification;
use App\Notifications\SendEmailNotification;
use Illuminate\Console\Command;

class SendNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notifications';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $schedulers = Scheduler::ready()->get();

        /** @var Scheduler $scheduler */
        foreach ($schedulers as $scheduler) {
            if ($scheduler->channel === 'mail') {
                // Send email notification
                $scheduler->notify(new SendEmailNotification($scheduler));
                // Notification::route('mail', $scheduler->email)->notify(new SendEmailNotification($scheduler));
            } elseif ($scheduler->channel === 'database') {
                // Send database notification
                $scheduler->notify(new SendDatabaseNotification($scheduler));
            }

            $scheduler->update(['sent_at' => now()]);
        }

        $this->info('Notifications sent successfully.');

        return Command::SUCCESS;
    }
}
