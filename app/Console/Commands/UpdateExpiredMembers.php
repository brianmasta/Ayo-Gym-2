<?php

namespace App\Console\Commands;

use App\Models\Member;
use Illuminate\Console\Command;

class UpdateExpiredMembers extends Command
{
    protected $signature = 'members:update-expired'; // Ini nama perintahnya
    protected $description = 'Update members status to inactive if expired';


    public function handle()
    {
        // Update semua member yang expired
        Member::where('status', 'active')
            ->where('end_date', '<', now())
            ->update(['status' => 'inactive']);

        $this->info('Expired members updated successfully.');
    }
}
