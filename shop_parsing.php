<?php

#Variables; get order value and direction;
$order="";
$sort="";

# Get passed product order value.
if ( isset( $_GET['order'] ) ) $order = $_GET['order'] ; 

# Get passed product iorder direction.
if ( isset( $_GET['sort'] ) ) $sort = $_GET['sort'] ; 

$result= "SELECT * from shop ORDER by $order $sort";

?>


