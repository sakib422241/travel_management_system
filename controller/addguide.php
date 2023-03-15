<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add-guide'])) {
    $data = json_decode(file_get_contents(__DIR__.'/../model/guides.json'), true);

    $newGuide = array(
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'expertise' => explode(',', $_POST['expertise']),
        'upcomingTours' => explode(',', $_POST['upcoming-tours']),
        'ratings' => explode(',', $_POST['ratings']),
        'reviews' => explode(',', $_POST['reviews']),
    );
    $data[] = $newGuide;

    file_put_contents(__DIR__.'/../model/guides.json', json_encode($data));

    header('Location: ../view/guides.html');
    exit();
}
?>

<?php
// Read the contents of guides.json file
$json = file_get_contents(__DIR__.'/../model/guides.json');

// If file_get_contents fails, print an error message and exit
if ($json === false) {
    echo "Failed to read guides.json file";
    exit();
}

// Decode the JSON data into an associative array
$guides = json_decode($json, true);

// If json_decode encounters an error, print an error message and exit
if (json_last_error() !== JSON_ERROR_NONE) {
    echo "Failed to parse guides.json file";
    exit();
}

// Add the new guide to the guides array
$guides[] = $_POST;

// Encode the guides array back into JSON format
$json = json_encode($guides, JSON_PRETTY_PRINT);

// Write the updated JSON data back to the guides.json file
if (file_put_contents(__DIR__.'/../model/guides.json', $json)) {
    echo "Guide added successfully!";
} else {
    echo "Failed to add guide";
}
?>
