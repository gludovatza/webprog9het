<?php
$file = 'answers.json';

if (file_exists($file)) {
    $answers = json_decode(file_get_contents($file), true);

    echo "<table border='1'>";
    echo "<tr><th>Név</th><th>Kor</th><th>Visszajelzés</th></tr>";

    foreach ($answers as $answer) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($answer['name']) . "</td>";
        echo "<td>" . intval($answer['age']) . "</td>";
        echo "<td>" . htmlspecialchars($answer['feedback']) . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Nincsenek válaszok.";
}
?>
