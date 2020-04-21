
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
            $thisItemDoc = "item_doc";
            
            
            echo '<div class="container">
	                   <div class="card">
			                 <div class="container-fliud">
	                               <div class="wrapper row">
					                      
        
            
<div class="preview-pic tab-content"><div class="tab-pane active" id="main-img"><img src='. $row[$thisItemImage].'> 
</div>

<ul class="preview-thumbnail nav nav-tabs">
<li class="active"><a data-target="#pic-2" data-toggle="tab"><img src='. $row[$thisItemImage2] . '></a></li>
<li><a data-target="#pic-3" data-toggle="tab"><img src='. $row[$thisItemImage3] . '></a></li>
</ul>
</div>             
</div>			
</div';
    
    echo
					'<div class="details col-sm-6">
						<h3 class="product-title">'. $row[$thisItem] . '</h3>
                        </br>
                        <p>
                        <p class="product-description">'. $row[$thisItemDesc] . '</p>
						<p class="product-description">'. $row[$thisItemDescLg] . '</p>
                        <p class="product-description"><a href='. $row[$thisItemDoc] . '</p></a>
						<h4 class="price">Current price: <span>£'. $row[$thisItemPrice] . '</span></h4></div>';
                        
						echo 
						'<div class="action">
                        <a href="added.php?id='.$row[$thisItemID].'" class="btn btn-primary" role="button">Add To Cart</a>							

                     </div>    
                     </div>                 
			          </div>    
                     </div>                 
			        
					  
               </div>';
            
          
            
            
            
          
    }
    
}
    
}
else{
    echo "Invalid Product ID";
}
    

?>


