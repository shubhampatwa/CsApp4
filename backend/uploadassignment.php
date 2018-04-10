 <?php
require 'config.php';
if (isset($_POST['submit'])) {
    # code...
$offset=5*60*60+30*60;
          $newfile=gmdate('Ymdhisa',time()+$offset);
  //        echo $newfile;
//echo basename($_FILES["fileToUpload"]["name"]);
$str=explode(".", basename($_FILES["fileToUpload"]["name"]));
//echo $str[1];
$target_dir = "uploads/";
$target_file = $target_dir . $newfile.".".$str[1];

$uploadOk = 1;
//$FileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
    // $check = getfilesize($_FILES["fileToUpload"]["tmp_name"]);
    // if($check !== false) {
    //     echo "File is an image - " . $check["mime"] . ".";
    //     $uploadOk = 1;
    // } else {
    //     echo "File is not an image.";
    //     $uploadOk = 0;
    // }

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
// if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
// && $imageFileType != "gif" ) {
//     echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
//     $uploadOk = 0;
// }
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
          //rename(basename($_FILES["fileToUpload"]["name"]), $newfile);
    
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        $sql="insert into assignments(id,branch,section,year,subject,about,link) values(NULL,'".$_POST['branch']."','".$_POST['section']."','".$_POST['year']."','".$_POST['subject']."','".$_POST['about']."','".$target_file."')";
        mysqli_query($con,$sql);

    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
}
?>
<!DOCTYPE html>
<html>

<head>
	 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  
    <title>Upload Assignment</title>
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
      <a href="#!" class="brand-logo">Upload Assignment</a>
      <a href="#" data-activates="mobile-demo" class="button-collapse" onclick="self.close()"><i class="fa fa-arrow-left" ></i></a>
      </div>
      </nav> <form enctype='multipart/form-data' action='uploadassignment.php' method='post'>

<label>branch</label><input type="text" name="branch" placeholder="cs"></input>
<label>section</label><input type="number" name="section" placeholder="2"></input>
<label>year</label><input type="number" name="year" placeholder="1"></input>
<label>subject</label><input type="text" name="subject" placeholder="1"></input>
<label>about assignment</label><textarea id="textarea1" name="about"  class="materialize-textarea" required></textarea>
<input type="file" size="100" placeholder="csv file" name="fileToUpload"></input>
<button type="submit" name="submit" class="btn-large waves-effect waves-light blue modal-trigger" >upload</button>
</form>
</body>
</html>

