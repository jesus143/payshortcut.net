<?php

namespace App;

use Illuminate\Database\Eloquent\Model;  

class BillingUpgradeLevel extends Model
{ 
 	protected $table = 'billing_upgrade_levels';  
 	protected $fillable = [ 'email', 'level', 'order_id', 'status' ];  
}