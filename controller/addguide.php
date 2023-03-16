<!DOCTYPE html>
<html>
<head>
    <title>Input Form</title>
</head>
<body>
<form method="post">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name"><br>
    <label for="email">Email:</label>
    <input type="email" name="email" id="email"><br>
    <label for="phone">Phone:</label>
    <input type="tel" name="phone" id="phone"><br>
    <label for="expertise">Expertise:</label>
    <select name="expertise" id="expertise">
        <option value="Beginner">Beginner</option>
        <option value="Intermediate">Intermediate</option>
        <option value="Expert">Expert</option>
    </select><br>
    <label for="upcomingtours">Upcoming Tours:</label>
    <input type="text" name="upcomingtours" id="upcomingtours"><br>
    <label for="ratings">Ratings:</label>
    <input type="number" name="ratings" id="ratings" min="1" max="5"><br>
    <label for="reviews">Reviews:</label>
    <textarea name="reviews" id="reviews"></textarea><br>
    <input type="submit" value="Save">
</form>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the user's input values
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $expertise = $_POST['expertise'];

    // Check if the "upcomingtours" key exists in the $_POST array
    if (isset($_POST['upcomingtours'])) {
        $upcomingtours = $_POST['upcomingtours'];
    } else {
        $upcomingtours = '';
    }

    $ratings = $_POST['ratings'];
    $reviews = $_POST['reviews'];

    // Read the existing data from the file
    $file = '../model/guides.json';
    $json = file_get_contents($file);
    $data = json_decode($json, true);

    // Create a new array with the input data
    $newData = array(
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'expertise' => $expertise,
        'upcomingtours' => $upcomingtours,
        'ratings' => $ratings,
        'reviews' => $reviews
    );

    // Add the new data to the existing array
    $data[] = $newData;

    // Encode the updated array as JSON
    $json = json_encode($data);

    // Write the updated JSON data to the file
    file_put_contents($file, $json);
}

// Read the updated data from the file
$json = file_get_contents($file);
$data = json_decode($json, true);

// Display the data in a table format
echo "<table>";
echo "<tr><th>Name</th><th>Email</th><th>Phone</th><th>Expertise</th><th>Upcoming Tours</th><th>Ratings</th><th>Reviews</th></tr>";
foreach ($data as $item) {
    echo "<tr>";
    echo "<td>".$item['name']."</td>";
    echo "<td>".$item['email']."</td>";
    echo "<td>".$item['phone']."</td>";
    echo "<td>".$item['expertise']."</td>";
    echo "<td>".$item['upcomingtours']."</td>";
    echo "<td>".$item['ratings']."</td>";
    echo "<td>".$item['reviews']."</td>";
    echo "</tr>";
}
echo "</table>";

?>


</body>
</html>
