<html>
<head>
<title>PATIENT INFO</title>
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
  <!-- Patient table -->
  <table class="table table-striped">
    <tr>
      <th>Patient ID</th>
      <th>Sex</th>
      <th>Age</th>
      <th>Country</th>
      <th>Province</th>
      <th>City</th>
      <th>Infection Case</th>
      <th>Infected by</th>
      <th>Contact number</th>
      <th>Symptom onset date</th>
      <th>Confirmed date</th>
      <th>Released date</th>
      <th>Deceased date</th>
      <th>State</th>
    </tr>

    <?php
      require_once 'dbconfig.php';
      $count_query = "select count(*) as count from PATIENTINFO;";
      $count_sql = mysqli_query($link, $count_query);
      $count = mysqli_fetch_assoc($count_sql);
      echo "Patient Info table (Currently ", $count['count'], ") patients in database)";
    ?>

    <?php
      $sql = "select * from PATIENTINFO";
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
