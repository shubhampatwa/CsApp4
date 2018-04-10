<!DOCTYPE html>
<html>
<head>
	 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
	<title></title>
	<meta name="theme-color" content="#3D5AFE">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css">
<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  <!-- Compiled and minified JavaScript -->
 <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		// body...
	$(".button-collapse").sideNav();
	});
</script>
  <style type="text/css">
  .nav-wrapper{
  	background-color: #3D5AFE;
  }
  .fa{
  	color:white;
  	/*background-color: white;*/
  }
  .blue{
  	background-color: #3D5AFE;
  }
  </style>
</head>
<body>
<nav>
    <div class="nav-wrapper">
      <a href="#!" class="brand-logo">News</a>
      <a href="#" data-activates="mobile-demo" class="button-collapse" onclick="self.close()"><i class="fa fa-arrow-left" aria-hidden="true" ></i></a>
      </div>
      </nav>
<form method="POST" action="news.php">
	  <div class="row">
        <div class="input-field col s12">
          <textarea id="textarea1" name="news" class="materialize-textarea" required></textarea>
          <label for="textarea1">News</label>
        </div>
      </div>
	<button type="submit" class="btn-large waves-effect waves-light blue modal-trigger" name="submit">upload news</button>
</form>
</body>
</html>
<?php 
require 'config.php';
if(isset($_POST['submit'])) {
	# code...
	//$con=mysqli_connect("localhost","root","","amisha") or die(mysqli_error());
	// (NULL, 'hakjfkfdhkjdf');
	$sql="INSERT INTO `news` (`id`, `news`) VALUES (NULL,'".$_POST['news']."')";
	mysqli_query($con,$sql);
	echo "added sucessfully";
}

?>