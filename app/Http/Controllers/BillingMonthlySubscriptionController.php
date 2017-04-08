<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BillingCycleBatch; 
use App\BillingUpgradeLevel; 
use App\Member; 
use App\Order;
use Carbon\Carbon; 
use Mail;
use Log; 


class BillingMonthlySubscriptionController extends Controller
{  
 	public function BillingMonthlySubscriptionTrigger()
 	{   

 		// get settings
	    $orderInfoSendright = config('settings.orderInfoSendright'); 
		$globalContent      = config('settings.globalContent'); 


 		// get batch
		$billingCycleBatch = BillingCycleBatch::first();  

 		// compose batch for limit start and limit end  		
 	    $limit_start  =   getLimitStart($billingCycleBatch->batch, 10); 
 	    $limit_end    =  getLimitEnd($billingCycleBatch->batch, 10);   
 
 	    print "\n batch " . $billingCycleBatch->batch ;
 	    print "\n limit start " . $limit_start ;
 	    print "\n limit end " . $limit_end ;

 		// query user based on limit 
		$members = Member::skip($limit_start)->take($limit_end)->get();



        // get specific member subscription latest
		$order = new Order(); 
		$now = Carbon::now();
		print "\n date now " . human_readable_date_time($now); 
		print "\n-------------------------- \n";
 
		foreach($members as $member) {  
			print " \n member id  " . $member->id;
			print " \n name " . $member->first_name;
			print " \n name " . $member->email;
			// get latest subscription
			 $latestSubscription = Order::getMemberOrderByTitle($member->id, $globalContent['product_sendright_title']);     
			 // print_r_pre($latestSubscription, "latest subscription");  
			 // print "\n total results " . count($latestSubscription);  
	 		// check if already 1 month  
		 	if(count($latestSubscription) > 1) {    

		 		// check if already deactivated
		 		if($latestSubscription['status'] != 'deactivated') {  
				 	$subscriptionDate = createDateTimeCarbon($latestSubscription['created_at']); 
				 	$nextMonth = $subscriptionDate->addMonths(1);  
	 				print "\n latest order id " . $latestSubscription['id']; 
		 			print "\n last subscribed date " . human_readable_date_time($latestSubscription['created_at']); 
		 			print "\n next date billing  " . human_readable_date_time($nextMonth);  

				 	// if already passed 1 month from last subscription
				 	if($now > $nextMonth) {   

			        	// if so check level upgrade 
				 		$billingUpgrade = BillingUpgradeLevel::where('order_id', $latestSubscription['id'])->where('email', $member->email)->where('status', 'active')->first();  
				 			
				 		  
				
 
				 			// exit;
				 		// get new billing upgrade 
				 		if(count($billingUpgrade) > 0) {    

				 			print "\n upgrade level found";
							print "\n upgrade to level " . $billingUpgrade->level; 
				 			$orderUpgrade 				 =	$orderInfoSendright['level'][$billingUpgrade->level]; 
				 			$latestSubscription['title'] =  $orderUpgrade['title']; 
				 			$latestSubscription['amt']   =  $orderUpgrade['price'];  
				 		} else { 
				 			print "\n no upgrade level";
				 		} 
	 
				 	    // compose order information and member information    
			 			$newOrder = Order::composeNewOrder($latestSubscription);

						// trigger spgateway order via curl  
				 		$newOrderSpgateway = Order::triggerSpgatewayAgreedBill($newOrder, $member, $globalContent);  

				 		// print "spgateway response";
				 		// print_r($newOrderSpgateway); 
  
				 		// if success do insert new order and subscription as renew 
						$status =  strtolower($newOrderSpgateway['Status']);  
						print "\n agreed payment spgateway trigger payment status  " . $status; 
				 		if($status == 'success' || $status == 'Success')   {    
			  				// save new order  
				 			Order::create($newOrder); 
			 			}  else {     
			 				$data = ['response'=>$newOrderSpgateway, 'member'=>$member]; 
			 				// send email to admin that there is error in trigger new payment 
			 				// 	Mail::send('pages/email/billing-failed', $data,  function ($message) {
							//     $message->from('noreply@payshortcut.net', 'payshortcut'); 
							//     $message->to('mrjesuserwinsuarez@gmail.com'); 
							// });  
			 				// record to a log as warning, error from trigger new payment
							Log::warning("Error trigger payment billing monthly cycle response spgateway agreed  order id " . $latestSubscription['id']  . ' member id '  . $member->id. ' file ' . __file__   );  

					    }   
					}  else {
						print "\n not time to trigger next payment ";
					}  
				} else {
					print "\n subscription is deactivated status";
				}
			} else {
				print "\n no subscription"; 
			}

			print "\n ------------------------------------";
		}  
		
		print "\n....finished...";
		// increment batch 
		 
		if(count($members) > 0) { 
		 	BillingCycleBatch::increment('batch');
		} else {
			BillingCycleBatch::where('id', 1)->update(['batch'=>0]);
		}
 	}  
}
