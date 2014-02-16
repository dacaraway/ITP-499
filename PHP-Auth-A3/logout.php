<?php
require __DIR__ . '/vendor/autoload.php';


    use \Symfony\Component\HttpFoundation\RedirectResponse;
    use \Symfony\Component\HttpFoundation\Session\Session;

    $session = new Session();
    $session-> clear();
    $response = new RedirectResponse('login.php');
    return $response->send();
?>
