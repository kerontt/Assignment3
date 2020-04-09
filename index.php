<?php 

require 'connect_db.php';
?>

<html>
<head>


  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <!-- popper js  -->
   <script src="https://cloufflare.com/ajax/libs/popper.js/1.14.6/udm/popper.min.js"></script>

  <!-- latest JS code -->
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
  
  
  <Title>Ajax query page</Title>
</head>

<body>
<h3 class="text-center text-light bg-info p-2"> Advanced filter using bootstrap 4, Php and Ajax</h3>
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-3">
				<h5>Filter Product</h5>
				<hr>
				<h6 class="text-info">Select Name</h6>
				<ul class="list-group">
			<?php 
				$sql="SELECT * item_name FROM shop ORDER BY item_name";
				$result=$conn->query($sql);
				while($row=$result->fetch_assoc()){
			?>
				<li class="list-group-item">
					<div class="form-check">
						<label class="form-check-label">
							<input type="checkbox" class="form-check-input product_check" value="<?= $row['item_name']; ?>" id="item_name"><?= $row['item_name']; ?>
						</label>
					</div>
					</li>
					<?php } ?>
				</ul>
				</div>
				<div class="col-lg-9">
				</div>
			</div>
		</div>
</body>
</html>