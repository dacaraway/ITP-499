<?php


class ArtistQuery
{
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }
    public function getAll(){
        $sql = "
            SELECT artist_name
            FROM artists
        ";

        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        $artists = $statement->fetchAll(PDO::FETCH_OBJ);

        return $artists;
    }

}

?>