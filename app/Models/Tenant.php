<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name' ,
        'user_id',
        'domain',
        'database_name' ,
        'database_username' ,
        'database_password',
    ];


}


