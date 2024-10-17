<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;

class UserDisable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:disable';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'auto disable user after specific date and time';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = User::get();
        $now = Carbon::now(); // Get the current date and time

        foreach ($user as $key => $value)
        {            
            $created_at = $value->created_at;
            $daysDifference = $created_at->diffInDays($now);

            if($daysDifference >= 120)
            {
                $value->delete();
            }
        }
    }
}
