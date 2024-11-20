<?php
include('storage.php'); // Helyesen importáljuk a CardStorage osztályt
$card_storage = new CardStorage();

// Szűrés
$filter = $_GET['filter'] ?? '';
$cards = $card_storage->findAll();
if ($filter) {
    $cards = array_filter($cards, function ($card) use ($filter) {
        return stripos($card['name'], $filter) !== false || 
               stripos($card['note'] ?? '', $filter) !== false;
    });
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Névjegyzék</title>
</head>
<body>
    <h1>Névjegyzék</h1>

    <form action="" method="get">
        Szűrő szöveg: <input type="text" name="filter" value="<?= htmlspecialchars($filter) ?>">
        <button type="submit">Szűr</button>
    </form>

    <table border="1">
        <tr>
            <th>Név</th>
            <th>Email</th>
            <th>Telefon</th>
            <th>Műveletek</th>
        </tr>
        <?php foreach ($cards as $id => $card): ?>
            <tr>
                <td><?= htmlspecialchars($card['name']) ?></td>
                <td><?= htmlspecialchars(implode(', ', $card['emails'] ?? [])) ?></td>
                <td><?= htmlspecialchars($card['phone'] ?? '') ?></td>
                <td>
                    <a href="modify.php?id=<?= $id ?>">Módosítás</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <a href="create.php">Új névjegy</a>
</body>
</html>
