<!DOCTYPE html>
<html lang="en">

<?php include("./view/head.php"); ?>

<body>
    <?php include('./view/header.php'); ?>

    <main class="container">
        <h1> Add new movies here:</h1>

        <form method="post" action="insert.php">
            <label>Title:</label>
            <input type="text" name="title" required><br>
            <label>Release Date:</label>
            <input type="date" name="release_date" required><br>
            <label>Genre:</label>
            <input type="text" name="genre" required><br>
            <button class="btn btn-primary" type="submit">Insert Movie</button>
        </form>

        <?php
        include('database.php'); // Include database connection

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get form data
            $title = $_POST['title'];
            $release_date = $_POST['release_date'];
            $genre = $_POST['genre'];

            // Insert data into the database
            $query = "INSERT INTO Movie (MovieTitle, ReleaseDate, Genre) VALUES (:title, :release_date, :genre)";
            $statement = $db->prepare($query);
            $statement->bindValue(':title', $title);
            $statement->bindValue(':release_date', $release_date);
            $statement->bindValue(':genre', $genre);
            $statement->execute();
            $statement->closeCursor();

            // Redirect back to the index page
            header('Location: index.php');
            exit();
        }
        ?>

    </main>

    <?php include("./view/footer.php"); ?>
</body>

</html>