<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unos</title>
</head>
<body>
    <?php
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
        <article>
            <h1>$title</h1>
            <p> Category: $category </p>
            <h2>$summary</h2>
            <p>$content</p>
            <img src='$filePath' alt='image'>
        </article>
        ";

        //Save to database
        echo "Archive: "; print_r($archive);
        $statement = $dbc->prepare("INSERT INTO article(title, summary, content, imagePath, category, archive) VALUES (?,?,?,?,?,?)");
        $statement->bind_param("sssssi",$title, $summary, $content, $filePath, $category, $archive);
        $statement->execute();
    ?>
</body>
</html>