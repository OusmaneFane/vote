<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Address;



class Student extends Model
{
    use HasFactory;
    protected $fillable = ['matricule', 'password'];
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}
