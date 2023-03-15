<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page
    header('Location: login.php');
    exit;
}

// Display the username from the session
echo 'Welcome, ' . $_SESSION['username'] . '!';

// Display the cookie data
if (isset($_COOKIE['username'])) {
    echo '<br>Cookie is set: ' . $_COOKIE['username'];
}
?>

<body>
<h1>Welcome to the Travel Management System Dashboard</h1>
<div class="category-container">
    <h2>Guide Information</h2>
    <p>Here you can view and manage information about tour guides.</p>
    <!-- Add your guide information section here -->
    <a href='/mid/view/guides.html' class="button">Click me!</a>
</div>
<div class="category-container">
    <h2>Tourist Information</h2>
    <p>Here you can view and manage information about tourists.</p>
    <!-- Add your tourist information section here -->
</div>
<div class="category-container">
    <h2>Employee Information</h2>
    <p>Here you can view and manage information about employees.</p>
    <!-- Add your employee information section here -->
</div>
<!-- Add your additional categories here -->
<form action="/mid/controller/logout.php" method="POST">
    <button type="submit" name="logout">Logout</button>
</form>
</body>
