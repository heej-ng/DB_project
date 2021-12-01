<html>
<head>
<title>VIEW PROVINCE</title>
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
      <th>province</th>
      <th>patient_count</th>
    </tr>

    <?php
      require_once 'dbconfig.php';
      $count_query = "select count(*) as count from PROVINCE_COUNT;";
      $count_sql = mysqli_query($link, $count_query);
      $count = mysqli_fetch_assoc($count_sql);
      echo "PROVINCE_COUNT VIEW table (Currently ", $count['count'], ") cases in database)";
    ?>

    <?php
      $create_sql = "CREATE view PROVINCE_COUNT AS select province, count(*) as patient_count from PatientInfo group by province order by count(*) DESC;";
      $result = mysqli_query($link, $create_sql);

      $sql = "select province, patient_count from PROVINCE_COUNT";
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
