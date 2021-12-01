<html>
<head>
<title>CASE INFO 2</title>
<meta charset='utf-8'>
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
    if(!isset($_POST['province']))
    {
      $value="지역";
    }
    else
    {
      $value=$_POST['province'];
      $mark = "\"";
      $province = $mark.$value.$mark;
    }
   ?>
  <form method="POST" action="<?=$_SERVER['PHP_SELF']?>">
    Province를 선택하세요.<br>
    <input type="text" name="province" value="<?php echo $value;?>">
    <input type="submit" value="검색">
  </form>

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
      if(!isset($_POST['province']))
      {
        $count_query = "select count(*) as count from CASEINFO;";
        $count_sql = mysqli_query($link, $count_query);
        $count = mysqli_fetch_assoc($count_sql);
        echo "Case Info table (Currently ", $count['count'], ") cases in database)";
      }
      else {
        $count_query = "select count(*) as count from CASEINFO where Province=".$province;
        $count_sql = mysqli_query($link, $count_query);
        $count = mysqli_fetch_assoc($count_sql);
        echo "Case Info table (Currently ", $count['count'], ") cases in database)";
      }
    ?>

    <?php
      if(!isset($_POST['province']))
      {
        $sql = "select * from CASEINFO";
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
        $sql = "select * from CASEINFO where Province=".$province;
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
