<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeeStructure extends Model
{
    protected $table = 'fee_structure';
    public $timestamps = false;
    protected $fillable = [
        'class_id', 'term_id', 'tuition_fee',
        'lab_fee', 'library_fee', 'sports_fee', 'total_amount'
    ];

    public function classModel()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public function term()
    {
        return $this->belongsTo(Term::class, 'term_id');
    }

    public function feeDues()
    {
        return $this->hasMany(FeeDue::class, 'fee_structure_id');
    }
}