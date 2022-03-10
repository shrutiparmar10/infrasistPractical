<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table="employees";
    protected $fillable=[
        'id','name','email','mobile_number','country_id','state_id','city_id',
        'address_line1','address_line2','postal_code','area_of_interest','image'
    ];
}
