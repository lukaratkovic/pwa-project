<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Zabava</title>
</head>
<body>
<?php
    include_once('header.php');
    include_once('nav.php');

    if(!isset($_GET['c']) || ($_GET['c'] != 'sport' && $_GET['c'] != 'zabava')){
        echo "Category not found!";
        include_once('footer.php');
        die();
    }

    include_once('connect.php');
    
    $category = $_GET['c'];
    $statement = $dbc->prepare("SELECT category, summary, imagePath, title, id FROM article WHERE archive=0 AND category=? ORDER BY id DESC");
    $statement->bind_param('s',$category);
    $statement->execute();
    $result = $statement->get_result();
    
    echo "<main class='container-fluid' id='category_container'>";
    while($row = $result->fetch_array()){
        $id = $row['id'];
        $title = $row['title'];
        $summary = $row['summary'];
        $imagePath = $row['imagePath'];
        $category = $row['category'];
        echo "<article class='category_article row'>
            <div class='col-2'><a href='./article.php?id=$id'><img src='$imagePath' alt='article'></a></div>
            <div class='col-10'>
                <div class='row'>
                    <div class='col-12'><a href='./article.php?id=$id'><h1>$title</h1></a></div>
                    <div class='col-12'><p>$summary</p></div>
                </div>
            </div>
        </article>";
    }
    echo '</main>';

    include_once('footer.php');
?>
</body>
</html>