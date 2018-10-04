<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Restaurant Details</title>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
</head>
<body>

<a href="restaurants.php">View Restaurants</a>

<h1>Restaurant Details</h1>

<form method="post" action="save-restaurant.php">
    <fieldset>
        <label for="name" class="col-md-1">Name: </label>
        <input name="name" id="name" required />
    </fieldset>
    <fieldset>
        <label for="address" class="col-md-1">Address: </label>
        <textarea name="address" id="address" required></textarea>
    </fieldset>
    <fieldset>
        <label for="phone" class="col-md-1">Phone: </label>
        <input name="phone" id="phone" required type="tel" />
    </fieldset>
    <fieldset>
        <label for="restaurantType" class="col-md-1">Type: </label>
        <select name="restaurantType" id="restaurantType">
            <option>-Select-</option>
            <?php
            // connect
            $db = new PDO('mysql:host=localhost;dbname=barrieEats', 'root', '');

            // set up query
            $sql = "SELECT * FROM restaurantTypes ORDER BY restaurantType";
            $cmd = $db->prepare($sql);

            // fetch the results
            $cmd->execute();
            $types = $cmd->fetchAll();

            // loop through and create a new option tag for each type
            foreach ($types as $t) {
                echo "<option> {$t['restaurantType']} </option>";
            }

            // disconnect
            $db = null;
            ?>
        </select>
    </fieldset>
    <button class="col-md-offset-1 btn btn-primary">Save</button>
</form>
</body>
</html>
