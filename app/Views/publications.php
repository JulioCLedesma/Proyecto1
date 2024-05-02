<!-- app/Views/publications.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publications</title>
</head>
<body>
    <h1>List of Publications</h1>
    
    <!-- Aquí puedes mostrar las publicaciones recuperadas del controlador -->
    <ul>
        <?php foreach ($publications as $publication): ?>
            <li><?= $publication['title'] ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
