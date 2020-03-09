<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $table="diary";
    protected $primaryKey="pk";
    public $timestamps = false;
}
