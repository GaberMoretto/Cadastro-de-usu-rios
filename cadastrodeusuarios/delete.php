<?php
include "db_conn.php";
if(isset($_GET['id']) && is_numeric($_GET['id'])) { // Check if 'id' is set and is a number
    $id = (int)$_GET['id']; // Safely cast 'id' to an integer
    $sql = "DELETE FROM `crud` WHERE id = $id"; // Use backticks for table name
    $result = mysqli_query($conn, $sql);
    if($result) {
        header("Location: index.php?msg=Record deleted successfully"); // Correct redirection
    } else {
        echo "Failed: " . mysqli_error($conn); // Output SQL error
    }
} else {
    echo "Error: No valid ID provided.";
}
?>
