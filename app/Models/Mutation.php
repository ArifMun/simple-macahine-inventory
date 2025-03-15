<?php

namespace App\Models;

use App\Models\Machine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mutation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = ['id'];
    protected $table = 'mutations';

    public function machine()
    {
        return $this->belongsTo(Machine::class, 'barcode_id', 'barcode_id');
    }
}
