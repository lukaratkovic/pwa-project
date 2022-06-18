<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>FranceInfo</title>
</head>
<body>
    <?php
        include_once('header.php');
        include_once('nav.php');
        
        include_once('connect.php');
        renderArticlesByCategory("Zabava", $dbc);
        renderArticlesByCategory("Sport", $dbc);
        
        include_once('footer.php');

        //Fetches all articles with category matching $category variable and renders them
        function renderArticlesByCategory($category, $dbc){
            $statement = $dbc->prepare("SELECT category, imagePath, title, id FROM article WHERE archive=0 AND category=?");
            $statement->bind_param('s', $category);
            $statement->execute();
            $result = $statement->get_result();
            $articleN = 0;
            echo "<h1>$category</h1>";
            while($row = $result->fetch_array()){
                $articlesPerRow = $row['category'] == 'zabava' ? 5 : 4;
                $imagePath = $row['imagePath'];
                $title = $row['title'];
                $articleId = $row['id'];
                if($articleN % $articlesPerRow == 0) echo "<section id='articles_$category' class='articleList'>";
                echo "
                <article>
                    <a href='./article.php?id=$articleId'>
                        <img src='$imagePath' alt='Clanak'>
                        <h2>$title</h2>
                    </a>
                </article>";
                $articleN++;
                if($articleN % $articlesPerRow == 0) echo "</section>";
            }
            echo '</section>';
        }
    ?>
</body>
</html>