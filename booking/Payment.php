<?php
//include 'inc/head.php';
namespace Payment;
use Omnipay\Omnipay;
class Payment

{

   /**

    * @return mixed

    */

   public function gateway()

   {

       $gateway = Omnipay::create('PayPal_Express');

       $gateway->setUsername("peterwang65131@gmail.com");
       $gateway->setPassword("AUHEwRUdVjsmpy_9BuxZsminsGvehsKnRcVls3nYWYLApgEXeBPh3JJA8uvj74EqY4fr2d5u3Nn5NgFJ");
       $gateway->setSignature("EE0ySxzqtVjIJY4TER21OepVGqriDvSwwKVt34CiR9pvVrOttc--gMLg_5bFM-7m9Qy8bI9II1RF-qD0");
       $gateway->setTestMode(true);
       return $gateway;
	   
	    /*$gateway = Omnipay::create('PayPal_Express');

       $gateway->setUsername("sb-xb1bt19114795@business.example.com");
       $gateway->setPassword("Aaoh8_YZUuuutlCmnWk8gpYIbWhdjVKzMHB1H3T_AgJ-Gk458WObGTTFHeLm2eysEWAyFmrPTaKOvUaX");
       $gateway->setSignature("EGZytk8102RHCG1xCGnF6IVJ7ydPxNyuZg_Dyboeea_dGqzVfx9dQmZ-y2sBgaCrBYdYS0B8AD3LnQ9U");
       $gateway->setTestMode(true);
       return $gateway;*/

   

   }

   /**

    * @param array $parameters

    * @return mixed

    */

   public function purchase(array $parameters)

   {

       $response = $this->gateway()
           ->purchase($parameters)
           ->send();

       return $response;

   }

   /**

    * @param array $parameters

    */

   public function complete(array $parameters)

   {

       $response = $this->gateway()
           ->completePurchase($parameters)
           ->send();

       return $response;
   }

   /**

    * @param $amount

    */

   public function formatAmount($amount)

   {
       return number_format($amount, 2, '.', '');
   }

   /**

    * @param $order

    */

   public function getCancelUrl($order = "")

   {
       return $this->route('https://www.xjwmobilemassage.com.au/app/booking/cancel.php', $order);
   }

   /**

    * @param $order

    */

   public function getReturnUrl($order = "")

   {

       return $this->route('https://www.xjwmobilemassage.com.au/app/booking/payment_success.php', $order);
   }

   public function route($name, $params)

   {
       return $name; // ya change hua hai
   }
}