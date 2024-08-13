<?php
require_once './config.php';
require_once './firebaseRDB.php';

$registrationSuccess = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phoneNumber = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirmPassword) {
        echo '<script>alert("Passwords do not match. Please try again."); window.location.href = "register.php";</script>';
        exit;
    }

    try {
        // Initialize the FirebaseRDB class
        $db = new firebaseRDB($databaseURL);

        // Retrieve all users to check if the email already exists
        $response = $db->retrieve('users');
        $response = json_decode($response, true);

        // Check if the response is an array and not null
        if (is_array($response)) {
            foreach ($response as $user) {
                if (isset($user['email']) && $user['email'] === $email) {
                    // Email already exists
                    echo '<script>alert("User already exists with this email. Please use a different email or login."); window.location.href = "register.php";</script>';
                    exit;
                }
            }
        }

        // Hash the password before storing it
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Create an array with the user data
        $userData = [
            'name' => $name,
            'address' => $address,
            'phone' => $phoneNumber,
            'email' => $email,
            'password' => $hashedPassword,
        ];

        // Insert the user data into the Firebase Realtime Database
        $response = $db->insert('users', $userData);

        // Decode the response to check if the operation was successful
        $response = json_decode($response, true);

        if ($response && isset($response['name'])) {
            // Successful registration
            echo '<script>alert("Register successful! Redirecting to Login page."); window.location.href = "login.php";</script>';
            exit;
        } else {
            // Registration failed, redirect back to the registration page
            echo '<script>alert("Registration failed. Please try again."); window.location.href = "register.php";</script>';
            exit;
        }
    } catch (Exception $e) {
        echo '<script>alert("Error: ' . $e->getMessage() . '"); window.location.href = "register.php";</script>';
        exit;
    }
}
?>
