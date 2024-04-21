<?php
include "db_conn.php";
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
} else {
    die('Error: No ID provided.');
}

// Fetch existing data
$sql = "SELECT * FROM `crud` WHERE id = $id";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
$row = mysqli_fetch_assoc($result);
if (!$row) {
    echo "No record found with ID $id.";
    exit;
}

// Handle form submission
if (isset($_POST['submit'])) {
    $firstName = mysqli_real_escape_string($conn, $_POST['first_name']);
    $lastName = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);

    $updateSql = "UPDATE `crud` SET first_name='$firstName', last_name='$lastName', email='$email', gender='$gender' WHERE id=$id";
    if (mysqli_query($conn, $updateSql)) {
        header('Location: index.php?msg=Record updated successfully.');
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!---Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--font-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>PHP CRUD Application</title>

</head>
<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color:#00ff5573;">
        PHP Complete CRUD Application
    </nav>
<div class="container">
    <div class="text-center mb-4">
        <h3>Update User Information</h3>
        <p class="text-muted">Complete the form to update user information</p>
    </div>
    <div class="container d-flex justify-content-center">
        <form action="" method="post" style="width:50vw; min-width:300px;">
        <div class="row">
            <div class="col">
                <label class="form-label">First Name</label>
                <input type="text" class="form-control" name="first_name"
                value="<?php echo $row['first_name'] ?>">
            </div>
            <div class="col">
                <label class="form-label">Last Name</label>
                <input type="text" class="form-control" name="last_name"
                value="<?php echo $row['last_name'] ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email"
                value="<?php echo $row['email'] ?>">
            </div>

            <div class="form-group mb-3">
               <label>Gender:</label>
               &nbsp;
               <input type="radio" class="form-check-input" name="gender" id="male" value="male">
               <label for="male" class="form-input-label">Male</label>
               &nbsp;
               <input type="radio" class="form-check-input" name="gender" id="female" value="female">
               <label for="female" class="form-input-label">Female</label>
            </div>

            <div>
               <button type="submit" class="btn btn-success" name="submit">Save</button>
               <a href="index.php" class="btn btn-danger">Cancel</a>
            </div>
         </form>
      </div>
   </div>

   <!-- Bootstrap -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>