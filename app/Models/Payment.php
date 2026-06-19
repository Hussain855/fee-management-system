<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    public $timestamps = false;
    protected $fillable = [
        'fee_due_id', 'student_id', 'amount_paid',
        'payment_date', 'payment_method', 'is_partial'
    ];

    public function feeDue()
    {
        return $this->belongsTo(FeeDue::class, 'fee_due_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function receipt()
    {
        return $this->hasOne(Receipt::class, 'payment_id');
    }
}