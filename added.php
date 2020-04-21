<?php # DISPLAY SHOPPING CART ADDITIONS PAGE.

# Access session.
session_start() ;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

# Set page title and display header section.
$page_title = 'Cart Addition' ;
include ( 'includes/header.html' ) ;
include ( 'includes/menu.html' ) ;

# Create navigation links.
echo '<div class="secnav"';
echo '<p><a href="goodbye.php">Logout</a></p>' ;
echo '</div>';

# Get passed product id and assign it to a variable.
if ( isset( $_GET['id'] ) ) $id = $_GET['id'] ; 

# Open database connection.
require ( 'connect_db.php' ) ;

# Retrieve selective item data from 'shop' database table. 
$q = "SELECT * FROM shop WHERE item_id = $id" ;
$r = mysqli_query( $dbc, $q ) ;
if ( mysqli_num_rows( $r ) == 1 )

    $thisItem = "item_name";
    $thisItemDesc = "item_desc";
    $thisItemImage = "item_img";
    $thisItemPrice = "item_price";
    $thisItemID = "item_id";
{
  $row = mysqli_fetch_array( $r, MYSQLI_ASSOC );

  # Check if cart already contains one of this product id.
  if ( isset( $_SESSION['cart'][$id] ) )
  { 
    # Add one more of this product.
    $_SESSION['cart'][$id]['quantity']++; 
    
    echo '<div class="container">';
    echo '<div class="card">';
    echo '<p><span><a href="cart.php"><img class="thumbnail" src='.$row["$thisItemImage"].' </span></a><p class="product-description"> Another '.$row["$thisItem"].' has been added to your cart <br><a href="cart.php">Checkout Item</a> or <a href="shop.php"> continue shopping</a></p>';
    echo '<h4 class="price">Item price: <span>£'. $row[$thisItemPrice] . '</span></h4></div>';
    echo'</div></div><br>';
  } 
  else
  {
    # Or add one of this product to the cart.
    $_SESSION['cart'][$id]= array ( 'quantity' => 1, 'price' => $row['item_price'] ) ;
    echo '<div class="container">';
    echo '<div class="card">';
    echo '<p><span><a href="cart.php"><img class="thumbnail" src='.$row["$thisItemImage"].' </span></a><p class="product-description"> A '.$row["$thisItem"].' has been added to your cart <br><a href="cart.php">Checkout Item</a> or <a href="shop.php">continue shopping</a>';
    echo '<h4 class="price">Item price: <span>£'. $row[$thisItemPrice] . '</span></h4></div><br>';
    echo'</div></div>';
  }
}

# Close database connection.
mysqli_close($dbc);


# Display footer section.
include ( 'includes/footer.html' ) ;

?>