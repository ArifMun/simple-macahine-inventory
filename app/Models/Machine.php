<?php

namespace App\Models;

use App\Models\Type;
use App\Models\Brand;
use App\Models\Mutation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Machine extends Model
{
    use HasFactory;
    protected $primaryKey = 'barcode_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'barcode_id',
        'name',
        'status',
        'brand_id',
        'type_id',
    ];
    protected $table = 'machines';

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function mutation()
    {
        return $this->hasMany(Mutation::class, 'barcode_id', 'barcode_id');
    }
    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id', 'id');
    }
}
