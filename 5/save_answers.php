<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $age = intval($_POST['age']);
    $feedback = htmlspecialchars($_POST['feedback']);

    $data = [
        'name' => $name,
        'age' => $age,
        'feedback' => $feedback
    ];

    $file = 'answers.json';

    $existingData = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
    $existingData[] = $data;

    file_put_contents($file, json_encode($existingData, JSON_PRETTY_PRINT));
    echo "Válaszok mentve! <a href='show_answers.php'>Válaszok megtekintése</a>";
}
?>
