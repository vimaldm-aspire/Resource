<!DOCTYPE html>
<html>
<body>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="target">
  <label>Enter the Products</label>
  <input type="text" name="product_txt" />
  <button type="submit" name="submit" id="process">Show Product Price</button>
</form>

<div class="result">
<?php
       include 'products.php';

	   // Initialize Product objects.
	   $products = new Products();

	   // add products and prices here. 
	   $products->setproductPricing("A", 2.00, [4=>7.00]);
	   $products->setproductPricing("B", 12.00);
	   $products->setproductPricing("C", 1.25, [6=>6.00]);
	   $products->setproductPricing("D", 0.15);
	   
       // process form data
		if (isset($_POST["submit"])) {
			$products_name = $_POST["product_txt"];
			$productlist = $products->getproductCount($products_name);
			$product_prices= $products->calculate($productlist);
            
			echo "<b>The total cost of: " . $products_name . " is: $" . number_format($product_prices, 2, '.', ',') . "</b>";
		}
		
?>
</div>
</body>
</html>