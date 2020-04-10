<?php # DISPLAY COMPLETE REGISTRATION PAGE.

# Set page title and display header section.
$page_title = 'Register' ;
include ( 'includes/header.html' ) ;

# Check form submitted.
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
{
    # Connect to the database.
    require ('connect_db.php');
    
    # Initialize an error array.
    $errors = array();
    
    
    # Check for a title
    { $pti = mysqli_real_escape_string( $dbc, trim( $_POST[ 'p_title' ] ) ) ; }
    
    
    # Check for a first name.
    if ( empty( $_POST[ 'first_name' ] ) )
    { $errors[] = 'Enter your first name.' ; }
    else
    { $fn = mysqli_real_escape_string( $dbc, trim( $_POST[ 'first_name' ] ) ) ; }
    
    # Check for a last name.
    if (empty( $_POST[ 'last_name' ] ) )
    { $errors[] = 'Enter your last name.' ; }
    else
    { $ln = mysqli_real_escape_string( $dbc, trim( $_POST[ 'last_name' ] ) ) ; }
    
    # Check for a last name.
    if (empty( $_POST[ 'dob' ] ) )
    { $errors[] = 'Enter your DOB.' ; }
    else
    { $dob = mysqli_real_escape_string( $dbc, trim( $_POST[ 'dob' ] ) ) ; }
    
    # Check for an email address:
    if ( empty( $_POST[ 'email' ] ) )
    { $errors[] = 'Enter your email address.'; }
    else
    { $e = mysqli_real_escape_string( $dbc, trim( $_POST[ 'email' ] ) ) ; }
    
    # Check for a postal address:
    if ( empty( $_POST[ 'address_1' ] ) )
    { $errors[] = 'Enter your address.'; }
    else
    { $ad = mysqli_real_escape_string( $dbc, trim( $_POST[ 'address_1' ] ) ) ; }
    
    # Check for a postal address:
    if ( empty( $_POST[ 'town' ] ) )
    { $errors[] = 'Enter your town.'; }
    else
    { $tw = mysqli_real_escape_string( $dbc, trim( $_POST[ 'town' ] ) ) ; }
    
    # Check for a postcode:
    if ( empty( $_POST[ 'postcode' ] ) )
    { $errors[] = 'Enter your postcode.'; }
    else
    { $pc = mysqli_real_escape_string( $dbc, trim( $_POST[ 'postcode' ] ) ) ; }
    
    # Check for a password and matching input passwords.
    if ( !empty($_POST[ 'pass1' ] ) )
    {
        if ( $_POST[ 'pass1' ] != $_POST[ 'pass2' ] )
        { $errors[] = 'Passwords do not match.' ; }
        else
        { $p = mysqli_real_escape_string( $dbc, trim( $_POST[ 'pass1' ] ) ) ; }
    }
    else { $errors[] = 'Enter your password.' ; }
    
    # Check if email address already registered.
    if ( empty( $errors ) )
    {
        $q = "SELECT user_id FROM users WHERE email='$e'" ;
        $r = @mysqli_query ( $dbc, $q ) ;
        if ( mysqli_num_rows( $r ) != 0 ) $errors[] = 'Email address already registered. <a href="login.php">Login</a>' ;
    }
    
    # On successful register user 'Insert' into 'users' database table.
    if ( empty( $errors ) )
    {
        
        #ensure that the database table field and the relevant form variable are entered in this section
        $q = "INSERT INTO users (p_title, first_name, last_name, dob, email, address_1, town, postcode, pass, reg_date) VALUES ('$pti', '$fn', '$ln', '$dob', '$e', '$ad', '$tw', '$pc', SHA1('$p'), NOW() )";
        $r = @mysqli_query ( $dbc, $q ) ;
        if ($r)
        { echo '<h1>Great News!</h1><p>You have successfully registered</p><p><a href="login.php">Login</a></p>'; }
        
        # Close database connection.
        mysqli_close($dbc);
        
        # Display footer section and quit script:
        include ('includes/footer.html');
        exit();
    }
    # Or report errors.
    else
    {
        echo '<h1>Error!</h1><p id="err_msg">The following error(s) occurred:<br>' ;
        foreach ( $errors as $msg )
        { echo " - $msg<br>" ; }
        echo 'Please try again.</p>';
        # Close database connection.
        mysqli_close( $dbc );
    }
}
?>

<!-- Display body section with sticky form. -->
<h1>Register</h1>
<form action="register.php" method="post">
<p>First Name: <input type="text" name="first_name" size="20" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>"> 
Last Name: <input type="text" name="last_name" size="20" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>"></p>

<!-- test title form field added -->
<p><label>Title</label>Male<input type="radio" name="p_title" size="60" value="<?php if (isset($_POST['p_title'])) echo $_POST['p_title']; ?>"></p>
Female<input type="radio" name="p_title" size="60" value="<?php if (isset($_POST['p_title'])) echo $_POST['p_title']; ?>"></p>


<!-- address form field added -->
<p>Date of Birth: <input type="date" name="dob" size="60" value="<?php if (isset($_POST['dob'])) echo $_POST['dob']; ?>"></p>


<p>Email Address: <input type="text" name="email" size="50" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"></p>

<!-- address form field added -->
<p>Address: <input type="text" name="address_1" size="60" value="<?php if (isset($_POST['address_1'])) echo $_POST['address_1']; ?>"></p>

<!-- town form field added -->
<p>Town: <input type="text" name="town" size="60" value="<?php if (isset($_POST['town'])) echo $_POST['town']; ?>"></p>

<!-- town form field added -->
<p>Postcode: <input type="text" name="postcode" size="8" value="<?php if (isset($_POST['postcode'])) echo $_POST['postcode']; ?>"></p>

<p>Password: <input type="password" name="pass1" size="20" value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>" >
Confirm Password: <input type="password" name="pass2" size="20" value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>"></p>
<p><input type="submit" value="Register"></p>
</form>

<?php 

# Display footer section.
include ( 'includes/footer.html' ) ; 

?>
