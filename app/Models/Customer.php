<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Customer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

}
