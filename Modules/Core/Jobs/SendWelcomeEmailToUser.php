<?php

namespace Modules\Core\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\SentMessage;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use Modules\User\Emails\WelcomeEmail;

class SendWelcomeEmailToUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public User|Model $user) {}

    /**
     * Execute the job.
     *
     * @return SentMessage|null
     */
    public function handle()
    {
        $user = $this->user;

        return Mail::to($user->email)
            ->send(new WelcomeEmail($user));
    }
}
