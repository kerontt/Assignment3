<Style>

</Style>

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
  
  # Check for a title name.
  if ( empty( $_POST[ 'title' ] ) )
  { $errors[] = 'Select preferred title.' ; }
  else
  { $ti = mysqli_real_escape_string( $dbc, trim( $_POST[ 'title' ] ) ) ; }

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

  # Check for an email address:
  if ( empty( $_POST[ 'email' ] ) )
  { $errors[] = 'Enter your email address.'; }
  else
  { $e = mysqli_real_escape_string( $dbc, trim( $_POST[ 'email' ] ) ) ; }
  
  # Check for a postal address:
  if ( empty( $_POST[ 'address1' ] ) )
  { $errors[] = 'Enter your postal address.'; }
  else
  { $ad = mysqli_real_escape_string( $dbc, trim( $_POST[ 'address_1' ] ) ) ; }
  
  # Check for a postal town:
  if ( empty( $_POST[ 'town' ] ) )
  { $errors[] = 'Enter your postal town.'; }
  else
  { $to = mysqli_real_escape_string( $dbc, trim( $_POST[ 'town' ] ) ) ; }
  

  # Check for a postal postcode:
  if ( empty( $_POST[ 'postcode' ] ) )
  { $errors[] = 'Enter your postcode.'; }
  else
  { $po = mysqli_real_escape_string( $dbc, trim( $_POST[ 'postcode' ] ) ) ; }
  
  # Check for a password and matching input passwords.
  if ( !empty($_POST[ 'pass1' ] ) )
  {
    if ( $_POST[ 'pass1' ] != $_POST[ 'pass2' ] )
    { $errors[] = 'Passwords do not match.' ; }
    else
    { $p = mysqli_real_escape_string( $dbc, trim( $_POST[ 'pass1' ] ) ) ; }
  }
  else { $errors[] = 'Enter your password.' ; }
  
  # Check for a password complexity.

  
  
  # Check if email address already registered.
  if ( empty( $errors ) )
  {
    $q = "SELECT user_id FROM users WHERE email='$e'" ;
    $r = @mysqli_query ( $dbc, $q ) ;
    if ( mysqli_num_rows( $r ) != 0 ) $errors[] = 'Email address already registered. <a href="login.php">Login</a>' ;
  }
  
  # Check if email address is valid.
  if ( empty( $errors ) )
  {
      $q = "SELECT user_id FROM users WHERE email='$e'" ;
      $r = @mysqli_query ( $dbc, $q ) ;
      if ( mysqli_num_rows( $r ) != 0 ) $errors[] = 'Email address already registered. <a href="login.php">Login</a>' ;
  }
  
  # On success register user inserting into 'users' database table.
  if ( empty( $errors ) ) 
  {
    $q = "INSERT INTO users (title, first_name, last_name, email, address_1, address_2, town, postcode, pass, reg_date) VALUES ('$ti' '$fn', '$ln', '$e', SHA1('$p'), NOW() )";
    $r = @mysqli_query ( $dbc, $q ) ;
    if ($r)
    { echo 'script type="text/javascript"> alert("Thank you for registering") </script> ';}
 
  
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
<div class="container">
<div Class="form">
<!-- Display body section with sticky form. -->
<h1>Register</h1>
<form action="register.php" method="post">

<p>Title:<input type="text" name="title" size="10" value="<?php if (isset($_POST['title'])) echo $_POST['title']; ?>"></p>
<p>First Name: <input type="text" name="first_name" size="20" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>"> 
Last Name: <input type="text" name="last_name" size="20" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>"></p>
<p>Email Address: <input type="text" name="email" size="50" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"></p>
<p>Address Line 1: <input type="text" name="address1" size="50" value="<?php if (isset($_POST['address_1'])) echo $_POST['address1']; ?>"></p>
<p>Address Line 2: <input type="text" name="address2" size="50" value="<?php if (isset($_POST['address_2'])) echo $_POST['address2']; ?>"></p>
<p>Town: <input type="text" name="town" size="50" value="<?php if (isset($_POST['town'])) echo $_POST['town']; ?>"></p>
<p>Postcode: <input type="text" name="postcode" size="50" value="<?php if (isset($_POST['postcode'])) echo $_POST['postcode']; ?>"></p>
<p>Password: <input type="password" name="pass1" size="20" value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>" >
Confirm Password: <input type="password" name="pass2" size="20" value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>"></p>
<p><input type="submit" value="Register"></p>
</form>


</div>

</div>

<?php 

# Display footer section.
include ( 'includes/footer.html' ) ; 

?>