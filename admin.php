<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Administracija</title>
</head>
<body>
    <?php
        include_once('header.php');
        include_once('nav.php');
        if(isset($_SESSION['administrator'])){
            if(!$_SESSION['administrator']) header("location: ./unauthorized.php");
        } else {
            header("location: ./login.php");
        }
    ?>

    <main id="admin_article_list">
        <table>
            <tr>
                <th>Naslov</th>
                <th>Kratki Sadržaj</th>
                <th>Sadržaj</th>
                <th>Slika</th>
                <th>Kategorija</th>
                <th>Arhivirano</th>
                <th>Uredi</th>
                <th>Obriši</th>
            </tr>
            <?php
                include_once('./connect.php');
                $statement = $dbc -> prepare("SELECT * FROM article ORDER BY id DESC");
                $statement->execute();
                $result = $statement->get_result();

                while($row = $result->fetch_array()){
                    $id = $row['id'];
                    $title = $row['title'];
                    $summary = $row['summary'];
                    $content = substr($row['content'], 0, 150);
                    if(strlen($row['content']) > 150) $content = $content.'...';
                    $imagePath = $row['imagePath'];
                    $category = $row['category'];
                    $archive = $row['archive'] ? 'DA' : 'NE';
                    echo "
                    <tr>
                        <td id='$id'>$title</td>
                        <td>$summary</td>
                        <td>$content</td>
                        <td><a href='$imagePath'>$imagePath</a></td>
                        <td>$category</td>
                        <td>$archive</td>
                        <td><span class='editArticleButton' onclick='editArticle($id)'>Edit</span></td>
                        <td><span class='deleteArticleButton' onclick='deleteArticle($id)'>Delete</span></td>
                    </tr>
                    ";
                }
            ?>
        </table>
    </main>

    <?php
        include_once('footer.php');
    ?>

    <script src="./js/admin.js"></script>
</body>
</html>