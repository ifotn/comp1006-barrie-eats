<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<?php
$f = $_FILES['f1'];

echo $f['name'];
echo $f['size'];
echo $f['type'];

$finfo = finfo_open(FILEINFO_MIME_TYPE); // return mime type ala mimetype extension
echo finfo_file($finfo, $f['tmp_name']);


?>

</body>
</html>
