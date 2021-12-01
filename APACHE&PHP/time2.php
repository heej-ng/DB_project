<html>
<head>
<title>TIME INFO 2</title>
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
    if(!isset($_POST['date']))
    {
      $value="2020-01-20";
    }
    else
    {
      $value=$_POST['date'];
      $mark = "\"";
      $date = $mark.$value.$mark;
    }
   ?>
  <form method="POST" action="<?=$_SERVER['PHP_SELF']?>">
    날짜를 선택하세요.<br>
    <input type="date" name="date" value="<?php echo $value;?>" min="2020-01-20">
    <input type="submit" value="검색">
  </form>

  <!-- Case table -->
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
      if(!isset($_POST['date']))
      {
        $count_query = "select count(*) as count from TIMEINFO;";
        $count_sql = mysqli_query($link, $count_query);
        $count = mysqli_fetch_assoc($count_sql);
        echo "Time Info table (Currently ", $count['count'], ") rows in database)";
      }
      else {
        $count_query = "select count(*) as count from TIMEINFO where Date=".$date;
        $count_sql = mysqli_query($link, $count_query);
        $count = mysqli_fetch_assoc($count_sql);
        echo "Time Info table (Currently ", $count['count'], ") rows in database)";
      }
    ?>

    <?php
      if(!isset($_POST['date']))
      {
        $sql = "select * from TIMEINFO";
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
        $sql = "select * from TIMEINFO where Date=".$date;
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
