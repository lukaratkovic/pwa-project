<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Unos</title>
</head>
<body>
    <?php
        include_once('header.php');
        include_once('nav.php');
        if(!isset($_POST['title'],$_POST['summary'],$_POST['content'],$_POST['category']) || !file_exists($_FILES['image']['tmp_name'])){
            echo "Nisu uneseni svi parametri!";
            include_once('footer.php');
            die();
        }

        include_once('connect.php');

        //Get parameters from form
        $title = $_POST['title'];
        $summary = $_POST['summary'];
        $content = $_POST['content'];
        $category = $_POST['category'];
        $archive = isset($_POST['archive']);

        //Find image type of uploaded image
        $finfo = new finfo(FILEINFO_MIME);
        $filename = $_FILES['image']['tmp_name'];
        //determine image extension
        switch($finfo->file($filename)){
            case 'image/jpeg; charset=binary':
                $fileExtension = ".jpeg";
                break;
            case 'image/png; charset=binary':
                $fileExtension = ".png";
                break;
            case 'image/gif; charset=binary':
                $fileExtension = ".gif";
                break;
            default:
                echo "Error: Incorrect file type (jpeg, png, gif are allowed)";
                include_once('footer.php');
                die();
        }
        //Upload file to server
        $dir = './articleImg';
        $fileName = strval(time()) . $fileExtension;
        $filePath = "$dir/$fileName";
        if(!move_uploaded_file($_FILES['image']['tmp_name'], $filePath)){
            echo "Error: File could not be uploaded.";
            include_once('footer.php');
            die();
        }

        //Display article
        echo "
        <main id='article_body'>
            <h1>$title</h1>
            <p id='summary'>$summary</p>
            <img src='$filePath' alt='slika'>
            <p>$content</p>
        </main>
        ";

        //Save to database
        $statement = $dbc->prepare("INSERT INTO article(title, summary, content, imagePath, category, archive) VALUES (?,?,?,?,?,?)");
        $statement->bind_param("sssssi",$title, $summary, $content, $filePath, $category, $archive);
        $statement->execute();

        include_once('footer.php');
    ?>
</body>
</html>