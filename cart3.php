<?php # DISPLAY SHOPPING CART PAGE.

# Access session.
session_start() ;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

# Set page title and display header section.
$page_title = 'Cart' ;
include ( 'includes/header.html' ) ;
include ('includes/menu.html' ) ;

# Create navigation links.
echo '<p><a href="checkout.php?total='.$total.'">Checkout</a> | <a href="goodbye.php">Logout</a></p>' ;


# Check if form has been submitted for update.
if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
{
    # Update changed quantity field values.
    foreach ( $_POST['qty'] as $item_id => $item_qty )
    {
        # Ensure values are integers.
        $id = (int) $item_id;
        $qty = (int) $item_qty;
        
        # Change quantity or delete if zero.
        if ( $qty == 0 ) { unset ($_SESSION['cart'][$id]); }
        elseif ( $qty > 0 ) { $_SESSION['cart'][$id]['quantity'] = $qty; }
    }
}

# Initialize grand total variable.
$total = 0;

# Display the cart if not empty.
if (!empty($_SESSION['cart']))
{
    # Connect to the database.
    require ('connect_db.php');
    
    # Retrieve all items in the cart from the 'shop' database table.
    $q = "SELECT * FROM shop WHERE item_id IN (";
    foreach ($_SESSION['cart'] as $id => $value) { $q .= $id . ','; }
    $q = substr( $q, 0, -1 ) . ') ORDER BY item_id ASC';
    $r = mysqli_query ($dbc, $q);
    
    # Display body section with a form and a table.
    echo '<form action="cart.php" method="post">
<table>
<tr>
<th colspan="5">Items in your cart</th></tr>
<tr>';
    while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC))
    {
        # Calculate sub-totals and grand total.
        $subtotal = $_SESSION['cart'][$row['item_id']]['quantity'] * $_SESSION['cart'][$row['item_id']]['price'];
        $total += $subtotal;
        
        
        
        # Display the row/s:
        
        echo
        '<section class="shopping-cart light"> <!-- controls card color-->
    <div class="container">
    <div class="block-heading">
    <h2>Keron Cart</h2>
		        </div>
		        <div class="content">
	 				<div class="row">
	 					<div class="col-md-12 col-lg-8">
	 						<div class="items">
				 				<div class="product">
				 					<div class="row">
					 					<div class="col-md-3">
					 						<img class="img-fluid mx-auto d-block image" src="'.$row['item_img'].'">
					 					</div>
					 					<div class="col-md-8">
					 						<div class="info">
						 						<div class="row">
							 						<div class="col-md-5 product-name">
							 							<div class="product-name">
								 							<a href="#">Lorem Ipsum dolor</a>
								 							<div class="product-info">
									 							<div>Display: <span class="value">5 inch</span></div>
									 							<div>RAM: <span class="value">4GB</span></div>
									 							<div>Memory: <span class="value">32GB</span></div>
									 						</div>
									 					</div>
							 						</div>
							 						<div class="col-md-4 quantity">
							 							<label for="quantity">Quantity:</label>
							 							<input id="quantity" type="number" value ="1" class="form-control quantity-input">
							 						</div>
							 						<div class="col-md-3 price">
							 							<span>$120</span>
							 						</div>
							 					</div>
							 				</div>
					 					</div>
					 				</div>';
        
        
        
        
        
        
        
        
        
    
        
       
        
    }
    
    # Close the database connection.
    mysqli_close($dbc);
    
    # Display the total.
    echo
    
    ' <tr><td colspan="5" style="text-align:right">Total = '.number_format($total,2).'</td></tr>
</table>
        
<input type="submit" name="submit" value="Update My Cart">';
    
    echo'
    <div class="subtotal cf">
    <ul>
    <li class="totalRow"><span class="label">Standard Shipping</span><span class="value">: £5.00</span></li>
    <li class="totalRow final"><span class="label">Total</span><span class="value">: £'.number_format($total,2).'</span></li>
    <li class="totalRow"><a href="checkout.php?total='.$total.'" class="btn continue">Checkout</a></li>
    </ul>
    </div></div>';
}
else
# Or display a message.
{ echo '<p>Your cart is currently empty.</p>' ; }


# Display footer section.
include ( 'includes/footer.html' ) ;

?>