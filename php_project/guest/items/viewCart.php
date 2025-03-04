<?php
/*
	Author: 5h6nn0n
	Guest/items page 3 of 8
	Filename: viewCart.php
*/

$status = session_status();

// if there is no active session..
if($status == PHP_SESSION_NONE)
{
    session_start(); //..start a session 
}
// to reference the checkout values 
if(empty($_SESSION['checkout']))
{ 
	$_SESSION['checkout'] = array();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Final Project</title>
    <link rel="stylesheet" type="text/css" href="../../main.css" />
</head>

<body>
	<header>
		<h1>Shopping Cart</h1>
	</header>
<main>

<?php if(empty($_SESSION['shoppingCart'])) { ?>
 
    <h1> Your Cart is empty ! </h1>

<?php } else { ?>

    <h1>View Cart</h1>
	
	<table>
		<!-- table headings -->
		<tr>
			<th>Item ID </th>
			<th>Item Name </th>
			<th>Price</th>
			<th>Discount</th>
			<th>Quantity</th>
			<th>Final Price</th>
		</tr>
			
	<?php foreach ($_SESSION['shoppingCart'] as $cartID => $shoppingCart): ?>
			
		<?php 
		if (!isset($subtotal)) 
		{
			$subtotal = 0.00; // for the counter 
		}
		// take values from the initial array
		$sale = $shoppingCart['itemSale'];
		$price = $shoppingCart['itemPrice'];
		$qty = $shoppingCart['quantity'];
		$itemName = $shoppingCart['itemName']; 
			
		// order line calculations 
		$discount =  $sale * $qty;
		$cost = $price * $qty;
		$finalPrice = $cost - $discount;
		$shipping = 5.99;
		$subtotal  += $finalPrice;
		$totalDue = $subtotal + $shipping;
			
		// format currency variables
		$itemcost_format = "$".number_format($cost, 2);
		$discount_format = "$".number_format($discount, 2);
		$lineprice_format = "$".number_format($finalPrice, 2);
		$totalDue_format = number_format($totalDue, 2);
			
		// format without currency for array
		$disc_form = (float) number_format($discount, 2);
		$lp_form = (float) number_format($finalPrice, 2);
				
		// array for new the calculated variables 
		$myCart = array( 
				'item' => $cartID,
				'discount'=> $disc_form,
				'linePrice'=> $lp_form,
				'totalDue' => $totalDue,
				'quant' => $qty,
				'itemName' => $itemName,
				'shipCost' => $shipping
			);
		// apply array to checkout session 
		$_SESSION['checkout'][$cartID] = $myCart;
	
		?>
		
		<!-- table body -->
		<tr>
			<td><?php echo $cartID; ?></td>
			<td><?php echo $itemName; ?></td>
			<td><?php echo $itemcost_format; ?></td>
			<td><?php echo $discount_format; ?></td>
			<td><?php echo $qty;?></td>
			<td><?php echo $lineprice_format; ?></td>
		</tr>
		
		<?php endforeach; ?>
			
	</table>
	<h1 style="text-decoration: 2px dashed underline";><br>Order Summary<br></h1>
	<h3>Your Subtotal: <?php echo "$".$subtotal;?></h3>
	<h4>Shipping: <?php echo "$".$shipping; ?></h4>
	<h2>Total Amount Due: <?php echo "$".$totalDue_format; ?></h2>
			
	<?php
		// establish order total as a single value 
		$_SESSION["totalDue"] = $myCart["totalDue"];	 	
		$_SESSION["shipCost"] = $myCart["shipCost"];	 	
	?>		
		
<?php }  ?>
   
	<p><a href="index.php">Select More</a> </p>
	<p><a href="http://localhost/project/guest/items/addOrderForm.php?id=
				<?php echo $cartID; ?>">Place Order</a></p>
	<p><a href="emptyCart.php">Empty Cart</a> </p>
	
</main>
	<footer>
		<p>&copy; <?php echo date("Y"); ?> Shan's Shop, Inc.</p>
    </footer>
</body>
</html>	