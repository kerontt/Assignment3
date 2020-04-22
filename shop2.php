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
    echo "<div class='secnav'><h1></h1><p>You are not logged in </p></div>";
    
    echo '<div class="secnav"><p> <a href="goodbye.php">Logout</a></p></div>' ;}
    else {
        echo "<div class='secnav'><h1></h1><p>You are logged in as:<br> {$_SESSION['first_name']} {$_SESSION['last_name']} </p>";
        echo '<p><a href="goodbye.php">Logout</a></p>';
        echo '</div>';
        
    }
    
    
 
    
    // index end
    # Open database connection.
    require ( 'connect_db.php' ) ;
    
    //Default sorting of items.
    $order="item_name";
    $sort="ASC";
    $property="item_price";
    $minimum="200";
    
    # Get passed product order value.
    if ( isset( $_GET['order'] ) ) $order = $_GET['order'] ;
    
    
    # Get passed product sort direction.
    if ( isset( $_GET['sort'] ) ) $sort = $_GET['sort'] ;
    
    # Get passed product item value.
    if ( isset( $_GET['property'] ) ) $property = $_GET['property'] ;
    
    
    # Get passed product amount.
    if ( isset( $_GET['minimum'] ) ) $minimum = $_GET['minimum'] ;
    
  
    
    
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
        


        echo '<div class="container">';
        
        # Display sort criteria.
        echo '<a href="?order=item_name&sort=ASC">Sort by Name (ascending) | </a>';
        echo '<a href="?order=item_name&sort=DESC">Sort by Name (descending) | </a>';
        echo '<a href="?order=item_price&sort=ASC">Sort by Price ascending) | </a>';
        echo '<a href="?order=item_price&sort=DESC">Sort by Price (decending)<br></a>';

        # Display filter query
        $q = "SELECT * FROM shop WHERE item_price < 200";
        echo '<a href="?property=item_price&minimum=200">200 value<br></a>';
        
        
        
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

