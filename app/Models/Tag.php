<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\PostDec;

class Tag extends Model
{
    protected $fillable = ['name'];
}
