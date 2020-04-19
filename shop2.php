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
    $thisCaption = "caption";
    $thisItemImage = "item_img";
    $thisItemPrice = "item_price";
    $thisItemID = "item_id";
    # Display body section.

}
while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
 foreach ($row as $r) : 
    
    
    ?>
 
 <div class="col-md-4">
 
 <div class="item-image">
 <a href="..detail.php">
<?php echo $thisItemImage;?></a></div>
<div class="item-desc">
<?php echo $thisItemDesc;?></div>
<div class="item-name">
<?php echo $thisItemName;?></div>
<div class="item-price">
<?php echo $thisItemPrice;?></div>


</div>

<?php endforeach; ?>