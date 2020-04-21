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
    echo '<ul class="cartWrap">
    <li class="items odd">
    
    <div class="infoWrap">
    <div class="cartSection">
    
    <img class="thumbnail" src="'.$row['item_img'].'" alt="" class="itemImg" />
    <h3>'.$row['item_name'].'</h3>
    <h4>'.$row['item_desc'].'</h4>
    
    <p> <input type="text"  class="qty" name="qty'.$row['item_id'].'" value="'.$_SESSION['cart'].''.$row['item_id'].''.$row['quantity'].'"</p> x '.$row['item_price'].'</p>
    <p> 

    

    
    
    <div class="$total">
    <p>£'.number_format ($subtotal, 2).'</p>
    </div>
   
    </div>
    </div>
    </li>';
    
    echo 
    
    "<tr> 

    <input type=\"text\" size=\"3\" name=\"qty[{$row['item_id']}]\" value=\"{$_SESSION['cart'][$row['item_id']]['quantity']}\"></tr>
    <td>@ {$row['item_price']} = </td> <td>".number_format ($subtotal, 2)."</td></tr>";
    

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