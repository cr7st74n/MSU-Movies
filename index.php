<!DOCTYPE html>
<html lang="en">

<?php include("./view/head.php"); ?>
<!-- Include the database: -->
<?php include("./database.php") ?>

<body>
    <?php include('./view/header.php'); ?>

    <!-- Fetch the DB all movies. -->
    <?php
    $query = "SELECT * FROM Movie";
    $statement = $db->prepare($query);
    $statement->execute();
    $movies = $statement->fetchAll();
    $statement->closeCursor();
    ?>

    <main class="container">
        <h1>All Movies Here ! 😁 </h1>
        <!-- Create table  -->

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Release Date</th>
                    <th scope="col">Genre</th>
                    <th scope="col">Options</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($movies as $movie): ?>
                    <tr>
                            <th scope="row"><?php echo htmlspecialchars($movie['MovieTitle']); ?></th>
                            <td><?php echo htmlspecialchars($movie['ReleaseDate']);  ?></td>
                            <td><?php echo htmlspecialchars($movie['Genre']); ?></td>
                            <td>
                                <a href="./editMovie.php?id=<?php echo $movie['MovieID']; ?>" class="btn btn-warning">Edit</a>
                                <a href="./delete.php?id=<?php echo $movie['MovieID']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this movie?');">Delete</a>
                            </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </main>

    <?php include("./view/footer.php"); ?>
</body>

</html>