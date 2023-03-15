<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $index = $_POST['index'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $expertise = explode(',', $_POST['expertise']);
    $upcomingTours = explode(',', $_POST['upcoming-tours']);

    $guides = json_decode(file_get_contents('model/guides.json'), true);
    $guides[$index] = array(
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'expertise' => $expertise,
        'upcomingTours' => $upcomingTours,
        'ratings' => $guides[$index]['ratings'],
        'reviews' => $guides[$index]['reviews']
    );

    file_put_contents('model/guides.json', json_encode($guides));

    header('Location: view/guides.html');
    exit;
}
?>
