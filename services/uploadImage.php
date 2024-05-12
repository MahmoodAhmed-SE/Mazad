<?php

function upload($image, $folder) {
    $targetDir = "../uploads/" . $folder . "/";
    $fileCount = count(scandir($targetDir)) - 2;

    $extension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));

    // Create a new filename based on the file count
    $newFileName = $fileCount . '.' . $extension;

    // Set the target file path
    $targetFile = $targetDir . $newFileName;

    // 
    if($extension != "jpg" && $extension != "png" && $extension != "jpeg" && $extension != "gif" ) {
        return null;
    }

    // Move the uploaded file to the target directory
    if (move_uploaded_file($image['tmp_name'], $targetFile)) {

        return $newFileName;
    } else {
        return null;
    }
}
?>