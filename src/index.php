<?php
require 'config/db.php';

$animals = $pdo->query("
    SELECT a.id, a.name, a.birth_date, a.weight,
           s.name AS species, e.name AS enclosure
    FROM animals a
    JOIN species s ON a.species_id = s.id
    JOIN enclosures e ON a.enclosure_id = e.id
    ORDER BY a.id DESC
")->fetchAll();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Зоопарк</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Наш зоопарк</h1>
<table>
    <tr>
        <th>ID</th><th>Кличка</th><th>Вид</th>
        <th>Вольер</th><th>Дата рождения</th><th>Вес</th>
    </tr>
    <?php foreach ($animals as $a): ?>
    <tr>
        <td><?= $a['id'] ?></td>
        <td><?= htmlspecialchars($a['name']) ?></td>
        <td><?= htmlspecialchars($a['species']) ?></td>
        <td><?= htmlspecialchars($a['enclosure']) ?></td>
        <td><?= $a['birth_date'] ?></td>
        <td><?= $a['weight'] ?> кг</td>
    </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
