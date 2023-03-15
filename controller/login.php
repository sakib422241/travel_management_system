<?php
// Start the session
session_start();

// Check if the user is already logged in
if (isset($_SESSION['username'])) {
 // Redirect to the dashboard page
 header('Location: dashboard.php');
 exit;
}

// Check if the login form has been submitted
if (isset($_POST['login'])) {
 // Retrieve the username and password from the form data
 $username = $_POST['username'];
 $password = $_POST['password'];

 // Load the user credentials from the JSON file
 $users = json_decode(file_get_contents(__DIR__ . '/../model/users.json'), true);

 // Check if the user with the given username and password exists in the JSON file
 foreach ($users as $user) {
  if ($user['username'] === $username && $user['password'] === $password) {
   // Set the username in the session
   $_SESSION['username'] = $username;

   // Set a cookie to remember the user
   setcookie('username', $username, time() + 3600 * 24 * 30);

   // Redirect to the dashboard page
   header('Location: dashboard.php');
   exit;
  }
 }

 // If the user does not exist, display an error message
 echo "Invalid username or password.";
}

// If the login form has not been submitted, display the form
include __DIR__ . '/../view/login.html';
?>
