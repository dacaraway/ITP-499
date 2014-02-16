<?php

namespace ITP;

use PDO;

class Auth{

    protected $username;
    protected $password;
    private $pdo;
    private $host;
    private $dbname;
    private $user;
    private $pass;


    public function __construct($pdo){

        $this->pdo = $pdo;
    }

    public function attempt($username, $password){

        $sql = "
        SELECT *
        FROM users
        WHERE username = :usr
        AND password = SHA1(:pass)
        ";

        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':usr', $username);
        $statement->bindValue(':pass', $password);
        $statement->execute();

        $valid= $statement->fetchAll(PDO::FETCH_OBJ);

        if(count($valid) == 0){
            return false;
        }
        else{
            return true;
        }
    }

    public function getEmail($username){
        $sql = "
            SELECT email
            FROM users
            WHERE username = :usr
        ";

        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':usr', $username);
        $statement->execute();

        $email = $statement->fetchAll(PDO::FETCH_OBJ);

        return $email[0]->email;

    }

    public function getPDO(){
        return $this->pdo;
    }






























}
?>