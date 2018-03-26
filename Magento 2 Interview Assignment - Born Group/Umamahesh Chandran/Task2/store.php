<?php 
class Store { 

    
    function setPricing($product, $pricevalue, $pricecount=0, $prodprice){
    	if($product == 'A') {
         	$this->priceprodA = $pricevalue;
         	$this->pricecountA = $pricecount;
         	$this->packpriceA = $prodprice;
    	}

        else if($product == 'B') {
         	$this->priceprodB = $pricevalue;
         	$this->pricecountB = $pricecount;
         	$this->packpriceB = $prodprice;
    	}
        else if($product == 'C') {
         	$this->priceprodC = $pricevalue;
         	$this->pricecountC = $pricecount;
         	$this->packpriceC = $prodprice;
        }
        else if($product == 'D') {
         	$this->priceprodD = $pricevalue;
         	$this->pricecountD = $pricecount;
         	$this->packpriceD = $prodprice;
        }

      }

	
	public function productprice($prod){
		if($prod == 'A') $price = $this->priceprodA;
		else if($prod == 'B') $price =  $this->priceprodB;
		else if($prod == 'C') $price =  $this->priceprodC;
		else if($prod == 'D') $price =  $this->priceprodD;
		return $price;

	}

	public function restrictionmode($prod){
		if($prod == 'A') {
			if($this->pricecountA > 1)
				$mode = 1; else $mode = 0;
		}
		else if($prod == 'B') {
			if($this->pricecountB > 1)
				$mode = 1; else $mode = 0;
		}
		else if($prod == 'C') {
			if($this->pricecountC > 1)
				$mode = 1; else $mode = 0;
		}
		else if($prod == 'D') {
			if($this->pricecountD > 1)
				$mode = 1; else $mode = 0;
		}
		return $mode;

	}
	public function restrictioncount($prod){
		if($prod == 'A') $count = $this->pricecountA;
		else if($prod == 'B') $count = $this->pricecountB;
		else if($prod == 'C') $count = $this->pricecountC;
		else if($prod == 'D') $count = $this->pricecountD;
		
		return $count;

	}

	public function restrictedprice($prod){
		if($prod == 'A') $packprice = $this->packpriceA;
		else if($prod == 'B') $packprice = $this->packpriceB;
		else if($prod == 'C') $packprice = $this->packpriceC;
		else if($prod == 'D') $packprice = $this->packpriceD;
		return $packprice;

	}

	public function calctotal($price=0,$restrictionmode=0,$restrictioncount=0,$prodcount=0,$restrictedprice=0){		

		if ($restrictioncount !=0) {
			$balance = intval($prodcount % $restrictioncount);
		}

		if($prodcount < $restrictioncount || $restrictionmode == 0 ) {
			$total = $prodcount * $price;

		} else if($balance == 0 || $balance != 0) {
			$quotient = intval($prodcount / $restrictioncount);
			if($balance == 0) {
				
				$total = abs($restrictedprice * $quotient) ;
			} else {
				 
				$total = abs(($restrictedprice * intval($quotient)) + ($price * $balance)) ;

			}	
					

		}

		return $total;	
	}

	public function arraycount($value){

			$arraysplit = str_split($value);
			$prodarray = array_values($arraysplit);
			$prodcount = array_count_values($prodarray);
			return $prodcount;
	}
	public function scan($value) {
		$this->addtocart = strtoupper($value);
		if($value =='' ||  empty($value)) $msg = "In Valid Data";
		else $msg = 'Given data '.$this->addtocart.' has been Scanned';
		print $msg;



	}
   
    public function total(){
		//print $value;
		$arraylists = $this->arraycount($this->addtocart);
			
		$grdtotal = 0; $grdtotal = 0; $tot = 0;
		foreach($arraylists as $key=>$arraylist){
			//print $key;
			$price = $this->productprice($key);	
			//print $price;
			 $restrictionmode = $this->restrictionmode($key);
			 $restrictioncount = $this->restrictioncount($key);
			 $restrictedprice = $this->restrictedprice($key);
			
			

			$tot = $this->calctotal($price,$restrictionmode,$restrictioncount,$arraylist,$restrictedprice);
			//print $tot;
			$grdtotal = abs($grdtotal + $tot);



			
			
		}
		print "<br> Total Price : ".$grdtotal;

	}




    
   
} 



?>