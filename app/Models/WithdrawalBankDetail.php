<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawalBankDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'withdrawal_id',
        'user_id',
        'bank',
        'branch',
        'ifsc',
        'account_num',
        'holder_name',
    ];

    public function withdrawal()
    {
        return $this->belongsTo(Withdrawals::class);
    }
}
