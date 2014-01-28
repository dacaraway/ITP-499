<?php

$host = 'itp460.usc.edu';
$dbname = 'dvd';
$user = 'student';
$pass = 'ttrojan';

$title = $_GET['titles'];

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

$sql = "
  SELECT title, genre, rating, format
  FROM dvd_titles
  INNER JOIN genres
  ON dvd_titles.genre_id = genres.id
  INNER JOIN ratings
  ON dvd_titles.rating_id = ratings.id
  INNER JOIN formats
  ON dvd_titles.format_id = formats.id
  WHERE title LIKE ?
  ORDER BY dvd_titles.id ASC
";

$statement = $pdo->prepare($sql);

$like = '%'.$title.'%';
$statement->bindParam(1, $like);

$statement->execute();
$dvd_titles = $statement->fetchAll(PDO::FETCH_OBJ);
//var_dump($songs);
?>


<?php if(empty($dvd_titles)) : ?>
    <h1 align="center" style="color: blueviolet">There are no results by that search</h1>
    <a href="/Search_example/search.php">Back to Search</a>

<?php else : ?>

<h1 align = "center" style="color: blueviolet"> Search Results </h1>
<table border="10" style="font-family: helvetica">
 <tr>
     <th style="color: blue">Title</th>
     <th style="color: blue">Genre</th>
     <th style="color: blue">Rating</th>
     <th style="color: blue">Format</th>
 </tr>


<?php foreach($dvd_titles as $dvd) : ?>
<div class="dvd">
    <tr>
     <td><?php echo $dvd->title ?> </td>
     <td><?php echo $dvd->genre ?></p> </td>
     <td><?php echo $dvd->rating ?></p></td>
     <td><?php echo $dvd->format ?></p></td>
    </tr>
</div>
<?php endforeach; ?>
<?php endif; ?>

    </table>

