<?php
$title = "Login";
require('header.php');
?>

<main class="container">
    <h1>Log In</h1>

    <?php
    if (isset($_GET['invalid'])) {
        echo '<div class="alert alert-danger">Invalid Login</div>';
    }
    else {
        echo '<div class="alert alert-info">Please enter your credentials</div>';
    }
    ?>
    <form method="post" action="validate.php">
        <fieldset class="form-group">
            <label for="username" class="col-sm-2">Username:</label>
            <input name="username" id="username" required
                   type="email" placeholder="email@email.com" />
        </fieldset>
        <fieldset class="form-group">
            <label for="password" class="col-sm-2">Password:</label>
            <input type="password" name="password" required />
        </fieldset>
        <fieldset class="col-sm-offset-2">
            <input type="submit" value="Login" class="btn btn-success" />
        </fieldset>
    </form>
</main>

<!-- Latest jQuery -->
<script src="js/jquery-3.1.1.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>
</html>
