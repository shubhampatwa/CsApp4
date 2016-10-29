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
      <a href="#!" class="brand-logo">Submit Assignment</a>
      <a href="#" data-activates="mobile-demo" class="button-collapse" onclick="self.close()"><i class="fa fa-arrow-left" ></i></a>
      </div>
      </nav>
      


<?php
require 'config.php'; 
if(isset($_GET['rollno']))
{
	//echo $_GET['rollno'];
	$branch="";$section="";$year="";
	$sql="select * from student_rollno where roll_no='".$_GET['rollno']."'";
	$query1=mysqli_query($con,$sql);
  $rollno=$_GET['rollno'];
	while($row=mysqli_fetch_array($query1))
	{
		$branch=$row['branch'];
		$section=$row['section'];
		$year=$row['year'];
	}
echo "<form enctype='multipart/form-data' method=POST action=submitassignment.php>";
echo "<input type=text name=subject placeholder=subject eg:ds  required></input>";
echo "<input  type=text name=branch value=$branch></input>
<input  type=text name=section value=$section></input>
<input  type=text name=year value=$year></input>
<input  type=text name=rollno value=$rollno></input>
<input type=file size=100 name=upload></input>
<button type=submit name=submit class=btn-large waves-effect waves-light blue modal-trigger >upload Assignment</button>
      </form>";
}
?>
<?php
if (isset($_POST['submit'])) {
    # code...
$offset=5*60*60+30*60;
$newfile=gmdate('Ymdhisa',time()+$offset);
// echo $_POST['rollno'];
// echo basename($_FILES["upload"]["name"]);
$str=explode(".", basename($_FILES["upload"]["name"]));
//echo $str[1];
$target_dir = "uploads/";
$target_file = $target_dir . $newfile.".".$str[1];

$uploadOk = 1;
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["upload"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
          //rename(basename($_FILES["upload"]["name"]), $newfile);
    
    if (move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file)) {
        //echo "The file ". basename( $_FILES["upload"]["name"]). " has been uploaded.";
        $sql="insert into submitassignments(id,branch,section,year,subject,rollno,link) values(NULL,'".$_POST['branch']."','".$_POST['section']."','".$_POST['year']."','".$_POST['subject']."','".$_POST['rollno']."','".$target_file."')";
        mysqli_query($con,$sql);

    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
}
?>
</ul>
</body>
</html>