<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillingCycleBatch extends Model
{

    protected $table = 'billing_cycle_batches';    
    
    protected $fillable = ['batch'];   

}
