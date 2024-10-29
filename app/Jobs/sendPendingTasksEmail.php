<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class sendPendingTasksEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $pendingTasks = $this->user->tasks()->where('status', 'Pending')->get();
       

            if ($pendingTasks->isNotEmpty()) {
                Mail::send('emails.pendingTasks', ['user' => $this->user, 'tasks' => $pendingTasks], function ($message) {
                    $message->to($this->user->email)
                            ->subject('قائمة المهام المعلقة');
                });
            }
        
    }
}
