<?php
class Products
{
  private $name;
  private $volume_prices;
  private $totalPrice;

  public function __construct() {
		$this->volume_prices = array();
		$this->name =array();
		$this->totalPrice = 0;
  }	
  /* set the Product Price*/
  public function setproductPricing($product_name,$unitprice,$volprice= array()) 
  {
	if($volprice){
		foreach ($volprice as $number_of_items => $price) {
		   $this->volume_prices[$product_name][$number_of_items] = $price;
		}
	}
	$this->volume_prices[$product_name][1] = $unitprice;
		
  }
  /* Calculate the total product price*/
  public function calculate($products)
  {
	  $price = 0;
	  foreach ($products as $key => $count) {
		  if(count($this->volume_prices[$key]) > 1)
		  {
			  $value = reset($this->volume_prices[$key]);
			  $first_key = key($this->volume_prices[$key]);
			  $price = $this->calculatePrice($this->volume_prices,$key,$count,$first_key);
		  }
		  else
		  {
			  $price =  $this->calculatePrice($this->volume_prices,$key,$count);
		  }
	  }
	  return $price;
		
  }
   /* Calculate each product price*/
  public function calculatePrice($definedPrice,$key,$value,$divider=0){
 		if($divider){
			$eachVal = $value % intval($divider);
			$groupVal = ($value-$eachVal) / intval($divider);
			$this->totalPrice = $this->totalPrice + ($definedPrice[$key][1] * $eachVal);
			$this->totalPrice = $this->totalPrice + ($definedPrice[$key][$divider] * $groupVal);	
 		}else{
 			$this->totalPrice = $this->totalPrice + ($definedPrice[$key][1] * $value);
 		}
		return $this->totalPrice;
 }
  /*Get the Product Count*/	
  public function getProductCount($products_name)
  {
	  foreach (count_chars($products_name, 1) as $name => $value) {
		  $this->name[chr($name)] = $value;
	  }
	  return $this->name;
  }
}
?>