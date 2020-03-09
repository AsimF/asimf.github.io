<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Username extends Model
{
    protected $table="users";
    protected $primaryKey="pk";
    public $timestamps = false;
}