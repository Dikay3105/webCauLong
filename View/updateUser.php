<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    require_once __DIR__ . '../../Model/ModelUser.php';

    $modelUser = new ModelUser();
    
    // Check if all required parameters are present
    if (isset($_GET['userID'], $_GET['username'], $_GET['name'], $_GET['email'], $_GET['phoneNumber'], $_GET['point'], $_GET['role'], $_GET['type'])) {
        // Extract parameters from $_GET array
        $userID = $_GET['userID'];
        $username = $_GET['username'];
        $name = $_GET['name'];
        $email = $_GET['email'];
        $phoneNumber = $_GET['phoneNumber'];
        $point = $_GET['point'];
        $role = $_GET['role'];
        $type = $_GET['type'];

        // Call the updateUser method
        $updateSuccess = $modelUser->updateUser($userID, $username, '', $role, $name, $email, $phoneNumber, $point, $type, 1);

        // Check if the update was successful
        if ($updateSuccess) {
            echo "User updated successfully";
        } else {
            echo "Error updating user";
        }
    } else {
        // Handle case where required parameters are missing
        echo "Missing required parameters";
    }
}
?>
