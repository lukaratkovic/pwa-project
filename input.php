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
    ?>

    <main id="input_form">
        <form action="input_script.php" method="post" enctype="multipart/form-data">
            <label for="title">Naslov vijesti</label> <br>
            <input type="text" name="title" id="title"> <br>
            <div id="title_error_message" class="validation_error">Naslov mora imati 5 do 30 znakova!</div>
            <label for="summary">Kratki sadržaj (do 100 znakova)</label> <br>
            <textarea name="summary" id="summary" cols="30" rows="5"></textarea> <br>
            <div id="summary_error_message" class="validation_error">Kratki sadržaj vijesti mora imati 10 do 100 znakova</div>
            <label for="content">Sadržaj vijesti</label> <br>
            <textarea name="content" id="content" cols="30" rows="15"></textarea> <br>
            <div id="content_error_message" class="validation_error">Tekst vijesti ne smije biti prazan</div>
            <label for="image">Slika</label> <br>
            <span id="image_input"><input type="file" name="image" id="image" accept=".jpg,.gif,.png,.jpeg"></span> <br>
            <div id="file_error_message" class="validation_error">Slika mora biti odabrana</div>
            <label for="category">Kategorija vijesti</label> <br>
            <select name="category" id="category">
                <option disabled selected value="default">Odaberi kategoriju</option>
                <option value="zabava">Zabava</option>
                <option value="sport">Sport</option>
            </select> <br>
            <div id="category_error_message" class="validation_error">Kategorija mora biti odabrana</div>
            <input type="checkbox" name="archive" id="archive">
            <label for="archive">Spremiti u arhivu</label> <br>
            <input type="reset" value="Poništi" id="reset">
            <input type="submit" value="Unesi" id="submit">
        </form>
    </main>

    <?php
        include_once('footer.php');
    ?>
    <script src="./js/input_validate.js"></script>
</body>
</html>