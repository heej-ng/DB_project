<html>
<head>
<title>PATIENT INFO 2</title>
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
  <?php
    if(!isset($_POST['sex']))
    {
      $value = "";
    }
    else if($_POST['sex']=="all")
    {
      $sex = $_POST['sex'];
    }
    else if($_POST['sex']=="none")
    {
      $sex = $_POST['sex'];
    }
    else
    {
      $value = $_POST['sex'];
      $mark = "\"";
      $sex = $mark.$value.$mark;
    }
   ?>
  <form method="POST">
    Sex를 선택하세요.<br>
    <select name="sex" value="<?php echo $value;?>">
      <option value="all">All</option>
      <option value="male">male</option>
      <option value="female">female</option>
      <option value="none">none</option>
    </select>
    <input type="submit" value="검색">
  </form>

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
      if(!isset($_POST['sex']) || $sex=="all")
      {
        $count_query = "select count(*) as count from PATIENTINFO;";
        $count_sql = mysqli_query($link, $count_query);
        $count = mysqli_fetch_assoc($count_sql);
        echo "Patient Info table (Currently ", $count['count'], ") patients in database)";
      }
      else if($sex=="none")
      {
        $count_query = "select count(*) as count from PATIENTINFO where Sex is NULL;";
        $count_sql = mysqli_query($link, $count_query);
        $count = mysqli_fetch_assoc($count_sql);
        echo "Patient Info table (Currently ", $count['count'], ") patients(no sex information) in database)";
      }
      else {
        $count_query = "select count(*) as count from PATIENTINFO where Sex=".$sex;
        $count_sql = mysqli_query($link, $count_query);
        $count = mysqli_fetch_assoc($count_sql);
        echo "Patient Info table (Currently ", $count['count'], ") ", $_POST['sex']," patients in database)";
      }
    ?>

    <?php
      if(!isset($_POST['sex']) || $sex=="all")
      {
        $sql = "select * from PATIENTINFO";
        $result = mysqli_query($link, $sql);

        while($row = mysqli_fetch_assoc($result)){
          print "<tr>";
          foreach ($row as $key => $val) {
            print "<td>" . $val . "</td>";
          }
          print "</tr>";
        }
      }
      else if($sex=="none")
      {
        $sql = "select * from PATIENTINFO where Sex is NULL;";
        $result = mysqli_query($link, $sql);

        while($row = mysqli_fetch_assoc($result)){
          print "<tr>";
          foreach ($row as $key => $val) {
            print "<td>" . $val . "</td>";
          }
          print "</tr>";
        }
      }
      else {
        $sql = "select * from PATIENTINFO where Sex=".$sex;
        $result = mysqli_query($link, $sql);

        while($row = mysqli_fetch_assoc($result)){
          print "<tr>";
          foreach ($row as $key => $val) {
            print "<td>" . $val . "</td>";
          }
          print "</tr>";
        }
      }
    ?>

</table>

</body>
</html>
