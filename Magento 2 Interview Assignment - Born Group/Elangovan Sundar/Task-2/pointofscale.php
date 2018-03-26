<?php
/*
Module : Point of scale
Author : Elangovan.Sundar
*/

ini_set('display_errors', 1);

class Store{

	public $productList =	array( 
		"A" => array("1" => '2', "4" => '7'),
		"B" => array("1" => '12'),
		"C" => array("1" => '1.25',"6"=>'6'),
		"D" => array("1" => '0.15')
	);

	public $totalPrice = 0;
	
	//Scan the input string
	public function scan($scanParam=""){
		$countString = array();
		$stringCountArray = $this->count_duplicate_char($scanParam);
		return $stringCountArray;
	}

	//set the price function
	public function setPricing($scanArray=""){
		$cnt = 0; 
		foreach($scanArray  as $key => $strCntValue){
			if($key == "A"){
				$restrictValue='4';
			}else if($key == "C"){
				$restrictValue='6';
			}else {
				$restrictValue='0';
			}
			$cnt = $this->scaleCalculation($strCntValue,$restrictValue,$key);
			$this->totalPrice += $cnt; 
		}
	}

	public function count_duplicate_char($str) {
		$formatted = implode(' ', str_split($str));
		$a = explode(" ",$formatted); 
		$vals = array_count_values($a);
		return $vals; 
	}

	//Calclaution of point of scale 
	public function scaleCalculation($strCntValue,$restrictValue,$key){
		$count  = 0;		
		$firstElementKey=$secondElementKey="";

		$arraykeyCount	= array_keys($this->productList[$key]);

		if(count($arraykeyCount)>1){
			list($firstElementKey,$secondElementKey) = array_keys($this->productList[$key]);
		}else{
			list($firstElementKey) = array_keys($this->productList[$key]);			
		}

		if(!empty($restrictValue)){	
			$amod = $strCntValue % $restrictValue;
			$eachVal = $strCntValue % intval($restrictValue);
			$groupVal = ($strCntValue-$eachVal) / intval($restrictValue);

			$totalValue = ($this->productList[$key][$firstElementKey]*$eachVal)+ ($this->productList[$key][$secondElementKey]*$groupVal); 
			$count += $totalValue;
		} else {
			$totalValue = ($this->productList[$key][$firstElementKey]*$strCntValue);
			$count += $totalValue;
		}

		return $count;
	}

	//Get the total
	public function total(){
 		return $this->totalPrice;
 	}
}


$terminal  = new Store;

$scanArray = $terminal->scan("AAAA");
$terminal->setPricing($scanArray);

echo "Verify the total price is::&nbsp;<strong>".$terminal->total()."</strong>";