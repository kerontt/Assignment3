s<link rel="stylesheet" href="includes/cart.css">

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
if ($_SESSION['Firstname'] = "") {
    # Display body section.if logged in
    echo "<div class='secnav'><h1></h1><p>You are not logged in </p></div>";
    echo '<div class="secnav"><p> <a href="goodbye.php">Logout</a></p></div>' ;}
    else {
        echo "<div class='secnav'><h1></h1><p>You are logged in as:<br> {$_SESSION['first_name']} {$_SESSION['last_name']} </p>";
        echo '<p><a href="goodbye.php">Logout</a></p>';
        echo '</div>';
    }  

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
  echo '<form action="cart.php" method="post">';
  while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC))
  {
    # Calculate sub-totals and grand total.
    $subtotal = $_SESSION['cart'][$row['item_id']]['quantity'] * $_SESSION['cart'][$row['item_id']]['price'];
    $total += $subtotal;

    # Display the row/s:
    echo'<div class="container-fluid mt-100">
      <div class="row">
      <div class="col-md-12">
      <div class="card mb-4">
      <div class="card-header">
      <div class="media flex-wrap w-100 align-items-center"> <img class ="thumbnail" src="'.$row['item_img'].'" class="d-block ui-w-40 rounded-circle" alt="">
      <div class="media-body ml-3"> <data-abc="true"><H4>'.$row['item_name'].' </H4><br><H5> £'. $row['item_price'] . '</H5>
      </div>
      <div class="text-muted small ml-3">
      <div>Sub Total:<H4><strong>£'.number_format ($subtotal, 2).'</H5></strong></div>';
    echo'
      </div>
      </div>
      <div class="card-body">';
  echo'</div>
      <div class="card-footer d-flex flex-wrap justify-content-between align-items-center px-0 pt-0 pb-3">
      <div class="px-4 pt-3"> <class="text-muted d-inline-flex align-items-center align-middle" data-abc="true"> <i class="fa fa-heart text-danger"></i>&nbsp; <span class="align-middle">Quantity:</span> </a> <span class="text-muted d-inline-flex align-items-center align-middle ml-4">'; 

echo "<span><input type=\"text\" size=\"3\" name=\"qty[{$row['item_id']}]\" value=\"{$_SESSION['cart'][$row['item_id']]['quantity']}\"></span>
    </span>";

  echo'<i class="fa fa-eye text-muted fsize-3"></i>&nbsp; <span class="align-middle"></span> </span> </div>
        </div>
      </div>
      </div>
      </div>';
  }
  
  # Close the database connection.
  mysqli_close($dbc); 
  
  # Display the cart buttons.
  echo ' 
     <div class="col-md-12 col-lg-4"> 
<button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">Update my cart</button><br>

<a href="checkout.php?total='.$total.'"><button name="checkout" placeholder="Checkout" type="submit" class="btn btn-link btn-lg btn-block">Checkout</a></button></br>
</div>';
  
  # Display the sub-totals.
  echo'
    <div class="subtotal cf">
    <H6>
    <div class="totalRow"><span class="label">Standard Shipping</span><span class="value">: £5.00</span></div></H6>
    <H3><div class="totalRow final"><span class="label">Total</span><span class="value">: £'.number_format($total,2).'</span></div>
    </H3>
</div>
</div>';
}
else
# Or display a message.
{ echo '<div class="centertext"><p>Your cart is currently empty.</p></div></br>' ; }


# Display footer section.
include ( 'includes/footer.html' ) ;

?>