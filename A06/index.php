<?php
include("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['f_Name'])) {
      $f_Name = mysqli_real_escape_string($conn, $_POST['f_Name']);
      $l_Name = mysqli_real_escape_string($conn, $_POST['l_Name']);
      $status = mysqli_real_escape_string($conn, $_POST['status']);

      $insertQuery = "INSERT INTO closefriends (f_Name, l_Name, status) VALUES ('$f_Name', '$l_Name', '$status')";
      executeQuery($insertQuery); 
  }

  if (isset($_POST['delete_id'])) {
      $delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);
      
      $deleteQuery = "UPDATE closefriends SET is_deleted = 'yes' WHERE closeFriendID = '$delete_id'";
      executeQuery($deleteQuery); 
  }
}


$query = "SELECT * FROM closefriends WHERE is_deleted = 'no'";
$result = executeQuery($query);

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

  .card-body {
    display: block;
  }

  .card-body p {
    margin-bottom: 10px;
  }
</style>

<body>
  <div class="container-fluid shadow mb-5 p-3">
    <h1 style="text-align: center; font-weight: bold;">Friendship Status</h1>
  </div>

  <div class="container">
    <div class="row">
      <div class="card p-4">
        <form action="" method="POST">
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="f_Name" placeholder="First Name" required>
            <input type="text" class="form-control" name="l_Name" placeholder="Last Name">

            <select class="form-control" name="status" required>
              <option value="" disabled selected>Status</option>
              <option value="Close Friend">Close Friend</option>
              <option value="Friend">Friend</option>
            </select>

            <button class="btn btn-primary" type="submit">Add</button>
          </div>
        </form>
      </div>
    </div>

    <div class="row mt-4">
      <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($user = mysqli_fetch_assoc($result)): ?>
          <?php
          $status = isset($user["status"]) && $user["status"] === "Close Friend";
          $cardClasses = "card rounded-4 shadow my-3 mx-5";
          $backgroundColor = $status ? "lightblue" : "#e0f7e0";
          ?>
          <div class="col-12">
            <div class="<?php echo $cardClasses; ?>" style="background-color: <?php echo $backgroundColor; ?>;">
              <div class="card-body">
                <h5 class="card-title">
                  <?php echo htmlspecialchars($user["f_Name"] . " " . $user["l_Name"]); ?>
                </h5>
                <p class="card-text">
                  Status: <?php echo isset($user["status"]) ? htmlspecialchars($user["status"]) : "Unknown"; ?>
                </p>
                <form action="" method="POST" onsubmit="return confirmDelete();">
                  <input type="hidden" name="delete_id" value="<?php echo $user['closeFriendID']; ?>">
                  <button class="btn btn-danger" type="submit">Remove</button>
                </form>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p>No close friends found.</p>
      <?php endif; ?>
    </div>
  </div>

  <script>
    function confirmDelete() {
      return confirm("Are you sure you want to remove this friend?");
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>
