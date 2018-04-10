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
      <a href="#!" class="brand-logo">All Assignments</a>
      <a href="#" data-activates="mobile-demo" class="button-collapse" onclick="self.close()"><i class="fa fa-arrow-left" aria-hidden="true" ></i></a>
      </div>
      </nav>

<ul class="collection">
<?php 
require 'config.php';

$sql="select * from assignments";
$query=mysqli_query($con,$sql);
while ($row=mysqli_fetch_array($query)) {
	# code...
	echo "<li class=collection-item><strong>".$row['branch']." ".$row['section']." ".$row['year']."     ".$row['about']."</strong>     <a href='".$row['link']."'>link</a></li>";
}
?>
</ul>
</body>
</html>