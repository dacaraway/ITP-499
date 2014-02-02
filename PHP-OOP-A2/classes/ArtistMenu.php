<?php

class ArtistMenu
{
    public $artists;
    public function __construct($string, $artists){
        $this->artists = $artists;
    }

    public function __toString(){

        $artistMenu = [];
        foreach($this->artists as $artist){
            array_push($artistMenu, $artist->artist_name);
        }

        $i=1;

        echo '<select name = "artist">';
        foreach($artistMenu as $line){

            echo '<option value='.$i.'">'.$line.'</option>';
            $i ++;
        }

        echo '</select>';

        return "";
    }

}
?>


