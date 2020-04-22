<style></style>

<?php # DISPLAY COMPLETE REGISTRATION PAGE.

# Set page title and display header section.
$page_title = 'Register' ;
include ( 'includes/header.html' ) ;
include ( 'includes/menu.html' ) ;

# Check form submitted.
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
{
    # Connect to the database.
    require ('connect_db.php');
    
    # Initialize an error array.
    $errors = array();
    
    
    #PERFORM VALIDATION ON FIELDS
        # Title
        { $pti = mysqli_real_escape_string( $dbc, trim( $_POST[ 'p_title' ] ) ) ; }
        
        #NAME VALIDATION
        # Check for a first name.
        if ( empty( $_POST[ 'first_name' ] ) )
        { $errors[] = 'Enter your first name.' ; }
        
        $fname = $_POST[ 'first_name' ];
        if (!preg_match("/^[a-zA-Z ]*$/",$fname)) {
            $error[] = "The first name field is not valid: only letter and spaces are allowed";
        }
        else
        { $fn = mysqli_real_escape_string( $dbc, trim( $_POST[ 'first_name' ] ) ) ; }
        
        # Check for a last name.
        if (empty( $_POST[ 'last_name' ] ) )
        { $errors[] = 'Enter your last name.' ; }
        
        $lname = $_POST[ 'last_name' ];
        if (!preg_match("/^[a-zA-Z ]*$/",$lname)) {
            $error[] = "The last name field is not valid: only letters and spaces are allowed";
        }
        else
        { $ln = mysqli_real_escape_string( $dbc, trim( $_POST[ 'last_name' ] ) ) ; }
    
        # DATE OF BIRTH VALIDATION.
        #If not empty.
        if (empty( $_POST[ 'dob' ] ) )
        { $errors[] = 'Enter your DOB.' ; }
    
        # Check user is older than 18 years old.
        $currentdate = date("d-m-y");
        $userdob = $_POST[ 'dob' ];
        $diff = abs(strtotime($userdob) - strtotime($currentdate));
        $years = floor($diff / (365*60*60*24));
        If ( $years < 18)
        { $errors[] = 'You are too young to register' ; }
        else
        { $dob = mysqli_real_escape_string( $dbc, trim( $_POST[ 'dob' ] ) ) ; }
    
   
        #EMAIL VALIDATION
        # Check for an email address:
        if ( empty( $_POST[ 'email' ] ) )
        { $errors[] = 'Enter your email address.'; }
        
        # Check if email address is valid i.e. contains no spaces and @ sign.
        $email = $_POST[ 'email' ];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format: check the '@' sign and for any spaces."; 
        }
        else
        { $e = mysqli_real_escape_string( $dbc, trim( $_POST[ 'email' ] ) ) ; }
    
    
    
    # Check for a postal address:
    if ( empty( $_POST[ 'address_1' ] ) )
    { $errors[] = 'Enter your address.'; }
    $address1 = $_POST[ 'address_1' ];
    $add_len = strlen($address1);
    
    if ((!preg_match('/^(?:\\d+ [a-zA-Z ]+, ){2}[a-zA-Z ]+$/', $address1) and $add_len < 5)) 
    {
        $errors[] = "Invalid address format: address either too short or contains invalid characters";
    } 
    else
    { $ad = mysqli_real_escape_string( $dbc, trim( $_POST[ 'address_1' ] ) ) ; }
    
    
    
    # Check for a town:
    if ( empty( $_POST[ 'town' ] ) )
    { $errors[] = 'Enter your town.'; }
    $town = $_POST[ 'town' ];
    $town_len = strlen($town);
    
    if (!preg_match('/^(?:\\d+ [a-zA-Z ]+, ){2}[a-zA-Z ]+$/', $town) and $town_len < 5) 
    {
        $error[] = "The town field is not valid: only letters and spaces are allowed";
    }
    else
    { $tw = mysqli_real_escape_string( $dbc, trim( $_POST[ 'town' ] ) ) ; }
    
    
    
    # Check for a postcode:
    if ( empty( $_POST[ 'postcode' ] ) )
    { $errors[] = 'Enter your postcode.'; }
    $postcode = $_POST[ 'postcode' ];
    $postcode_len = strlen($postcode);
    
    if ((!preg_match('/^(?:\\d+ [a-zA-Z ]+, ){2}[a-zA-Z ]+$/', $postcode) and $postcode_len < 5)) 
    {  
        $errors[] = "The postcode field is not valid: e.g. W3 1RJ, NW10 4RX";
    }
    else
    { $pc = mysqli_real_escape_string( $dbc, trim( $_POST[ 'postcode' ] ) ) ; }
    
    
    
    # Check for a password and matching input passwords.
    if ( !empty($_POST[ 'pass1' ] ) )
    {
        if ( $_POST[ 'pass1' ] != $_POST[ 'pass2' ] )
        { 
            $errors[] = "Passwords do not match." ; 
        }
        $pass1 = $_POST[ 'pass1' ];
        $ucaseChar = preg_match('@[A-Z]@', $pass1);
        $lcaseChar = preg_match('@[a-z]@', $pass1);
        $numChar    = preg_match('@[0-9]@', $pass1);
        $spChars = preg_match('@[^\w]@', $pass1);
        $pass_len = strlen($pass1);
        
        if (!$ucaseChar || !$lcaseChar || !$numChar || !$spChars || $pass_len < 8)
        {
            $errors[] = "Invalid Password: Does not meet required complexity. Try a mix of special, upper case, lower case and numeric characters";
        
        }
        else
        { 
            $p = mysqli_real_escape_string( $dbc, trim( $_POST[ 'pass1' ] ) ) ; 
        }
        }
        else { $errors[] = 'Enter your password.' ; }
        
        
        # Check for a password and matching input passwords.
        if ( !empty($_POST[ 'pass1' ] ) )
        {
            if ( $_POST[ 'pass1' ] != $_POST[ 'pass2' ] )
            { $errors[] = 'Passwords do not match.' ; }
            else
            { $p = mysqli_real_escape_string( $dbc, trim( $_POST[ 'pass1' ] ) ) ; }
        }
       

        
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
        echo '<div class="centertext">';
        #ensure that the database table field and the relevant form variable are entered in this section
        $q = "INSERT INTO users (p_title, first_name, last_name, dob, email, address_1, town, postcode, pass, reg_date) VALUES ('$pti', '$fn', '$ln', '$dob', '$e', '$ad', '$tw', '$pc', SHA1('$p'), NOW() )";
        $r = @mysqli_query ( $dbc, $q ) ;
        if ($r)
        { echo '<h1>Great News!</h1><p>You have successfully registered</p><p><a href="login.php">Login</a></p>'; }
        echo '/<div>';
        # Close database connection.
        mysqli_close($dbc);
        
        # Display footer section and quit script:
        include ('includes/footer.html');
        exit();
    }
    # Or report errors.
    else
    {
        echo '<div class="centertext">';
        echo '<h1>Something went wrong!</h1><p id="err_msg">The following error(s) occurred:<br>' ;
        foreach ( $errors as $msg )
        { echo " - $msg<br>" ; }
        echo 'Please try again.</p>';
        
        echo '/<div>';
        # Close database connection.
        mysqli_close( $dbc );
    }
}
?>

<!-- Use css from style sheet> -->


 <div class="container">
 <div class="form-group">

<!-- Display body section with sticky form. -->
<br>
<h1>Register</h1>
<form action="register.php" method="post">


<!-- Title form field added -->

<label for="TitleFormControlSelect1">Title: </label>
    <select class="form-control" id="TitleFormControlSelect1" name="p_title">
      <option>Dr</option>
      <option>Miss</option>
      <option>Mr</option>
      <option>Mrs</option>
      <option>Other</option>
      
    </select>
<br>

<div class="form-row">
<div class="form-group col-md-6">
<p>First Name: <input type="text" name="first_name" size="20" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>"> 
</div>
<div class="form-group col-md-6">
Last Name: <input type="text" name="last_name" placeholder="Last family name" size="20" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>"></p>
</div>
</div>

<div class="form-row">
<div class="form-group col-md-6">
<!-- address form field added -->
<p>Date of Birth: <input type="date" name="dob" size="60" value="<?php if (isset($_POST['dob'])) echo $_POST['dob']; ?>"></p>
</div>

<div class="form-group col-md-6">
<p>Email Address: <input type="text" name="email" placeholder="e.g. jane_smith@contoso.com" size="50" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"></p>
</div>
</div>

 <div class="form-group">
<!-- address form field added -->
<p>Address: <input type="text" name="address_1" size="60" placeholder="House number or building name, street name" value="<?php if (isset($_POST['address_1'])) echo $_POST['address_1']; ?>"></p>
</div>

<div class="form-row">
<div class="form-group col-md-6">
<!-- town form field added -->
<p>Town: <input type="text" name="town" size="60" value="<?php if (isset($_POST['town'])) echo $_POST['town']; ?>"></p>
</div>
</div>

<div class="form-group col-md-6">
<!-- town form field added -->
<p>Postcode: <input type="text" name="postcode" placeholder="e.g. AL10 9EU" size="12" value="<?php if (isset($_POST['postcode'])) echo $_POST['postcode']; ?>"></p>
</div>


<div class="form-row">
<div class="form-group col-md-6">
<p>Password: <input type="password" name="pass1" size="20" value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>" >
</div>
<div class="form-group col-md-6">
Confirm Password: <input type="password" name="pass2" size="20" value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>"></p>
<p><input type="submit" value="Register"></p>
</div>
</div>
</form>

</div>

</div>
<br>


<?php 

# Display footer section.
include ( 'includes/footer.html' ) ; 

?>
