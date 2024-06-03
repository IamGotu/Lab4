<?php
session_start();

include('Authentication.php');
include('config/db_conn.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

if (isset($_POST['signup_btn'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $full_name = validate($_POST['full_name']);
    $email = validate($_POST['email']);
    $phone_number = validate($_POST['phone_number']);
    $address = validate($_POST['address']);
    $password = validate($_POST['password']);
    $Status = validate($_POST['Status']);
    $Active = validate($_POST['Active']);
    $profile_picture = validate ($_FILES['profile_picture']['name']);
    $profile_picture = 'user.png'; // Set default value
    $Status = 'Not Verified'; // Set default value
    $Active = 'Not Active'; // Set default value

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['status'] = "Invalid email format.";
        header("Location: signupform.php?error=Invalid email format");
        exit();
    }

    // Check if the email already exists in the database
    $sql_check_email = "SELECT * FROM user_profile WHERE email='$email'";
    $result_check_email = mysqli_query($conn, $sql_check_email);
    if (mysqli_num_rows($result_check_email) > 0) {
        $_SESSION['status'] = "Email already exists.";
        header("Location: signupform.php?error=Email already exists");
        exit();
    }

    // Generate a unique verification token
    $verify_token = bin2hex(random_bytes(2));

    // Insert user data into the database
    $insert_query = "INSERT INTO user_profile (full_name, email, phone_number, address, password, profile_picture, Status, Active, verify_token)
    VALUES ('$full_name', '$email', '$phone_number', '$address', '$password', '$profile_picture', '$Status', '$Active', '$verify_token')";

    if (mysqli_query($conn, $insert_query)) {

        // Send verification email
        $subject = "Email Verification";
        $message = "Hello, $full_name. Your verification code is: $verify_token";

        // Create a PHPMailer instance
        $mail = new PHPMailer(true);

        try {
            // SMTP configuration
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'cocnambawan@gmail.com'; // Your gmail
            $mail->Password = 'bkvm sirf keww nswm'; // Your gmail app password
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            // Sender and recipient
            $mail->setFrom('cocnambawan@gmail.com', 'Email Verification');
            $mail->addAddress($email);

            // Email content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $message;

            // Send email
            $mail->send();

            // Redirect with a success message
            header("Location: VerifyEmail.php?email=$email");
            exit();
        } catch (Exception $e) {
            // Display an error message if the verification email could not be sent
            $_SESSION['status'] = "Verification email could not be sent. Please try again later.";
            header("Location: signupform.php?error=Verification email could not be sent. Please try again later.");
            exit();
        }
    } else {
        // Display an error message if the query fails
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>