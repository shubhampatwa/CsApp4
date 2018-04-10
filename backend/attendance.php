<!DOCTYPE html>
<html>
<head>
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
  [type="checkbox"]:not(:checked), [type="checkbox"]:checked {
    position: relative!important;
    opacity: 1;
    left: 20px;
  }
  </style>
</head>
<body>
<nav>
    <div class="nav-wrapper">
      <a href="#!" class="brand-logo">Attendance</a>
      <a href="#" data-activates="mobile-demo" class="button-collapse" ><i class="fa fa-arrow-left" ></i></a>
      </div>
      </nav>
<form method="POST" action="attendance.php">
<input type=text name=branch placeholder="branch eg: cs " required></input>
<input type=text name=section placeholder="section eg:1" required></input>
<input type=text name=year placeholder="year eg:4" required></input>
<button type="submit" class="btn-large waves-effect waves-light blue modal-trigger">fetch student</button>
</form>
</body>
</html>
<?php 
require 'config.php';
$branch="";$section="";$year="";
if(isset($_POST['branch']) && isset($_POST['section']) && isset($_POST['year']))
{
	$branch=$_POST['branch'];$section=$_POST['section'];$year=$_POST['year'];
	$sql="Select * from student_rollno where branch='".$branch."' and section='".$section."' and year='".$year."'";
	$query=mysqli_query($con,$sql);
$i=0;
echo "<form method=POST action=addattendance.php>";
echo "<input type=number name=lecture placeholder=lecture eg:2 required></input>";
echo "<input type=text name=subject placeholder=subject eg:ds  required></input>";
echo "<input  type=text name=branch value=$branch></input>
<input  type=text name=section value=$section></input>
<input  type=text name=year value=$year></input><ul>";


while ($row=mysqli_fetch_array($query)) {
	# code...
	echo "<li id='".$i."'>".$row['roll_no'];?>

	<input type="checkbox" name="student[]" value="<?php echo $row['roll_no']; ?>" >
	<?php echo "</li>";
	$i++;
}
echo "<button type=submit name=submit class=btn-large waves-effect waves-light blue modal-trigger>upload Attendance</button></ul></form>";
}
 ?>

