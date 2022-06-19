<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Login</title>
</head>
<body>
    <?php
        include_once('header.php');
        include_once('nav.php');
    ?>
    
    <main id="login_form">
    <form method="post">
        <label for="username">Korisničko ime</label> <br>
        <input type="text" name="username" id="username"> <br>
        <label for="password">Lozinka</label> <br>
        <input type="password" name="password" id="password"> <br><br>
        <input type="submit" value="Prijava" id="submit">
    </form>
    </main>

    <?php
        include_once('./footer.php');
        if(isset($_POST['username'], $_POST['password'])){
            $username = $_POST['username'];
            $password = $_POST['password'];

            include_once('./connect.php');
            $statement = $dbc->prepare("SELECT username, name, password, administrator FROM user WHERE username = ?");
            $statement->bind_param('s',$username);
            $statement->execute();
            $result = $statement->get_result();
            if($result->num_rows == 0){
                echo "<div id='login_error' class='error'>Pogrešno korisničko ime ili lozinka! <br>
                <a href='./register.php'>Registracija</a>
                </div>";
            }
            else{
                $row = $result->fetch_array();
                $hashed_password = $row['password'];
                if(password_verify($password, $hashed_password)){
                    session_start();
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['administrator'] = $row['administrator'];
                    $_SESSION['name'] = $row['name'];
                    header("location: ./admin.php");
                }
                else{
                    echo "<div id='login_error' class='error'>Pogrešno korisničko ime ili lozinka!</div>";
                }
            }
        }
    ?>
</body>
</html>