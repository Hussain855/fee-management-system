<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $table = 'receipts';
    public $timestamps = false;
    protected $fillable = [
        'payment_id', 'student_id', 'receipt_number',
        'issue_date', 'total_paid'
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}