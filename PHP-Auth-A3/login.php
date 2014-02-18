<?php
require __DIR__ . '/vendor/autoload.php';

use \Symfony\Component\HttpFoundation\Session\Session;

$session = new Session();

if($session->get('status') == 'badLogin'){
    $flash = $session->getFlashBag()->get('statusMessage');

    if($flash): ?>
        <div align = "center" class="alert alert-danger">
        <?php
        echo $flash[0];
    endif;   ?>
    </div>
    <?php
    $session->clear();

}

?>


<html>
    <link rel="stylesheet" href="css/bootstrap.css">
<head></head>

<body>

    <form method="post" align="center" action="login-process.php">
        <br>
        <div>
        Username: <input type="text" style="width: 300px" name="username" />
        </div>
        <br>
        <div>
       Password: <input type="text" style="width: 300px" name="password">
        </div>
        <br>
        <div>
        <input type="submit" class="btn btn-info" style= "width:200px"  value="Login">
        </div>
    </form>

</body>


</html>