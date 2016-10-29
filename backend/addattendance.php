<?php 
require 'config.php';
if(isset($_POST['submit']))
{
//	$con=mysqli_connect("localhost","root","","amisha") or die(mysqli_error());
	$val=$_POST['student'];
	$branch=$_POST['branch'];
	$section=$_POST['section'];
	$year=$_POST['year'];
	$lecture=$_POST['lecture'];
	$subject=$_POST['subject'];
	$count=0;
//echo $_POST['branch'],$_POST['section'],$_POST['year'];
	foreach ($val as $rollno) {
		# code...
		$sql="INSERT INTO `attendance` (`id`, `rollno`, `branch`, `section`, `year`, `lecture`, `subject`, `day`) VALUES (NULL,'".$rollno."','".$branch."','".$section."','".$year."','".$lecture."','".$subject."','".date("Y-m-d")."')";
		
		mysqli_query($con,$sql);
		$count++;
	}
	
}

 ?>
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
  </style>
</head>
<body>
<nav>
    <div class="nav-wrapper">
      <a href="#!" class="brand-logo">Attendance</a>
      <a href="#" data-activates="mobile-demo" class="button-collapse" onclick="self.close()"><i class="fa fa-arrow-left" ></i></a>
      </div>
      </nav> 
      <?php echo "Total Student".$count." Present";
?>
 </body>
 </html>