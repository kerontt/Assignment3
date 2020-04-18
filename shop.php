<?php # DISPLAY COMPLETE PRODUCTS PAGE.

# Access session.
session_start() ;

# RemoRedirect if not logged in.



# Set page title and display header section.
$page_title = 'Shop' ;
include ( 'includes/header.html' ) ;
include ( 'includes/menu.html' ) ;



if ($_SESSION['Firstname'] = "") {
    # Display body section.if logged in
    echo "<h1></h1><p>You are not logged in </p>";
    
    
    
    # Create navigation links.
    echo '<p><a href="../forum.php">Forum</a> | <a href="../shop.php">Shop</a> | <a href="../login.php">Login</a></p>';
}
else {
    
    echo "<h1></h1><p>You are logged in {$_SESSION['first_name']} {$_SESSION['last_name']} </p>";
    echo '<p><a href="goodbye.php">Logout</a></p>';
    
}




// index end
# Open database connection.
require ( 'connect_db.php' ) ;

# Retrieve items from 'shop' database table.
$q = "SELECT * FROM shop" ;
$r = mysqli_query( $dbc, $q ) ;
if ( mysqli_num_rows( $r ) > 0 )
{
    
    $thisItem = "item_name";
    $thisItemDesc = "item_desc";
    $thisItemImage = "item_img";
    $thisItemPrice = "item_price";
    $thisItemID = "item_id";
  # Display body section.
  echo '<div class="container">';
  while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
  {
    echo '<div class="row">
    <div class="col-lg-4 col-md-6 mb-4"><strong>' . $row[$thisItem] .'</strong><br><span style="font-size:smaller">'. $row[$thisItemDesc] . '</span><br><img class="thumbnail" src='. $row[$thisItemImage].'><div class="card-body"><br>$' . $row[$thisItemPrice] . '<br><a href="added.php?id='.$row[$thisItemID].'" class="btn btn-primary" role="button">Add To Cart</a><br></div></div></div>';
  }
  ;
  echo '</div>';
 
  
  # Close database connection.
  mysqli_close( $dbc ) ; 
}
# Or display message.
else { echo '<p>There are currently no items in this shop.</p>' ; }


# Display footer section.
include ( 'includes/footer.html' ) ;

?>