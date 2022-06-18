<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <title>Članak</title>
</head>
<body>
<?php
    include_once('header.php');
    include_once('nav.php');
    include_once('connect.php');
    
    // Get article from database
    if(!isset($_GET['id'])){
        echo "Article not found.";
        include_once('footer.php');
        die();
    }
    $article_id=$_GET['id'];
    $statement = $dbc->prepare("SELECT title, summary, content, imagePath FROM article WHERE id=?");
    $statement->bind_param('i',$article_id);
    $statement->execute();
    $result = $statement->get_result();
    $row = $result->fetch_assoc();
    if($row == null) {
        echo "Article not found";
        include_once('footer.php');
        die();
    }

    $title = $row['title'];
    $summary = $row['summary'];
    $imagePath = $row['imagePath'];
    $content=  $row['content'];

    // Render article
    echo "
    <main id='article_body'>
        <h1>$title</h1>
        <p id='summary'>$summary</p>
        <img src='$imagePath' alt='slika'>
        <p>$content</p>
    </main>";
    
    include_once('footer.php');
?>
</body>
</html>