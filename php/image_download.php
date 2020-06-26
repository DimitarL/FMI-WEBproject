<?php


if(!session_id()){
    session_start();
}

$username = $_SESSION["username"];

$input_json = file_get_contents('php://input');
// $fileName = $_POST['username'] . "_" . preg_replace("/(\W)+/", "", $_POST['topic']);
$fileName = $username . "_" . rand(10,100000);
$fileToUpload = "file";

$targetFile = checkImage($fileToUpload, $fileName);
if($targetFile){
    downloadImage($fileToUpload, $targetFile);
}


function checkImage($fileToUploadInput, $fileName){
    $targetDir = "../uploads/";
    $uploadFile = basename($_FILES[$fileToUploadInput]["name"]);

    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($uploadFile,PATHINFO_EXTENSION));

    $fileName = $fileName . "." . $imageFileType;
    $targetFile = $targetDir . $fileName;

    // Check if image file is a actual image or fake image
    $submitRequest = 'submit';
    if(isset($_POST[$submitRequest])) {
        $check = getimagesize($_FILES[$fileToUploadInput]["tmp_name"]);
        if($check !== false) {
            echo "Файлът е картинка - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "Файлът не е картинка.";
            $uploadOk = 0;
        }
    }

    //Check if file is upload
    if($_FILES[$fileToUploadInput]['error'] > UPLOAD_ERR_OK){
        return;
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Съжаляваме, файлът вече съществува.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES[$fileToUploadInput]["size"] > 500000) {
        echo "Съжаляваме, Вашият файл е прекалено голям.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Съжаляваме, поддържат се само JPG, JPEG, PNG и GIF файлове.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        return false;
    // if everything is ok, return the name of the file
    } else {
        // echo "HERE";
        echo $targetFile;
        return $targetFile;
    }
}

function downloadImage($fileToUploadInput, $targetFile){
    try{
        move_uploaded_file($_FILES[$fileToUploadInput]["tmp_name"], $targetFile);
    } catch(Exception $error){
        echo "Съжаляваме, получи се грешка при запазването на файла.</br>";
    }
}
?>
