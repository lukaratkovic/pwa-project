<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Nema pristup</title>
</head>
<body>
    <?php 
        include_once('./header.php');
        include_once('./nav.php');
        
        $user = $_SESSION['name'];
        echo "<div id='no_access'>Korisnik $user nema pristup administraciji!</div>";

        include_once('./footer.php');
    ?>
</body>
</html>