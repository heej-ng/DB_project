<html>
<head>
<title>CASE INFO</title>
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
  <!-- Case table -->
  <table class="table table-striped">
    <tr>
      <th>Case ID</th>
      <th>Province</th>
      <th>City</th>
      <th>Infection group</th>
      <th>Infection case</th>
      <th>Confirmed</th>
      <th>Latitude</th>
      <th>Longitude</th>
    </tr>

    <?php
      require_once 'dbconfig.php';
      $count_query = "select count(*) as count from CASEINFO;";
      $count_sql = mysqli_query($link, $count_query);
      $count = mysqli_fetch_assoc($count_sql);
      echo "Case Info table (Currently ", $count['count'], ") cases in database)";
    ?>

    <?php
      $sql = "select * from CASEINFO";
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
