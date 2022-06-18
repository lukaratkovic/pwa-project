<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Uređivanje</title>
</head>
<body>
    <?php
        if(!isset($_GET['id'])) header('location: ./index.php');
        include_once('./header.php');
        include_once('./nav.php');
        $id = $_GET['id'];
        include_once('./connect.php');
        $statement = $dbc->prepare('SELECT title, summary, content, category, archive FROM article WHERE id=?');
        $statement->bind_param('i',$id);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_array();
        $title = $row['title'];
        $summary = $row['summary'];
        $content = $row['content'];
        $category = $row['category'];
        $archive = $row['archive'];
    ?>
    <main id="input_form">
        <form action="update_script.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="id" name="id" <?php echo "value='$id'";?>>
            <label for="title">Naslov vijesti</label> <br>
            <input type="text" name="title" id="title" <?php echo "value='$title'";?>> <br>
            <div id="title_error_message" class="validation_error">Naslov mora imati 5 do 30 znakova!</div>
            <label for="summary">Kratki sadržaj (do 100 znakova)</label> <br>
            <textarea name="summary" id="summary" cols="30" rows="5"><?php echo $summary;?></textarea> <br>
            <div id="summary_error_message" class="validation_error">Kratki sadržaj vijesti mora imati 10 do 100 znakova</div>
            <label for="content">Sadržaj vijesti</label> <br>
            <textarea name="content" id="content" cols="30" rows="15"><?php echo $content ?></textarea> <br>
            <div id="content_error_message" class="validation_error">Tekst vijesti ne smije biti prazan</div>
            <label for="image">Slika <em>(ako je ostavljeno prazno ostat će prethodna slika)<em></label> <br>
            <span id="image_input"><input type="file" name="image" id="image" accept=".jpg,.gif,.png,.jpeg"></span> <br>
            <div id="file_error_message" class="validation_error">Slika mora biti odabrana</div>
            <label for="category">Kategorija vijesti</label> <br>
            <select name="category" id="category">
                <option disabled value="default">Odaberi kategoriju</option>
                <option value="zabava" <?php setSelected('zabava', $category) ?>>Zabava</option>
                <option value="sport" <?php setSelected('sport', $category) ?>>Sport</option>
            </select> <br>
            <div id="category_error_message" class="validation_error">Kategorija mora biti odabrana</div>
            <input type="checkbox" name="archive" id="archive" <?php if($archive) echo "checked";?>>
            <label for="archive">Spremiti u arhivu</label> <br>
            <input type="reset" value="Poništi" id="reset">
            <input type="submit" value="Unesi" id="submit">
        </form>
    </main>
    <?php
        include_once('./footer.php');
        function setSelected($val, $category){
            if($val == $category) echo "selected";
        }
    ?>
    <script src="./js/input_validate.js"></script>
</body>
</html>