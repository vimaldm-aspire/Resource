<html>
<head>
    <title>Point of Scale Program</title>
</head>
<body>
<h2><center>Point of Scale Program</center></h2>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="target">
  Enter the Product: <input type="text" name="product_name" />
  <button type="submit" name="submit" id="process">Submit</button>
</form>
</body>
</html>

<?php
   
class Product {

    public $total;

    public function setpricing($text){
        $textTrim = rtrim($text);
        $total = 0;     
        $textSplit = str_split($textTrim, 1);
        $counts = array_count_values($textSplit);
        $products = array(
                        'A'=>array('1'=>2.00, '4'=>7.00), 
                        'B'=>array('1'=>12.00), 
                        'C'=>array('1'=>1.25, '6'=>6.00), 
                        'D'=>array('1'=>0.15)
                        );

        foreach($counts as $code=>$amount) { 
            if(isset($products[$code]) && count($products[$code]) > 1) {
                $maxVal = max(array_keys($products[$code]));
                $subtotal = intval($amount / $maxVal) * $products[$code][$maxVal] + fmod($amount, $maxVal) * $products[$code]['1'];
                $total += $subtotal; 
            }
            elseif (isset($products[$code])) {
                $subtotal = $amount * $products[$code]['1'];
                $total += $subtotal;
            }
        }
        $this->total = number_format($total, 2);
    }

    public function total(){
        return $this->total;
    }
}

if (isset($_POST["submit"])) {
    $text = $_POST["product_name"];
    
    $terminal = new Product;
    $terminal->setpricing($text);
    echo "Scan these items in this order: <b>".$text."</b>; Verify the total price is <b>$".$terminal->total()."</b>";
}

?>
