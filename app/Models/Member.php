<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'name', 'phone', 'email', 'address',
        'gender', 'birthdate', 'join_date',
        'membership_plan_id', 'status',
        'start_date', 'end_date', 'member_code',

    ];

    public function membershipPlan()
    {
        return $this->belongsTo(MembershipPlan::class);
    }

    public function scopeExpired($query)
    {
        return $query->whereDate('end_date', '<=', now());
    }


}
