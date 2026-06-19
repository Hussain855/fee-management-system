<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{
    protected $table = 'fines';
    public $timestamps = false;
    protected $fillable = [
        'fee_due_id', 'student_id', 'fine_amount', 'reason', 'applied_date'
    ];

    public function feeDue()
    {
        return $this->belongsTo(FeeDue::class, 'fee_due_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}