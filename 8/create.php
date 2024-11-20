<?php
include('storage.php');

$card_storage = new CardStorage();
$errors = [];
$data = [
    'name' => '',
    'emails' => [],
    'phone' => '',
    'note' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Alapadatok validációja
    $data['name'] = trim($_POST['name'] ?? '');
    $data['emails'] = array_map('trim', explode(',', $_POST['emails'] ?? ''));
    $data['phone'] = trim($_POST['phone'] ?? '');
    $data['note'] = trim($_POST['note'] ?? '');

    if (empty($data['name'])) {
        $errors['name'] = 'A név megadása kötelező.';
    }

    if (empty($data['emails']) || !filter_var($data['emails'][0], FILTER_VALIDATE_EMAIL)) {
        $errors['emails'] = 'Legalább egy érvényes email címet meg kell adni.';
    }

    if (empty($errors)) {
        // Mentés
        $cards = $card_storage->findAll();
        $cards[] = $data;
        $card_storage->save($cards);

        // Átirányítás a listázó oldalra
        header('Location: index.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Új névjegy létrehozása</title>
</head>
<body>
    <h1>Új névjegy létrehozása</h1>

    <form action="" method="post">
        <div>
            <label for="name">Név:</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($data['name']) ?>">
            <?php if (isset($errors['name'])): ?>
                <span style="color: red;"><?= htmlspecialchars($errors['name']) ?></span>
            <?php endif; ?>
        </div>

        <div>
            <label for="emails">Email(ek) (vesszővel elválasztva):</label>
            <input type="text" id="emails" name="emails" value="<?= htmlspecialchars(implode(', ', $data['emails'])) ?>">
            <?php if (isset($errors['emails'])): ?>
                <span style="color: red;"><?= htmlspecialchars($errors['emails']) ?></span>
            <?php endif; ?>
        </div>

        <div>
            <label for="phone">Telefonszám:</label>
            <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($data['phone']) ?>">
        </div>

        <div>
            <label for="note">Megjegyzés:</label>
            <textarea id="note" name="note"><?= htmlspecialchars($data['note']) ?></textarea>
        </div>

        <button type="submit">Mentés</button>
    </form>

    <a href="index.php">Vissza a listához</a>
</body>
</html>
