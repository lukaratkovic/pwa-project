<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Registracija</title>
</head>
<body>
    <?php
        include_once('header.php');
        include_once('nav.php');
    ?>
    
    <main id="registration_form">
    <form method="post">
        <label for="username">Korisničko ime</label> <br>
        <input type="text" name="username" id="username"> <br>
        <div id="username_error_message" class="validation_error">Korisničko ime mora sadržavati između 4 i 15 znakova</div>
        <label for="name">Ime</label> <br>
        <input type="text" name="name" id="name"> <br>
        <div id="name_error_message" class="validation_error">Ime ne smije biti prazno</div>
        <label for="surname">Prezime</label> <br>
        <input type="text" name="surname" id="surname"> <br>
        <div id="surname_error_message" class="validation_error">Prezime ne smije biti prazno</div>
        <label for="password">Lozinka</label> <br>
        <input type="password" name="password" id="password"> <br>
        <div id="password_error_message" class="validation_error">Lozinka mora sadržavati barem 5 znakova</div>
        <label for="password">Ponovljena lozinka</label> <br>
        <input type="password" name="confirmPassword" id="confirmPassword"> <br>
        <div id="confirm_password_error_message" class="validation_error">Lozinke se moraju podudarati</div> <br>
        <input type="submit" value="Registracija" id="submit">
    </form>
    </main>

    <?php
        if(isset($_POST['username'], $_POST['password'])){
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], CRYPT_BLOWFISH);
            $name = $_POST['name'];
            $surname = $_POST['surname'];

            include_once('./connect.php');
            $statement = $dbc->prepare("SELECT EXISTS(SELECT * FROM user WHERE username = ?) as userExists");
            $statement->bind_param('s',$username);
            $statement->execute();
            $result = $statement->get_result();
            if(($result->fetch_array())['userExists']){
                echo "<div id='registration_error' class='error'>Registracija neuspješna! Korisničko ime već postoji!</div>";
            }
            else{
                $statement = $dbc->prepare("INSERT INTO user (username, password, name, surname) VALUES (?,?,?,?)");
                $statement->bind_param('ssss',$username,$password,$name,$surname);
                $statement->execute();
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['administrator'] = 0;
                $_SESSION['name'] = $name;
                header('location: ./index.php');
            }
        }
    ?>

    <script src="./js/register_validate.js"></script>
</body>
</html>