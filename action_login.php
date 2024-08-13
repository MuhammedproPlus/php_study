<?php
require_once './config.php';
require_once './firebaseRDB.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        // Initialize the FirebaseRDB class
        $db = new firebaseRDB($databaseURL);

        // Retrieve the user data from the Firebase Realtime Database
        $response = $db->retrieve('users');
        $response = json_decode($response, true);

        // Check if the response is an array and not null
        if (is_array($response)) {
            // Search for the user by email
            foreach ($response as $user) {
                if (isset($user['email']) && $user['email'] === $email) {
                    // Verify the password
                    if (password_verify($password, $user['password'])) {
                        // Successful login
                        echo '<script>alert("Login successful! Redirecting to homepage."); window.location.href = "index.php";</script>';
                        exit;
                    } else {
                        // Invalid password
                        echo '<script>alert("Invalid password. Please try again.");</script>';
                        exit;
                    }
                }
            }
            // User not found
            echo '<script>alert("No account found with this email. Please try again or sign up.");</script>';
        } else {
            // Response is not an array
            echo '<script>alert("Error retrieving user data. Please try again later.");</script>';
        }
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>
