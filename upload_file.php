<?php
    function uploadToServer($file){
        $finfo = new finfo(FILEINFO_MIME);
        $filename = $file['tmp_name'];
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
        if(!move_uploaded_file($file['tmp_name'], $filePath)){
            echo "Error: File could not be uploaded.";
            include_once('footer.php');
            die();
        }

        return $filePath;
    }
?>