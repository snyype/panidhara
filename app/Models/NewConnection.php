<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewConnection extends Model
{
    use HasFactory;
    public $table="newconnection";
    protected $fillable = ['user_id','user_name','name','address','number','citizenship_number','house_number','status'];
}
 