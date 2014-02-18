<?php
require __DIR__ . '/vendor/autoload.php';
require_once 'db.php';



use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\RedirectResponse;
use \Symfony\Component\HttpFoundation\Session\Session;
use \Carbon\Carbon;

$request = Request::createFromGlobals();

$username = $request->request->get('username', 'error');
$password = $request->request->get('password', 'error');


$session = new Session();

$auth = new \ITP\Auth($pdo);

$valid = $auth->attempt($username, $password);

if($valid == true){
    $session->set('username', $username);
    $email = $auth->getEmail($username);
    $session->set('email', $email);
    $time = Carbon:: now(new DateTimeZone('Europe/London'));
    $session->set('time', $time);
    $response = new RedirectResponse('dashboard.php');
    $session->getFlashBag()->set('statusMessage', 'You have successfully logged in!');
    return $response->send();
}
else{
    $response = new RedirectResponse('login.php');
    $session->set('status', 'badLogin');
    $session->getFlashBag()->set('statusMessage', 'Incorrect credentials');
    return $response->send();
}


?>