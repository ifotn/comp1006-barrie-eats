<?php
$title = "Restaurants";
require('header.php');

if (isset($_SESSION['userId'])) {
    echo '<a href="restaurant.php">Add a New Restaurant</a> ';
}

?>

<h1>Restaurants</h1>

<form method="get">
    <fieldset class="col-md-12 text-right">
        <label for="searchName">Search: </label>
        <input name="searchName" id="searchName" placeholder="Search By Name" />
        <select name="searchType" id="searchType">
            <option>-All-</option>
            <?php
            // connect
            require('db.php');
            $sql = "SELECT * FROM restaurantTypes ORDER BY restaurantType";
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $types = $cmd->fetchAll();

            foreach ($types as $t) {
                echo "<option>{$t['restaurantType']}</option>";
            }

            ?>
        </select>
        <button class="btn btn-primary">Go</button>

    </fieldset>
</form>

<?php
try {

    //$db = new PDO('mysql:host=aws.computerstudi.es;dbname=gcxxxxxxxxx', 'gcxxxxxxxxx', 'awspass');


    // set up query
    $sql = "SELECT * FROM restaurants";

    // search by name if the user is searching
    $searchName = null;
    $searchType = null;

    if (isset($_GET['searchName'])) {
        $searchName = $_GET['searchName'];
        $sql .= " WHERE name LIKE ?";

        // now check the type
        if ($_GET['searchType'] != "-All-") {
            $searchType = $_GET['searchType'];
            $sql .= " AND restaurantType = ?";
        }
    }

    // execute & store the result
    $cmd = $db->prepare($sql);

    if (isset($searchName)) {
        $words[0] = "%$searchName%";

        if (isset($searchType)) {
            $words[1] = $searchType;
        }
        $cmd->execute($words);

        if ($searchName == "") {
            $searchName = "All";
        }

        if ($searchType == "") {
            $searchType = "All";
        }

        echo "<h3>You searched: $searchName / $searchType</h3>";
    }
    else {
        $cmd->execute();
    }

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
