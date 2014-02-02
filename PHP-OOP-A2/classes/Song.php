<?php


class Song{

    private $pdo;
    public $title;
    public $artistId;
    public $genreId;
    public $price;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function setTitle($title){
        $this->title = $title;
    }
    public function setArtistId($id){
        $this->artistId = $id;
    }
    public function setGenreId($id){
        $this->genreId = $id;
    }
    public function setPrice($price){
        $this->price = $price;
    }
    public function getTitle(){
        return $this->title;
    }
    public function getId(){
        return $this->pdo->lastInsertId();
    }
    public function save(){
        $sql = "
            INSERT INTO songs (title, artist_id, genre_id, price)
            VALUES ('$this->title', '$this->artistId', '$this->genreId', '$this->price')
        ";

        $statement = $this->pdo->prepare($sql);
        return $statement->execute();

    }


}

?>