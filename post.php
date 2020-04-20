


<?php # DISPLAY POST MESSAGE FORM.

# Access session.
session_start() ;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

# Set page title and display header section.
$page_title = 'Post Message' ;
include ( 'includes/header.html' ) ;
include ( 'includes/menu.html' ) ;


# Create navigation links.

echo '<p><a href="forum.php">Forum</a> | <a href="goodbye.php">Logout</a></p>' ;




?>

<div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">

            <h5 class="card-title text-center">New Post</h5>
            <form action="post_action.php" method="post" accept-charset="utf-8">
            <form class="form-signin">
              <div class="form-label-group">
                <input type="text" id="subject" name="subject" class="form-control" placeholder="Subject" required autofocus>
                <label for="inputEmail">Subject</label>
              </div>

              <div class="form-label-group">
                <input type="text" id="message" name="message" class="form-control" placeholder="Message" required>
                <label for="inputPassword">Message</label>
              </div>

              
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Post It!</button>
                
             </form>
             </form>
        
        </div>
      </div>
    </div>
  </div>

<?php 
# Display footer section.
include ( 'includes/footer.html' ) ;
?>
