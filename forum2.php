<?php 


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
    

 ?>