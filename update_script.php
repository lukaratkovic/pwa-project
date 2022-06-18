<?php
    include_once('./upload_file.php');
    $id = $_POST['id'];
    $title = $_POST['title'];
    $summary = $_POST['summary'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $archive = isset($_POST['archive']);

    include_once('./connect.php');

    // No image (image stays same)
    if($_FILES['image']['size'] == 0){
        $statement = $dbc->prepare('UPDATE article SET title=?, summary=?, content=?, category=?, archive=? WHERE id=?');
        $statement->bind_param('sssssi',$title, $summary, $content, $category, $archive, $id);
        $statement->execute();
        header('location: ./admin.php');
    }
    // Image is being updated
    else{
        $filePath = uploadToServer($_FILES['image']);
        $statement = $dbc->prepare('UPDATE article SET title=?, summary=?, content=?, imagePath=?, category=?, archive=? WHERE id=?');
        $statement->bind_param('ssssssi',$title, $summary, $content, $filePath, $category, $archive, $id);
        $statement->execute();
        header('location: ./admin.php');
    }
?>