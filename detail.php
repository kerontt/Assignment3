
<!-- Index product heading end -->



<?php

# Set page title and display header section.
$page_title = "Details - $item_name" ;
include ( 'includes/header.html' ) ;
include ( 'includes/menu.html' ) ;

if (isset($_REQUEST['id']))

// index end
# Open database connection.
{
    $theProductId = $_REQUEST['id'];
   
require ( 'connect_db.php' ) ;

$theProductId = $_REQUEST['id'];
# Retrieve items from 'shop' database table.
$q = "SELECT * FROM shop WHERE item_id=$theProductId" ;
$r = mysqli_query( $dbc, $q ) ;
    
    if ($r)
    {
        while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC))
        {
            $thisItem = "item_name";
            $thisItemDesc = "item_desc";
            $thisItemImage = "item_img";
            $thisItemPrice = "item_price";
            $thisItemID = "item_id";
            
            
            
            echo '<div class="col-lg-4 col-md-6 mb-4"><strong>' . $row[$thisItem] .'</strong><br><span style="font-size:smaller">'. $row[$thisItemDesc] . '</span><br><div class="row"><a href="detail.php?id='.$row[$thisItemID].'"><img class="thumbnail" src='. $row[$thisItemImage].'></a><div class="card-body"><br>$' . $row[$thisItemPrice] . '<br><a href="added.php?id='.$row[$thisItemID].'" class="btn btn-primary" role="button">Add To Cart</a><br></div></div></div>';
            
            
            
          
    }
    
}
    
}
else{
    echo "Invalid Product ID";
}
    

?>


