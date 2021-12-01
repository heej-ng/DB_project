<html>
<head>
<title>WEATHER</title>
</head>
<style>
  table {
    width: 100%;
    border: 1px solid #444444;
    border-collapse: collapse;
  }
  th, td{
    border: 1px solid #444444;
  }
</style>

<body>
  <!-- Weather table -->
  <table class="table table-striped">
    <tr>
      <th>Region Code</th>
      <th>Province</th>
      <th>Weather date</th>
      <th>Average temperature</th>
      <th>Minimum temperature</th>
      <th>Maximum temperature</th>
    </tr>

    <?php
      require_once 'dbconfig.php';
      $count_query = "select count(*) as count from WEATHER;";
      $count_sql = mysqli_query($link, $count_query);
      $count = mysqli_fetch_assoc($count_sql);
      echo "Weather Info table (Currently ", $count['count'], ") weathers in database)";
    ?>

    <?php
      $sql = "select * from WEATHER";
      $result = mysqli_query($link, $sql);

      while($row = mysqli_fetch_assoc($result)){
        print "<tr>";
        foreach ($row as $key => $val) {
          print "<td>" . $val . "</td>";
        }
        print "</tr>";
      }
    ?>
</table>

</body>
</html>
