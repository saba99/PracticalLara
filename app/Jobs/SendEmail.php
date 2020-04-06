<?php

namespace App\Jobs;

use App\Services\Notification\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\User;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

     private $user;

     private $mailable;

    public function __construct(User $user,Mailable $mailable)
    {
        $this->user=$user;

        $this->mailable=$mailable;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Notification $notification)
    {
       return $notification->sendEmAIL($this->user,$this->mailable);
    }
}
