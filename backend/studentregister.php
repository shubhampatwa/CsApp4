<?php
    require_once 'include/db_studentfunctions.php';
    $db = new DB_Functions(); 
 
// json response array
$response = array("error" => FALSE);
 
if (isset($_POST['name']) && isset($_POST['enroll']) && isset($_POST['password'])) {
    // receiving the post params
    $name = $_POST['name'];
    $enroll = $_POST['enroll'];
    $password = $_POST['password'];
 
    // check if user is already existed with the same enroll
    if ($db->isUserExisted($enroll)) {
        // user already existed
        $response["error"] = TRUE;
        $response["error_msg"] = "User already existed with " . $enroll;
        echo json_encode($response);
    } else {
        // create a new user
        $user = $db->storeUser($name, $enroll, $password);
        if ($user) {
            // user stored successfully
            $response["error"] = FALSE;
            $response["uid"] = $user["unique_id"];
            $response["user"]["name"] = $user["name"];
            $response["user"]["enroll"] = $user["enroll"];
            $response["user"]["created_at"] = $user["created_at"];
            $response["user"]["updated_at"] = $user["updated_at"];
            echo json_encode($response);
        } else {
            // user failed to store
            $response["error"] = TRUE;
            $response["error_msg"] = "Unknown error occurred in registration!";
            echo json_encode($response);
        }
    }
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters (name, enroll or password) is missing!";
    echo json_encode($response);
}

?>
