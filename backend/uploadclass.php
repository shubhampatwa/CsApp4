 <?php
require 'config.php';
// $con=mysqli_connect("localhost","root","","amisha") or die(mysqli_error());
 //echo "connected";
if (isset($_POST['submit'])) {
    if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
        echo "<h1>" . "File ". $_FILES['filename']['name'] ." uploaded successfully." . "</h1>";
        echo "<h2>Displaying contents:</h2>";
        readfile($_FILES['filename']['tmp_name']);
    }

    //Import uploaded file to Database
    $handle = fopen($_FILES['filename']['tmp_name'], "r");
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $import="INSERT into student_rollno(id,roll_no,name,branch,section,year) values(NULL,'$data[0]','$data[1]','".$_POST['branch']."','".$_POST['section']."','".$_POST['year']."')";
        mysqli_query($con,$import) or die(mysqli_error());
    }
    fclose($handle);
    print "Import done";
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
      <a href="#!" class="brand-logo">Upload Class</a>
      <a href="#" data-activates="mobile-demo" class="button-collapse" onclick="self.close()"><i class="fa fa-arrow-left" ></i></a>
      </div>
      </nav> 

<form enctype='multipart/form-data' action='uploadclass.php' method='POST'>

<label>branch</label><input type="text" name="branch" placeholder="cs" required></input>
<label>section</label><input type="number" name="section" placeholder="2" required></input>
<label>year</label><input type="number" name="year" placeholder="1" required></input>
<input type="file" size="100" placeholder="csv file" name="filename" required></input>
<button type="submit" name="submit" class="btn-large waves-effect waves-light blue modal-trigger">upload</button>
</form>
</body>
</html>
