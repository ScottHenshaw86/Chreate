<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/error.css">
    <title>Error ㅠㅡㅠ</title>
</head>
<body>
    <h1>Something went wrong</h1>
    <h2><?= $e->getMessage(); ?></h2>

    <a href="index.php">Go back home</a>
</body>
</html>