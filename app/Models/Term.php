<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $table = 'terms';
    public $timestamps = false;
    protected $fillable = ['name', 'start_date', 'end_date', 'due_date'];

    public function feeStructures()
    {
        return $this->hasMany(FeeStructure::class, 'term_id');
    }

    public function feeDues()
    {
        return $this->hasMany(FeeDue::class, 'term_id');
    }
}