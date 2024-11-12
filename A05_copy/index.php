<?php
include("connect.php");

$query = "SELECT * FROM closefriends";
$result = mysqli_query($conn, $query);

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <div class="container-fluid shadow mb-5 p-3">
    <h1 style="text-align: center; font-weight: bold;">Close Friends</h1>
  </div>
  <div class="container">
    <div class="row">

      <!-- PHP BLOCK -->
      <?php
      if (mysqli_num_rows($result) > 0) {
        while ($user = mysqli_fetch_assoc($result)) {
          $isCloseFriend = $user["isCloseFriend"] == "Yes";
          $cardClasses = $isCloseFriend ? "card rounded-4 shadow my-3 mx-5" : "card rounded-4 my-3 mx-5";
          $backgroundColor = $isCloseFriend ? "lightblue" : "darkgray";
          $fontColor = $isCloseFriend ? "black" : "lightgray";
          ?>

          <div class="col-12">
            <div class="<?php echo $cardClasses; ?>" style="background-color: <?php echo $backgroundColor; ?>; color: <?php echo $fontColor; ?>;">
              <div class="card-body">
                <h5 class="card-title">
                  <?php echo $user["f_Name"] . " " . $user["l_Name"]; ?>
                </h5>
              </div>
            </div>
          </div>

          <?php
        }
      }
      ?>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>
