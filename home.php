<html>
<head>
  <title>Home</title>
</head>


<!-- Start of body tags includes style sheet references and bootstrap if applicable. -->
<body>


</body>


<!-- Start of Php -->
<?php # DISPLAY COMPLETE LOGGED IN PAGE.

# Access session.
session_start() ; 


# Set page title and display header section.

include ( 'includes/header.html' ) ;
include ( 'includes/menu.html' ) ;


if ($_SESSION['Firstname'] = "") {
# Display body section.if logged in
echo "<h1>Home</h1><p>You are not logged in </p>";

# Create navigation links.
echo '<p><a href="forum.php">Forum</a> | <a href="shop.php">Shop</a> | <a href="login.php">Login</a></p>';
}
else {
    
    echo "<h1>Home</h1><p>You are logged in {$_SESSION['first_name']} {$_SESSION['last_name']} </p>";
    echo '<p><a href="forum.php">Forum</a> | <a href="shop.php">Shop</a> | <a href="goodbye.php">Logout</a></p>';
    
}

    
# Display footer section.
include ( 'includes/footer.html' ) ;
?>

</html>