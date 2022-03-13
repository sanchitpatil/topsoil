<!DOCTYPE html>
<html lang="en">
<head>
  <title>Topsoil Calculator</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Topsoil Calculator</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Calculator</a></li>
    </ul>
  </div>
</nav>
  
<div class="container">
  <h3>Topsoil Calculator</h3>
  <form class="form-horizontal" action="index.php" method="post">
    <div class="form-group">
        <label class="control-label col-sm-1" for="width">Width:</label>
        <div class="col-sm-3">
        <input type="number" step="any" class="form-control" id="width" name="width" placeholder="Enter width" required validate>
        </div>

        <label class="control-label col-sm-1" for="length">Length:</label>
        <div class="col-sm-3">
        <input type="number" step="any" class="form-control" id="length" name="length" placeholder="Enter Length" required validate>
        </div>

        <label class="control-label col-sm-1" for="length">Unit:</label>
        <div class="col-sm-3">
        <select class="form-control" name="unit">
            <option value="meters">Meters</option>
            <option value="feet">Feet</option>
            <option value="yards">Yards</option>
        </select>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-1" for="depth">Depth:</label>
        <div class="col-sm-3">
        <input type="number" step="any" class="form-control" id="depth" name="depth" placeholder="Enter Depth" required validate>
        </div>

        <label class="control-label col-sm-1" for="length">Depth Unit:</label>
        <div class="col-sm-3">
        <select class="form-control" name="dunit" required>
            <option value="centimeters">Centimeters</option>
            <option value="inches">Inches</option>
        </select>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-1 col-sm-1">
        <button type="submit" name="calculate" class="btn btn-default">Calculate</button>
        </div>
    </div>
    </form>

    <?php
    include("topsoil.php");
    $ts = new Topsoil;
    if(isset($_POST['calculate'])) {
      $ts_measurement_unit = $_POST['unit'];
      $ts_depth_measurement_unit = $_POST['dunit'];
      $ts_dimension_width = is_numeric($_POST['width']) ? $_POST['width'] : 0;
      $ts_dimension_length = is_numeric($_POST['length']) ? $_POST['length'] : 0;
      $ts_dimension_depth = is_numeric($_POST['depth']) ? $_POST['depth'] : 0;

      $ts->set_measurement_unit($ts_measurement_unit);
      $ts->set_depth_measurement_unit($ts_depth_measurement_unit);
      $ts->set_dimension($ts_dimension_width,$ts_dimension_length,$ts_dimension_depth);
      $total_bags = $ts->calculate_bags();
      $total_cost = $ts->cost_calculator($total_bags);
      echo"<h2>You'll need total ".$total_bags." Soil bags</h2><br>";
      echo"<h3>This will cost you £".$total_cost."</h3><br>";
    }
    ?>
</div>

</body>
</html>
