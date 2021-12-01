<html>
<head>
<title>REGION INFO</title>
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
  <!-- Region table -->
  <table class="table table-striped">
    <tr>
      <th>Region Code</th>
      <th>Province</th>
      <th>City</th>
      <th>Latitude</th>
      <th>Longitude</th>
      <th>Elementary school count</th>
      <th>Kindergarten count</th>
      <th>University count</th>
      <th>Academy Ratio</th>
      <th>Elderly population Ratio</th>
      <th>Elderly alone Ratio</th>
      <th>Nursing home count</th>
    </tr>

    <?php
      require_once 'dbconfig.php';
      $count_query = "select count(*) as count from REGION;";
      $count_sql = mysqli_query($link, $count_query);
      $count = mysqli_fetch_assoc($count_sql);
      echo "Region Info table (Currently ", $count['count'], ") regions in database)";
    ?>

    <?php
      $sql = "select * from REGION";
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
