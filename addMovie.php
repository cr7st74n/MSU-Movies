<!DOCTYPE html>
<html lang="en">

<?php include("./view/head.php"); ?>

<body>
    <?php include('./view/header.php'); ?>

    <main class="container">
        <h1> Add new movies here:</h1>
            <form method="post" action="addMovie.php">
                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                        <label for="title" class="col-form-label">Title:</label>
                    </div>
                    <div class="col-auto">
                        <input name="title" required type="text" id="title" class="form-control" aria-describedby="passwordHelpInline">
                    </div>
                </div>
                <br>
                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                        <label for="release_date" class="col-form-label">Release Date:</label>
                    </div>
                    <div class="col-auto">
                        <input required name="release_date" required type="date" id="release_date" class="form-control" aria-describedby="passwordHelpInline">
                    </div>
                </div>
                <br>
                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                        <label for="genre" class="col-form-label">Genre:</label>
                    </div>
                    <div class="col-auto">
                        <input required name="genre" required type="text" id="genre" class="form-control" aria-describedby="passwordHelpInline">
                    </div>
                </div>
                <br>
                    <button class="btn btn-primary" type="submit">Insert Movie</button>

            </form>

            <?php
            include('./database.php'); // Include database connection

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
                header('Location: ./index.php');
                exit();
            }
            ?>

    </main>

    <?php include("./view/footer.php"); ?>
</body>

</html>