<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repo extends Model
{
    protected $fillable = ['name', 'owner', 'status'];
}
