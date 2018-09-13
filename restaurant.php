<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Restaurant Details</title>
</head>
<body>

<h1>Restaurant Details</h1>

<form method="post" action="save-restaurant.php">
    <fieldset>
        <label for="name">Name: </label>
        <input name="name" id="name" />
    </fieldset>
    <fieldset>
        <label for="address">Address: </label>
        <textarea name="address" id="address"></textarea>
    </fieldset>
    <fieldset>
        <label for="phone">Phone: </label>
        <input name="phone" id="phone" />
    </fieldset>
    <button>Save</button>
</form>
</body>
</html>
