<?php # DISPLAY CHECKOUT PAGE.

# Access session.
session_start() ;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

# Set page title and display header section.
$page_title = 'Checkout' ;
include ( 'includes/header.html' ) ;
include ( 'includes/menu.html' ) ;

# Create navigation links.
if ($_SESSION['Firstname'] = "") {
    # Display body section.if logged in
    echo "<div class='secnav'><h1></h1><p>You are not logged in </p></div>";
    echo '<div class="secnav"><p> <a href="goodbye.php">Logout</a></p></div>' ;}
    else {
        echo "<div class='secnav'><h1></h1><p>You are logged in as:<br> {$_SESSION['first_name']} {$_SESSION['last_name']} </p>";
        echo '<p><a href="goodbye.php">Logout</a></p>';
        echo '</div></br>';
    }

# Check for passed total and cart.
if ( isset( $_GET['total'] ) && ( $_GET['total'] > 0 ) && (!empty($_SESSION['cart']) ) )
{
  # Open database connection.
  require ('connect_db.php');
  
  # Store buyer and order total in 'orders' database table.
  $q = "INSERT INTO orders ( user_id, total, order_date ) VALUES (". $_SESSION['user_id'].",".$_GET['total'].", NOW() ) ";
  $r = mysqli_query ($dbc, $q);
  
  # Retrieve current order number.
  $order_id = mysqli_insert_id($dbc) ;
  
  # Retrieve cart items from 'shop' database table.
  $q = "SELECT * FROM shop WHERE item_id IN (";
  foreach ($_SESSION['cart'] as $id => $value) { $q .= $id . ','; }
  $q = substr( $q, 0, -1 ) . ') ORDER BY item_id ASC';
  $r = mysqli_query ($dbc, $q);

  # Store order contents in 'order_contents' database table.
  while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC))
  {
    $query = "INSERT INTO order_contents ( order_id, item_id, quantity, price )
    VALUES ( $order_id, ".$row['item_id'].",".$_SESSION['cart'][$row['item_id']]['quantity'].",".$_SESSION['cart'][$row['item_id']]['price'].")" ;
    $result = mysqli_query($dbc,$query);
  }
  
  # Close database connection.
  mysqli_close($dbc);

  # Display order number.
  echo "<div class='centertext'><p>Thanks for your order. Your Order Number Is #".$order_id."</p></div></br>";

  # Remove cart items.  
  $_SESSION['cart'] = NULL ;
}
# Or display a message.
else { echo '<div class="centertext"><p>There are no items in your cart.</p></div></br>' ; }


    
# Display footer section.
include ( 'includes/footer.html' ) ;

?>