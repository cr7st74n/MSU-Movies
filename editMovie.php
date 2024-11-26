<!DOCTYPE html>
<html lang="en">

<?php include("./view/head.php"); ?>

<body>
    <?php include('./view/header.php'); ?>

    <h2>Edit Movie</h2>
    <form method="post" action="edit.php">
        <input type="hidden" name="id" value="<?php echo $movie['MovieID']; ?>">
        <label>Title:</label>
        <input type="text" name="title" value="<?php echo $movie['MovieTitle']; ?>" required><br>
        <label>Release Date:</label>
        <input type="date" name="release_date" value="<?php echo $movie['ReleaseDate']; ?>" required><br>
        <label>Genre:</label>
        <input type="text" name="genre" value="<?php echo $movie['Genre']; ?>" required><br>
        <button type="submit">Update Movie</button>
    </form>

    <?php include("./view/footer.php"); ?>
</body>

</html>

<?php
include('./database.php');

// Fetch movie details
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM Movie WHERE MovieID = :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->execute();
    $movie = $statement->fetch();
    $statement->closeCursor();
}

// Update movie details
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $release_date = $_POST['release_date'];
    $genre = $_POST['genre'];

    $query = "UPDATE Movie SET MovieTitle = :title, ReleaseDate = :release_date, Genre = :genre WHERE MovieID = :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':release_date', $release_date);
    $statement->bindValue(':genre', $genre);
    $statement->execute();
    $statement->closeCursor();

    // Redirect to index page
    header('Location: ./index.php');
    exit();
}
?>