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
      <a href="#!" class="brand-logo">Fetch Attendance</a>
      <a href="#" data-activates="mobile-demo" class="button-collapse" onclick="self.close()"><i class="fa fa-arrow-left" aria-hidden="true" ></i></a>
      </div>
      </nav>
<form method="POST" action="fetchattendance.php">
<input type=text name=branch placeholder="branch eg: cs " required></input>
<input type=text name=section placeholder="section eg:1" required></input>
<input type=text name=year placeholder="year eg:4" required></input>
<button type="submit" name="submit" class="btn-large waves-effect waves-light blue modal-trigger">fetch student</button>
</form>

<ul class="collection">
<?php 
require 'config.php';
if(isset($_POST['submit']))
{
	$branch=$_POST['branch'];$section=$_POST['section'];$year=$_POST['year'];
$sql="select rollno,count(*) from attendance where branch='".$branch."' and section='".$section."' and year='".$year."' group by rollno";
//echo $sql;
echo "rollno and attendance";
$query=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($query))
{
	echo "<li class=collection-item>".$row[0]." ".$row[1]."</li>";
}

}
?>

</ul>
</body>
</html>