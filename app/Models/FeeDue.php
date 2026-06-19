<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeeDue extends Model
{
    protected $table = 'fee_dues';
    public $timestamps = false;
    protected $fillable = [
        'student_id', 'fee_structure_id', 'term_id',
        'amount_due', 'amount_paid', 'outstanding_balance', 'status'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function feeStructure()
    {
        return $this->belongsTo(FeeStructure::class, 'fee_structure_id');
    }

    public function term()
    {
        return $this->belongsTo(Term::class, 'term_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'fee_due_id');
    }

    public function fines()
    {
        return $this->hasMany(Fine::class, 'fee_due_id');
    }
}