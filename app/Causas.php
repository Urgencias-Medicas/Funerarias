<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Causas extends Model
{
    protected $table = 'causas';
    public $fillable = ['Causa'];
    public $timestamps = false;
}
