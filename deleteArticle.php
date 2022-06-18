<?php
    // Get id from post (ajax)
    $id = $_POST['id'];

    // delete article
    include_once('connect.php');
    $statement = $dbc->prepare("DELETE FROM article WHERE id=?");
    $statement->bind_param('i', $id);
    $statement->execute();
?>