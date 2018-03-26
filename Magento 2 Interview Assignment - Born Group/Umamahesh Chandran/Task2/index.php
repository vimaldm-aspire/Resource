<?php
if(isset($_POST['addtocart']) && $_POST['addtocart'] !='' ) {
    include_once("store.php");
    $addtocart = $_POST['addtocart'];   
    $terminal = new Store();
    // Set product name, price, pack of quantity and price
    $terminal->setPricing('A', 2.00, 4, 7.00);
	$terminal->setPricing('B', 12.00, 0, 0);
	$terminal->setPricing('C', 1.25, 6, 6);
	$terminal->setPricing('D', 0.15, 0, 0);
	echo "<br>";
	$terminal->scan($addtocart);
	echo "<br>";
	$result = $terminal->total();
}
   
?>
<html>
<head> </head>
<title> Products </title>
<body>
	
	<form name="product" action="index.php" method="post">
		<h2>Products</h2>
		<table>
			<tr>
				<td><input type="text" name="addtocart" value="" id="addtocart"></td>
			</tr>
			<tr>
				<td><input type="submit" name="submit" value="Submit" id="submit"></td>
			</tr>
		</table>
	</form>
</body>
</html>