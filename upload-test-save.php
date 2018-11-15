<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Test</title>
</head>
<body>

<?php
// get the uploaded file
$file = $_FILES['testFile'];

// display the file name
echo "Name: {$file['name']} <br />";

// display the file size
echo "Size: {$file['size']} <br />";

// display the temp location in cache
echo "Temp Location: {$file['tmp_name']} <br />";

// display the file type
$finfo = finfo_open(FILEINFO_MIME_TYPE);
echo "Type: " . finfo_file($finfo, $file['tmp_name']) . "<br />";

// save the file permanently
move_uploaded_file($file['tmp_name'], "uploads/{$file['name']}");

?>

</body>
</html>
