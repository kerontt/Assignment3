
<!-- Index product heading end -->

<head>

 <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    
  


<?php

# Set page title and display header section.
$page_title = 'Details - $item_name' ;
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
            $thisItemDescLg = "item_desc_lg";
            $thisItemImage = "item_img";
            $thisItemImage2 = "item_img2";
            $thisItemImage3 = "item_img3";
            $thisItemPrice = "item_price";
            $thisItemID = "item_id";
            
            echo 'div class="container"';
            echo "<img class=\"productdetail\" src=\"$thisItemImage\" />";
            echo "<class=\"productdescription\" <br/><H2>$thisItemDesc</H2>";
            echo "<class=\"productdescription p\" <br/><H3>$thisItemDescLg</H3><br/><br/><p>";
            echo "<class=\"productprice\" <br/><p>£$thisItemPrice</p>";
            
            
          echo '</div>';
            
            
            
          
    }
    
}
    
}
else{
    echo "Invalid Product ID";
}
    

?>


