<html>
<head>
<title>TIME INFO</title>
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
  <!-- TimeInfo table -->
  <table class="table table-striped">
    <tr>
      <th>Date</th>
      <th>Test</th>
      <th>Negative</th>
      <th>Confirmed</th>
      <th>Released</th>
      <th>Deceased</th>
    </tr>

    <?php
      require_once 'dbconfig.php';
      $count_query = "select count(*) as count from TIMEINFO;";
      $count_sql = mysqli_query($link, $count_query);
      $count = mysqli_fetch_assoc($count_sql);
      echo "Time Info table (Currently ", $count['count'], ") times in database)";
    ?>

    <?php
      $sql = "select * from TIMEINFO";
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
