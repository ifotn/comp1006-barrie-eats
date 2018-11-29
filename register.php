<?php
$title = "Register";
require('header.php');
?>

<main class="container">
    <h1>User Registration</h1>
    <div class="alert alert-info" id="message">Please create your account</div>
    <form method="post" action="save-registration.php">
        <fieldset class="form-group">
            <label for="username" class="col-sm-2">Username:</label>
            <input name="username" id="username" required

                   type="email" placeholder="email@email.com"

            />
        </fieldset>
        <fieldset class="form-group">
            <label for="password" class="col-sm-2">Password:</label>
            <input type="password" name="password" id="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" />
        </fieldset>
        <fieldset class="form-group">
            <label for="confirm" class="col-sm-2">Confirm Password:</label>
            <input type="password" name="confirm" id="confirm" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" />
        </fieldset>

        <div class="g-recaptcha" data-sitekey="6Le-6X0UAAAAAH0fUVRx8igVyGu_hcu4vRrbFPx2"></div>

        <div class="col-sm-offset-2">
            <input type="submit" value="Register" class="btn btn-success" />
        </div>
    </form>
</main>


<?php require('footer.php') ?>