### Manual Module Installation

1. Go to Magento 2 root folder

2. paste all code in a foler app/code/Born/OrderController

3. Enter following commands to enable module:

   php bin/magento module:enable Born_OrderController
   php bin/magento setup:upgrade
   php bin/magento cache:clean
     

### How to use
   
By calling simple controller
   
    <?php
	/*
	 * init curl
	 */
	$ch = curl_init();  
	 
	curl_setopt($ch,CURLOPT_URL,'http://hostname/ordercontroller/guestorder?id=000000002');
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_HEADER, false); 

	$output=curl_exec($ch);

	curl_close($ch);

	echo $output;
	?>