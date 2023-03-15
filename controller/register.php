<?php
if (isset($_POST['register'])) {
  // Get user input and sanitize data
  $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
  $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

  // Validate user input
  $errors = array();
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format";
  }
  // add more validation checks as needed

  // If there are validation errors, display them to the user
  if (count($errors) > 0) {
    foreach ($errors as $error) {
      echo $error . "<br>";
    }
    // display registration form again with the user's input pre-filled
    // and show the errors to the user
    include("view/registration.html");
  } else {
    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Create user object
    $user = array(
        "username" => $username,
        "email" => $email,
        "password" => $password
    );

    // Add user object to JSON file
    $users = json_decode(file_get_contents(__DIR__."/../model/users.json"), true);
    $users[] = $user;
    file_put_contents(__DIR__."/../model/users.json", json_encode($users));

    // Redirect user to login page
    include __DIR__ . '/../view/login.html';
    exit();
  }
}

