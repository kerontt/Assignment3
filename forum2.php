<?php # DISPLAY COMPLETE FORUM PAGE.

# Access session.
session_start() ;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

# Set page title and display header section.
$page_title = 'Forum' ;
include ( 'includes/header.html' ) ;
include ( 'includes/menu.html' ) ;

# Create navigation links.
echo '<div class="mainnav"><p><a href="post.php">Post Message</a> | <a href="goodbye.php">Logout</a></p></div>' ;


# Open database connection.
require ( 'connect_db.php' ) ;

# Display body section, retrieving from 'forum' database table.
$q = "SELECT * FROM forum" ;
$r = mysqli_query( $dbc, $q ) ;



if ( mysqli_num_rows( $r ) > 0 )
{
    
    
    while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
    {
        
        echo'<div class="container-fluid mt-100">
      <div class="row">
      <div class="col-md-12">
      <div class="card mb-4">
      <div class="card-header">
      <div class="media flex-wrap w-100 align-items-center"> <img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1574583246/AAA/2.jpg" class="d-block ui-w-40 rounded-circle" alt="">
      <div class="media-body ml-3"> <a href="javascript:void(0)" data-abc="true">' . $row['first_name'] .' '. $row['last_name'] . '</a>
          
      </div>
      <div class="text-muted small ml-3">
      <div>Post Date:<strong>'. $row['post_date'].'</strong></div>
      <div><strong><a href="#">Like Post</a></strong></div>
          
      </div>
      </div>
      <div class="card-body">
      <h4> ' . $row['subject'] . '</h4>
      <p> ' . $row['message'] . '</p>
      </div>
      <div class="card-footer d-flex flex-wrap justify-content-between align-items-center px-0 pt-0 pb-3">
      <div class="px-4 pt-3"> <a href="javascript:void(0)" class="text-muted d-inline-flex align-items-center align-middle" data-abc="true"> <i class="fa fa-heart text-danger"></i>&nbsp; <span class="align-middle">445</span> </a> <span class="text-muted d-inline-flex align-items-center align-middle ml-4"> <i class="fa fa-eye text-muted fsize-3"></i>&nbsp; <span class="align-middle">14532</span> </span> </div>
      <div class="px-4 pt-3"> <button type="button" class="btn btn-primary"><i class="ion ion-md-create"></i>&nbsp; Reply</button> </div>
      </div>
      </div>
      </div>
      </div>
      </div>';
        
        
        
    }
    echo '</div>' ;
}
else { echo '<p>There are currently no messages.</p>' ; }


# Close database connection.
mysqli_close( $dbc ) ;

# Display footer section.
include ( 'includes/footer.html' ) ;

?>