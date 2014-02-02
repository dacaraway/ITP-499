<?php
require_once 'db.php';
require_once 'classes/ArtistQuery.php';
require_once 'classes/GenreQuery.php';
require_once 'classes/ArtistMenu.php';
require_once 'classes/GenreMenu.php';

$artistQuery = new ArtistQuery($pdo);
$artists = $artistQuery->getAll();

$genreQuery = new GenreQuery($pdo);
$genres = $genreQuery->getAll();

?>

<form method="post" action="add-song-process.php">
    <h3 style="color: blueviolet"> Enter Title:</h3>
    <div>
       <input type="text" name="title" />
    </div>
    <h3 style="color: blueviolet"> Artists:</h3>
    <div>
       <?php echo new ArtistMenu('artist', $artists) ?>
    </div>
    <br>
    <h3 style="color: blueviolet"> Genres:</h3>
    <div>
     <?php echo new GenreMenu('genre', $genres) ?>
    </div>
    <h3 style="color: blueviolet"> Enter Price:</h3>
    <div>
        <input type="text" name="price" />
    </div>
    <div>
        <input type="submit" value="Add Song" />
    </div>
</form>