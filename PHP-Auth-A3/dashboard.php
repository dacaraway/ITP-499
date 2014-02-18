<?php
require __DIR__ . '/vendor/autoload.php';

require_once 'db.php';

use \Symfony\Component\HttpFoundation\Session\Session;
use \Symfony\Component\HttpFoundation\RedirectResponse;
use \Carbon\Carbon;

    $session = new Session();
    $nowTime =  Carbon:: now(new DateTimeZone('Europe/London'));
    $lastTime =  new Carbon($session->get('time'),new DateTimeZone('Europe/London') );
    $string;
    if ($nowTime->diffInSeconds($lastTime) < 60){
        $string = "Last Login: " .+ $nowTime->diffInSeconds($lastTime);
        $string.= " seconds ago";
    }
    else{
        $string = "Last Login: " .+ $nowTime->diffInMinutes($lastTime);
        $string .= " minutes ago";
    }
?>

<html>
    <link rel="stylesheet" href="css/bootstrap.css">
<head>

    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <p class="navbar-text">Username:
                        <?php
                        echo $session->get('username');
                        ?>
                    </p>
                    <p class="navbar-text">Email:
                        <?php
                        echo $session->get('email');
                        ?>
                    </p>
                    <p class="navbar-text">
                        <?php
                        echo $string;
                        ?>
                    </p>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

    <?php
    $flash = $session->getFlashBag()->get('statusMessage');
    if($flash): ?>
    <div align = "center" class="alert alert-success">
        <?php
            echo $flash[0];
     endif; ?>
    </div>


</head>
<body>
    <h1 align="center"> DashBoard</h1>


</body>

</html>

<?php
    if($session->get('username')){

        $songQuery = new ITP\Songs\SongQuery($pdo);
        $songs = $songQuery
            ->withArtist()
            ->withGenre()
            ->orderBy('title')
            ->all();
?>
    <table class="table table-striped">
        <tr>
            <th style="color: blue">Title</th>
            <th style="color: blue">Artist</th>
            <th style="color: blue">Genre</th>
            <th style="color: blue">Price</th>
        </tr>

        <?php
        foreach($songs as $song) : ?>

            <tr>
                <td><?php echo $song->title ?> </td>
                <td><?php echo $song->artist_name ?></p> </td>
                <td><?php echo $song->genre ?></p></td>
                <td><?php echo $song->price ?></p></td>
            </tr>
        <?php endforeach;?>
        </table>
<?php

    }
    else{
        $response = new RedirectResponse('login.php');
        $session->clear();
        return $response->send();
    }


?>