<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class programs extends Model
{
    //
    protected $primaryKey = 'pro_id';
    protected $table = 'programs';
    protected $Key = 'cus_id';
    protected $fillable = ['cus_id'];


}
