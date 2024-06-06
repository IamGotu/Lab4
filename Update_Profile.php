<?php 
// Include file for database connection
include('config/db_conn.php');
// Include file for authentication
include('Authentication.php');

//Updating Profile Picture(Start)
// Check if the request method is POST
if(isset($_POST['UpdatePicture'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Ensure fields are initialized
    $user_id = validate($_POST['user_id']);
    $profile_picture = validate($_POST['profile_picture']);

    $profile_picture = $_FILES['profile_picture']['name']; // Original file name

    $allowed_extension = array('png', 'jpg', 'jpeg');
    $file_extension = pathinfo($profile_picture, PATHINFO_EXTENSION);
    
    if(!in_array($file_extension, $allowed_extension)) {
        $_SESSION['status'] = "You are allowed with only jpg, png, jpeg image";
        header('Location: User_Profile.php');
        exit(0);
    }

    // Construct SQL query for updating user profile
    $update_sql = "UPDATE user_profile SET profile_picture = ? WHERE user_id = ?";

    // Bind parameters
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("si", $profile_picture, $user_id);

    // Execute stmt
    if ($stmt->execute()) {
        move_uploaded_file($_FILES['profile_picture']['tmp_name'], 'uploads/'.$profile_picture); // Move uploaded file with original name
            $_SESSION['status'] = "Profile Update Successfully"; // Set success message
            header('Location: User_Profile.php');
            exit(0);
        } else {
            $_SESSION['status'] = "Profile Picture Updating Failed";
            header('Location: User_Profile.php');
            exit(0);
            }
        } else {
        // Display an error message if the form was not submitted
        $_SESSION['status'] = "Update Failed";
        header("Location: User_Profile.php");
        exit(0);
}
//Updating Profile Picture(End)


//Updating User's Information(Start)
// Check if the request method is POST
if(isset($_POST['UpdateInfo'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Ensure fields are initialized
    $user_id = validate($_POST['user_id']);
    $full_name = validate($_POST['full_name']);
    $email = validate($_POST['email']);
    $birthdate = validate($_POST['birthdate']);
    $phone_number = validate($_POST['phone_number']);
    $address = validate($_POST['address']);

    // Construct SQL query for updating user profile
    $update_sql = "UPDATE user_profile SET full_name = ?, phone_number = ?, address = ?, WHERE user_id = ?";

    // Bind parameters
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("sssi", $full_name, $phone_number, $address, $user_id);
    
    // Execute stmt
    if ($stmt->execute()) {
        $_SESSION['status'] = "User Information Updated Successfully";
        header('Location: User_Profile.php');
        exit(0);
        }
    } else {
    // Display an error message if the form was not submitted
    $_SESSION['status'] = "User Information Update Failed";
    header("Location: User_Profile.php");
    exit(0);
    }
//Updating User's Information(End)


//Update Birthdate(Start)
// Check if the request method is POST
if(isset($_POST['UpdateBirthdate'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Ensure fields are initialized
    $user_id = $_POST['user_id'];
    $birthdate = $_POST['birthdate'];

    // Calculate age
    $birthday = new DateTime($birthdate);
    $currentDate = new DateTime();
    $age = $currentDate->diff($birthday)->y;

    // Check if age is less than 14
    if ($age < 14) {
        $_SESSION['status'] = "Only 14 years old or above are allowed.";
        header("Location: User_Profile.php?error=Only 14 years old or above are allowed.");
        exit();
    } else {
    // Convert DateTime object to string for SQL
    $birthdateStr = $birthday->format('Y-m-d');

    // Construct SQL query for updating user profile
    $update_sql = "UPDATE user_profile SET birthdate = ? WHERE user_id = ?";

    // Bind parameters
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("si", $birthdateStr, $user_id);
    
    // Execute stmt
    if ($stmt->execute()) {
        $_SESSION['status'] = "Birthdate Update Successfully";
        header('Location: User_Profile.php');
        exit(0);
        }
    }
} else {
    // Display an error message if the form was not submitted
    $_SESSION['status'] = "Birthdate Update Failed";
    header("Location: User_Profile.php");
    exit(0);
}
//Update Birthdate(End)


//Update Password(Start)
// Check if the request method is POST
if(isset($_POST['UpdatePass'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Ensure fields are initialized
    $user_id = $_POST['user_id'];
    $password = $_POST['password'];

    // Construct SQL query for updating user profile
    $update_sql = "UPDATE user_profile SET password = ? WHERE user_id = ?";

    // Bind parameters
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("si", $password, $user_id);
    
    // Execute stmt
    if ($stmt->execute()) {
        $_SESSION['status'] = "Password Update Successfully";
        header('Location: User_Profile.php');
        exit(0);
        }
    } else {
    // Display an error message if the form was not submitted
    $_SESSION['status'] = "Password Update Failed";
    header("Location: User_Profile.php");
    exit(0);
}
//Update password(End)

?>

