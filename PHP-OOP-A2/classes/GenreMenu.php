<?php

class GenreMenu
{
    public $genres;
    public function __construct($string, $artists){
        $this->genres = $artists;
    }

    public function __toString(){

        $genreMenu = [];
        foreach($this->genres as $genre){
            array_push($genreMenu, $genre->genre);
        }
        $i=1;
        echo '<select name = "genre">';
        foreach($genreMenu as $line){
            echo '<option value='.$i.'">'.$line.'</option>';
            $i ++;

        }
        echo '</select>';
        return "";

    }

}
?>

