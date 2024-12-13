<?php
include("connect.php");

$airlineNameFilter = $_GET['airlineName'] ?? "";
$aircraftTypeFilter = $_GET['aircraftType'] ?? "";
$sort = $_GET['sort'] ?? "";
$order = $_GET['order'] ?? "";

$flightQuery = "SELECT * FROM flightlogs";

if ($airlineNameFilter != '' || $aircraftTypeFilter != '') {
  $flightQuery = $flightQuery . " WHERE";

  if ($airlineNameFilter != '') {
    $flightQuery = $flightQuery . " airlineName='$airlineNameFilter'";
  }

  if ($airlineNameFilter != '' && $aircraftTypeFilter != '') {
    $flightQuery = $flightQuery . " AND";
  }

  if ($aircraftTypeFilter != '') {
    $flightQuery = $flightQuery . " aircraftType='$aircraftTypeFilter'";
  }
}

if ($sort != '') {
  $flightQuery = $flightQuery . " ORDER BY $sort";

  if ($order != '') {
    $flightQuery = $flightQuery . " $order";
  }
}

$flightResults = executeQuery($flightQuery);

$airlineNameQuery = "SELECT DISTINCT airlineName FROM flightlogs";
$airlineNameResults = executeQuery($airlineNameQuery);

$aircraftTypeQuery = "SELECT DISTINCT aircraftType FROM flightlogs";
$aircraftTypeResults = executeQuery($aircraftTypeQuery);

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Students</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <div class="row my-5">
      <div class="col">
        <form>
          <div class="card p-4 rounded-5">
            <div class="row">
              <div class="h4 text-center">
                Filter
              </div>
              <div class="d-flex flex-row align-items-center">
                <div class="col-3 p-2">
                  <label for="airlineName" class="ms-2 mb-2 ">Airline Name </label>
                  <select id="airlineName" name="airlineName" class="ms-2 form-control">
                    <option value="">Any</option>
                    <?php
                    if (mysqli_num_rows($airlineNameResults) > 0) {
                      while ($airlineNameRow = mysqli_fetch_assoc($airlineNameResults)) {
                        ?>

                        <option <?php if ($airlineNameFilter == $airlineNameRow['airlineName']) {
                          echo "selected";
                        } ?>
                          value="<?php echo $airlineNameRow['airlineName'] ?>">
                          <?php echo $airlineNameRow['airlineName'] ?>
                        </option>

                        <?php
                      }
                    }
                    ?>

                  </select>
                </div>

                <div class="col-3 p-2">
                  <label for="aircraftTypeSelect" class="ms-2 mb-2">Aircraft Type</label>
                  <select id="aircraftTypeSelect" name="aircraftType" class="ms-2 form-control">
                    <option value="">Any</option>
                    <?php
                    if (mysqli_num_rows($aircraftTypeResults) > 0) {
                      while ($aircraftTypeRow = mysqli_fetch_assoc($aircraftTypeResults)) {
                        ?>

                        <option <?php if ($aircraftTypeFilter == $aircraftTypeRow['aircraftType']) {
                          echo "selected";
                        } ?>
                          value="<?php echo $aircraftTypeRow['aircraftType'] ?>">
                          <?php echo $aircraftTypeRow['aircraftType'] ?>
                        </option>

                        <?php
                      }
                    }
                    ?>
                  </select>
                </div>

                <div class="col-3 p-2">
                  <label for="sort"  class="ms-2 mb-2">Sort By</label>
                  <select id="sort" name="sort" class="ms-2 form-control"   >
                    <option value="">None</option>

                    <option <?php if ($sort == "flightNumber") {
                      echo "selected";
                    } ?> value="flightNumber">Flight Number
                    </option>

                    <option <?php if ($sort == "passengerCount") {
                      echo "selected";
                    } ?> value="passengerCount">Passenger
                      Count
                    </option>

                    <option <?php if ($sort == "pilotName") {
                      echo "selected";
                    } ?> value="pilotName">Pilot Name</option>
                  </select>
                </div>

                <div class="col-3 p-2">
                  <label for="order" class="ms-2 mb-2">Order</label>
                  <select id="order" name="order" class="ms-2 form-control"   >
                    <option <?php if ($order == "ASC") {
                      echo "selected";
                    } ?> value="ASC">Ascending</option>
                    <option <?php if ($order == "DESC") {
                      echo "selected";
                    } ?> value="DESC">Descending</option>
                  </select>
                </div>

              </div>

              <div class="text-center">
                <button class="btn btn-primary ms-2 mt-4"   >Submit</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="row my-5">
      <div class="col">
        <div class="card p-4 rounded-5">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Airline Name</th>
                  <th scope="col">AirCraft Type</th>
                  <th scope="col">Flight Number</th>
                  <th scope="col">Passenger Count</th>
                  <th scope="col">Pilot Name</th>
                  <th scope="col">Arrival Date Time</th>
                  <th scope="col">Departure Date Time</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (mysqli_num_rows($flightResults) > 0) {
                  while ($flightRow = mysqli_fetch_assoc($flightResults)) {
                    $aircraftType = $flightRow['aircraftType'];
                    ?>
                    <tr>
                      <td scope="row"><?php echo $flightRow['airlineName'] ?></td>
                      <td><?php echo $flightRow['aircraftType'] ?></td>
                      <td><?php echo $flightRow['flightNumber'] ?></td>
                      <td><?php echo $flightRow['passengerCount'] ?></td>
                      <td><?php echo $flightRow['pilotName'] ?></td>
                      <td><?php echo $flightRow['arrivalDatetime'] ?></td>
                      <td><?php echo $flightRow['departureDatetime'] ?></td>
                      <td></td>
                    </tr>
                    <?php
                  }
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>