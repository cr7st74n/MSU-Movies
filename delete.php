<?php
include('./database.php');

// Delete movie
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM Movie WHERE MovieID = :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->execute();
    $statement->closeCursor();

    // Redirect to index page
    header('Location: ./index.php');
    exit();
}
?>
