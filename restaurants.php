<?php
$title = "Restaurants";
require('header.php');

if (isset($_SESSION['userId'])) {
    echo '<a href="restaurant.php">Add a New Restaurant</a> ';
}

?>

<h1>Restaurants</h1>

<?php
try {
    // connect
    require('db.php');
    //$db = new PDO('mysql:host=aws.computerstudi.es;dbname=gcxxxxxxxxx', 'gcxxxxxxxxx', 'awspass');


    // set up query
    $sql = "SELECT * FROM restaurants";

    // execute & store the result
    $cmd = $db->prepare($sql);
    $cmd->execute();
    $restaurants = $cmd->fetchAll();

    // start the table
    echo '<table class="table table-striped table-hover sortable"><thead><th>Name</th><th></th><th>Address</th>
    <th>Phone</th><th>Type</th>';

    if (isset($_SESSION['userId'])) {
        echo '<th>Actions</th>';
    }


    echo '</thead>';

    // loop through the data & show each restaurant on a new row
    foreach ($restaurants as $r) {
        echo "<tr><td> {$r['name']} </td>";

        if (isset($r['logo'])) {
            echo "<td><img src=\"img/{$r['logo']}\" alt=\"Logo\" height=\"50px\" /></td>";
        }

        echo "<td> {$r['address']} </td>
            <td> {$r['phone']} </td>
            <td> {$r['restaurantType']} </td>";

        if (isset($_SESSION['userId'])) {
            echo "<td><a href=\"restaurant.php?restaurantId={$r['restaurantId']}\">Edit</a> | 
                <a href=\"delete-restaurant.php?restaurantId={$r['restaurantId']}\" 
                class=\"text-danger confirmation\">Delete</a></td>";
        }

        echo "</tr>";
    }

    // close the table
    echo '</table>';

    // disconnect
    $db = null;
}
catch (Exception $e) {
    // send
    mail('rich.freeman@georgiancollege.ca', 'Barrie Eats Error', $e);

    // show generic error page
    header('location:error.php');
}
?>

<!-- js -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/scripts.js"></script>
<!-- sorttable script from https://kryogenix.org/code/browser/sorttable/ -->
<script src="js/sorttable.js"></script>


</body>
</html>
