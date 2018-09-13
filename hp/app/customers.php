<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customers extends Model
{
    //
    protected $primaryKey = 'cus_id';
    protected $table = 'customers';
    protected $Key = 'pro_id';
    protected $fillable = ['cus_name','pro_id'];
    #protected $

    #$proid = App\programs::find(1);
}
