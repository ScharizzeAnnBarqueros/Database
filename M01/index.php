<?php
include("connect.php");

// Check if form is submitted
if (isset($_POST['btnAdd'])) {
  $fName = $_POST['fName'];
  $lName = $_POST['lName'];
  $status = $_POST['status'];

  $insertQuery = "INSERT INTO closefriends (fName, lName, status, is_deleted) VALUES ('$fName', '$lName', '$status', 'no' )";
  executeQuery($insertQuery);

   header('Location: ./');
}

// Fetch records
$selectQuery = "SELECT * FROM closefriends WHERE is_deleted = 'no' ORDER BY closeFriendID DESC";
$result = executeQuery(query: $selectQuery);

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Friends</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<style>
     .row .col-12:last-child {
      margin-bottom: 20px;
    }
  </style>

<body>
  <div class="container-fluid shadow mb-5 p-3">
    <h1 style="text-align: center; font-weight: bold;">Friendship Status</h1>
  </div>

  <div class="container">
    <div class="row">
      <div class="card p-4">
        <!-- Form to input data -->
        <form action="" method="POST">
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="fName" placeholder="First Name" required>
            <input type="text" class="form-control" name="lName" placeholder="Last Name" >
            
            <!-- Dropdown for Status (Non-editable) -->
            <select class="form-control" name="status" required>
            <option value="" disabled selected>Status</option> 
              <option value="Close Friend">Close Friend</option>
              <option value="Friend">Friend</option>
            </select>
            
            <button class="btn btn-primary" name="btnAdd" type="submit">Add</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Display close friends list -->
    <div class="row mt-4">
   <?php
      if (mysqli_num_rows($result) > 0) {
        while ($user = mysqli_fetch_assoc($result)) {


    $status = $user["status"] == "Close Friend";
          $cardClasses = "card rounded-4 shadow my-3 mx-5";
          $backgroundColor = $status ? "lightblue" : "#e0f7e0";
          ?>

        <div class="col-12">
            <div class="<?php echo $cardClasses; ?>" style="background-color: <?php echo $backgroundColor; ?>; color: <?php echo $fontColor; ?>;">
                <div class="card-body">
                    <h5 class="card-title">
                        <?php echo $user["fName"] . " " . $user["lName"]; ?>
                    </h5>
                    <p class="card-text">
                        Status: <?php echo ($user["status"]) ?>
                    </p>
                </div>
            </div>
                 </div>
        <?php
        }
      }
      ?>
    </div>
    <script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>