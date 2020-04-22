<?php # DISPLAY COMPLETE PRODUCTS PAGE.

# Access session.
session_start() ;


# Set page title and display header section.
$page_title = 'Shop' ;
include ( 'includes/header.html' ) ;
include ( 'includes/menu.html' ) ;



# Create navigation links.


if ($_SESSION['Firstname'] = "") {
    # Display body section.if logged in
    echo "<h1></h1><p>You are not logged in </p>";
    
    
    
    # Create navigation links.
    echo '<div class="container-fluid"><p> <a href="goodbye.php">Logout</a></p></div>' ;}
    else {
        
        echo "<h1></h1><p>You are logged in as:<br> {$_SESSION['first_name']} {$_SESSION['last_name']} </p>";
        echo '<p><a href="goodbye.php">Logout</a></p>';
        
    }
    
    
 
    
    // index end
    # Open database connection.
    require ( 'connect_db.php' ) ;
    
    
    $order="item_name";
    $sort="ASC";
    
    # Get passed product order value.
    if ( isset( $_GET['order'] ) ) $order = $_GET['order'] ;
    
    
    # Get passed product iorder direction.
    if ( isset( $_GET['sort'] ) ) $sort = $_GET['sort'] ;
  
    
    
    # Retrieve items from 'shop' database table.
    $q = "SELECT * FROM shop ORDER by $order $sort";

    $r = mysqli_query( $dbc, $q ) ;
    if ( mysqli_num_rows( $r ) > 0 )
    {
        
        $thisItem = "item_name";
        $thisItemDesc = "item_desc";
        $thisItemImage = "item_img";
        $thisItemPrice = "item_price";
        $thisItemID = "item_id";
        # Display body section.
        
     
        
       
        
        # Display sort criteria.
        echo '<div class="container">';
        echo '<a href="?order=item_name&sort=ASC">Sort by Name (ascending)<br></a>';
        echo '<a href="?order=item_name&sort=DESC">Sort by Name (descending)<br></a>';
        echo '<a href="?order=item_price&sort=ASC">Sort by Price (ascending)<br></a>';
        echo '<a href="?order=item_price&sort=DESC">Sort by Price (decending)<br></a>';
        
        
        echo '<div class="container">';
        
        while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
        {
            echo '<a href="detail.php?id='.$row[$thisItemID].'">';
            echo '<div class="product"><strong>' . $row[$thisItem] .'</strong><br><span style="font-size:smaller">'. $row[$thisItemDesc] . '</span><br>';
            echo '<img class="thumbnail" src='. $row[$thisItemImage].'></a>';
            echo'<br>£' . $row[$thisItemPrice] . '<br>';
            echo '<br><a href="added.php?id='.$row[$thisItemID].'" class="btn btn-primary" role="button">Add To Cart</a><br>
</div>';
            
            
            
            
        }
        ;
        echo '</div>';
        echo '</div>';
        
        # Close database connection.
        mysqli_close( $dbc ) ;
    }
    # Or display message.
    else { echo '<p>There are currently no items in this shop.</p>' ; }
    
    # Display footer section.
    
    
    
    ?>

