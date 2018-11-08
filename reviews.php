<?php
$title = "Reviews";
require('header.php');
?>

<a href="review.php">Add a New Review</a>
<h1>Reviews</h1>

<?php
// connect
require('db.php');
//$db = new PDO('mysql:host=aws.computerstudi.es;dbname=gcxxxxxxxxx', 'gcxxxxxxxxx', 'awspass');


// set up query
$sql = "SELECT * FROM reviews";

// execute & store the result
$cmd = $db->prepare($sql);
$cmd->execute();
$reviews = $cmd->fetchAll();

// start the table
echo '<table class="table table-striped table-hover"><thead><th>User</th><th>Date</th>
<th>Rating</th><th>Comments</th><th>Restaurants</th></thead>';

// loop through the data & show each restaurant on a new row
foreach ($reviews as $r) {
    echo "<tr><td> {$r['username']} </td>
        <td> {$r['reviewDate']} </td>
        <td> {$r['rating']} </td>
        <td> {$r['comments']} </td>
        <td> {$r['restaurant']} </td></tr>";
}

// close the table
echo '</table>';

// disconnect
$db = null;
?>

<!-- js -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/scripts.js"></script>


</body>
</html>
