<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductSize extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function size() {
        return $this->belongsTo(Size::class, 'size_id');
    }
}
