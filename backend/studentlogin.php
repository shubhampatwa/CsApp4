<?php
require_once 'include/db_studentfunctions.php';
$db = new DB_Functions();
 
// json response array
$response = array("error" => FALSE);
 
if (isset($_POST['enroll']) && isset($_POST['password'])) {
 
    // receiving the post params
    $enroll = $_POST['enroll'];
    $password = $_POST['password'];
 
    // get the user by enroll and password
    $user = $db->getUserByenrollAndPassword($enroll, $password);
 
    if ($user != false) {
        // use is found
        $response["error"] = FALSE;
        $response["uid"] = $user["unique_id"];
        $response["user"]["name"] = $user["name"];
        $response["user"]["enroll"] = $user["enroll"];
        $response["user"]["created_at"] = $user["created_at"];
        $response["user"]["updated_at"] = $user["updated_at"];
        echo json_encode($response);
    } else {
        // user is not found with the credentials
        $response["error"] = TRUE;
        $response["error_msg"] = "Login credentials are wrong. Please try again!";
        echo json_encode($response);
    }
} else {
    // required post params is missing
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters enroll or password is missing!";
    echo json_encode($response);
}
?>