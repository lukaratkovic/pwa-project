<nav>
    <ul>
        <li>
            <a href="./index.php">Home</a>
        </li>
        <li>
            <a href="./category.php?c=zabava">Zabava</a>
        </li>
        <li>
            <a href="./category.php?c=sport">Sport</a>
        </li>
        <li>
            <a href="./input.php">Unos</a>
        </li>
        <li>
            <a href="./admin.php">Administracija</a>
        </li>
        <li>
            <?php
                session_start();
                if(isset($_SESSION['username']))
                    echo "<a href='./logout.php'>Odjava</a>";
                else
                    echo "<a href='./register.php'>Registracija</a>"
            ?>
        </li>
    </ul>
</nav>
<hr>