<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/error.css">
    <link rel="icon" href="./public/images/favicon.ico" type="image/x-icon">

    <title>Error! TT </title>
</head>

<body>
    <h1>Oh no. Something went wrong</h1>
    <h2><?= $e->getMessage(); ?></h2>

    <a href="index.php?action=showSignUpPage">Retry</a>


</body>

</html>