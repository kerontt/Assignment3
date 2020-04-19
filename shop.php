<?php # DISPLAY COMPLETE PRODUCTS PAGE.

# Access session.
session_start() ;

# RemoRedirect if not logged in.



# Set page title and display header section.
$page_title = 'Shop' ;
include ( 'includes/header.html' ) ;
include ( 'includes/menu.html' ) ;

# Create navigation links.
echo '<p><a href="../cart.php">View Cart</a> | <a href="../forum.php">Forum</a> | <a href="home.php">Home</a> | <a href="goodbye.php">Logout</a></p>' ;

# Display sort criteria.
echo '<div class="container">';
echo '<a href="shop_parsing.php?orderby=item_name&direction=ASC">Sort by Name (ascending)<br></a>';
echo '<a href="shop_parsing.php?orderby=item_price&direction=ASC">Sort by Price (ascending)<br></a>';

 

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
    echo '<div class="col-lg-4 col-md-6 mb-4"><strong>' . $row[$thisItem] .'</strong><br><span style="font-size:smaller">'. $row[$thisItemDesc] . '</span><br>
<div class="row"><a href="detail.php?id='.$row[$thisItemID].'">
<img class="thumbnail" src='. $row[$thisItemImage].'></a>
<div class="card-body"><br>$' . $row[$thisItemPrice] . '<br>
<a href="added.php?id='.$row[$thisItemID].'" class="btn btn-primary" role="button">Add To Cart</a><br>
</div></div></div>';
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