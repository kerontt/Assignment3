<?php

# Set page title and display header section.
$page_title = 'Cart Addition' ;
include ( 'includes/header.html' ) ;
include ( 'includes/menu.html' ) ;


# Get passed product id and assign it to a variable.
if ( isset( $_GET['id'] ) ) $id = $_GET['id'] ;

# Open database connection.
require ( 'connect_db.php' ) ;

#Variables; get order value and direction;
$order_value="";
$order_dir="";

# Get passed product order value.
if ( isset( $_GET['order_value'] ) ) $order_value = $_GET['order_value'] ; 

# Get passed product iorder direction.
if ( isset( $_GET['order_dir'] ) ) $order_dir = $_GET['order_dir'] ; 

echo $order_value;
echo $order_dir;

echo SELECT * from shop order by $order_value $order_dir;

?>

<a href="shop_parsing.php?orderby=item_price&direction=ASC">Oder by price Cheapest First</a>"