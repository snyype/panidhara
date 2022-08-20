<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meter extends Model
{
    public $table="meters";
    use HasFactory;
    protected $fillable = ['user_id','user_name','status','unit'];
}
