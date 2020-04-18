



<!-- Start of body tags includes style sheet references and bootstrap if applicable. -->
<body>


</body>


<!-- Start of Php -->
<?php # DISPLAY COMPLETE LOGIN PAGE.

# Set page title and include header/menu section.
$page_title = 'Login' ;
include ( 'includes/header.html' ) ;
include ( 'includes/menu.html' ) ;
?>
<div class="container-fluid">
  <div class="row no-gutter">
    <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
    <div class="col-md-8 col-lg-6">
      <div class="login d-flex align-items-center py-5">
        <div class="container">
          
            <div class="col-md-9 col-lg-8 mx-auto">
            

<!-- Display form body section. -->
  <h3 class="login-heading mb-4">Login</h3>
<form action="login_action.php" method="post">
<div class="form-label-group">
 <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address" required autofocus>

</div>
<p></p>

<div class="form-label-group">
                  <input type="password" id="inputPassword" name="pass" class="form-control" placeholder="Password" required>
              
</div>

<div class="custom-control custom-checkbox mb-3">
                  <input type="checkbox" class="custom-control-input" id="customCheck1">
                  <label class="custom-control-label" for="customCheck1">Remember password</label>
                </div>

<button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit" value="Login">Sign in</button>

<a href="register.php">Register</a>
</form>
<?php 


# Display any error messages if present.
if ( isset( $errors ) && !empty( $errors ) )
{
    echo '<p id="err_msg">Oops! Something went wrong!:<br>' ;
    foreach ( $errors as $msg ) { echo " - $msg<br>" ; }
    echo 'Please try again or <a href="register.php">Register</a></p>' ;
}?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php 



# Display footer section.
include ( 'includes/footer.html' ) ; 

?>



</html>