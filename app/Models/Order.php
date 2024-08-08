<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $fillable = ['status'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function courier()
    {
        return $this->belongsTo(Courier::class);
    }
}
