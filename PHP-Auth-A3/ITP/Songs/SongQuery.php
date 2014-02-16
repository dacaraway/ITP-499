<?php

namespace ITP\Songs;

use PDO;

class SongQuery{
    private $sql;
    private $string;
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
        $this->sql = "SELECT title, artist_name, genre, price
                       FROM songs
                       ";

    }

    public function withArtist(){
        $this->sql .= "INNER JOIN artists
                        ON songs.artist_id = artists.id
                        ";

        return $this;

    }
    public function withGenre(){
        $this->sql .= "INNER JOIN genres
                        ON songs.genre_id = genres.id
                        ";
        return $this;
    }
    public function orderBy($string){
        $this->string = $string;
        $this->sql .= "ORDER BY :string
                       ";
        return $this;
    }


    public function all(){
        $statement = $this->pdo->prepare($this->sql);
        $statement->bindParam(':string', $this->string);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_OBJ);

    }










}