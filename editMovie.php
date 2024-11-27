<!DOCTYPE html>
<html lang="en">

<?php include("./view/head.php"); ?>



<body>
    <?php include('./view/header.php'); ?>

    <main class="container">
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

        <h2>Edit Movie</h2>

        <form method="post" action="editMovie.php">
            <input type="hidden" name="id" value="<?php echo isset($movie['MovieID']) ? htmlspecialchars($movie['MovieID']) : ''; ?>">

            <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <label for="title" class="col-form-label">Title:</label>
                </div>
                <div class="col-auto">
                    <input name="title" required type="text" id="title" class="form-control"
                        value="<?php echo isset($movie['MovieTitle']) ? htmlspecialchars($movie['MovieTitle']) : ''; ?>"
                        aria-describedby="titleHelpInline">
                </div>
            </div>
            <br>
            <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <label for="release_date" class="col-form-label">Release Date:</label>
                </div>
                <div class="col-auto">
                    <input name="release_date" required type="date" id="release_date" class="form-control"
                        value="<?php echo isset($movie['ReleaseDate']) ? htmlspecialchars($movie['ReleaseDate']) : ''; ?>"
                        aria-describedby="releaseDateHelpInline">
                </div>
            </div>
            <br>
            <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <label for="genre" class="col-form-label">Genre:</label>
                </div>
                <div class="col-auto">
                    <input name="genre" required type="text" id="genre" class="form-control"
                        value="<?php echo isset($movie['Genre']) ? htmlspecialchars($movie['Genre']) : ''; ?>"
                        aria-describedby="genreHelpInline">
                </div>
            </div>
            <br>
            <button class="btn btn-primary" type="submit">Update Movie</button>
        </form>

    </main>

    <?php include("./view/footer.php"); ?>
</body>

</html>