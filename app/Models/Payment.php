<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'member_id',
        'non_member_id',
        'member_code',
        'membership_plan_id',
        'amount',
        'method',
        'payment_date', 'order_id', 'midtrans_transaction_id','payment_type','raw_response',
    ];
    
    public function membershipPlan()
    {
        return $this->belongsTo(MembershipPlan::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function nonMember()
    {
        return $this->belongsTo(NonMember::class);
    }
}
