<?php
require 'config.php';
//$con=mysqli_connect("localhost","root","","amisha") or die(mysqli_error());
$response=array();
$response['error']=false;

if($_GET['branch'] && $_GET['section'] && $_GET['year'] )
{
$sql="Select * from student_rollno where branch='".$_GET['branch']."' and section='".$_GET['section']."' and year='".$_GET['year']."'";
$query=mysqli_query($con,$sql);
$exists=mysqli_num_rows($query);
if($exists>0)
{
$i=0;
while ($row=mysqli_fetch_array($query)) {
	# code...
	//echo $row['roll_no'];
	$response[$i++]=$row['roll_no'];
}
}
else{
	$response['error']=true;
}
echo json_encode($response);


}
?>
