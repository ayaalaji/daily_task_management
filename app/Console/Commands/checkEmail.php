<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Console\Command;
use App\Jobs\sendPendingTasksEmail;
use Illuminate\Support\Facades\Log;

class checkEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check email every day to see the tasks that still Pending';

    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $time = Carbon::now();
        $now = $time->addHours(3);
        Log::info('the current Hour is: '.$now->toDateTimeString());
        $users = User::all();
        foreach($users as $user)
        {
            $email =$user->email;
            Log::info('information: '.$user->email);
            sendPendingTasksEmail::dispatch($user);
            $this->info('تم إرسال الإيميلات بنجاح.');
        }
    }
}
