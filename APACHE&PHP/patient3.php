<html lang="ko">
<head>
<title>PATIENT INFO 3</title>
<meta charset = 'utf-8'>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyD8y-VoNRWbuLhKy5QLdUvxhxROqtdZHZc">//키를 발급받아 사용하세요</script>
<style>

#map_ma {width:100%; height:400px; clear:both; border:solid 1px red;}
</style>
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
    if(!isset($_POST['hospital_id']))
    {
      $value="";
    }
    else
    {
      $value=$_POST['hospital_id'];
      $hospital_id = $_POST['hospital_id'];
    }
   ?>

  <form method="POST" action="<?=$_SERVER['PHP_SELF']?>">
    Hospital_id를 입력하세요.<br>
    <input type="text" name="hospital_id" value="<?php echo $value;?>">
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
      <th>Hospital_id</th>
    </tr>

    <?php
      require_once 'dbconfig.php';
      if(!isset($_POST['hospital_id'])||($_POST['hospital_id']==""))
      {
        $count_query = "select count(*) as count from PATIENTINFO;";
        $count_sql = mysqli_query($link, $count_query);
        $count = mysqli_fetch_assoc($count_sql);
        echo "Patient Info table (Currently ", $count['count'], ") patients in database)";
      }
      else {
        $count_query = "select count(*) as count from PATIENTINFO where hospital_id=".$hospital_id;
        $count_sql = mysqli_query($link, $count_query);
        $count = mysqli_fetch_assoc($count_sql);
        echo "Patient Info table (Currently ", $count['count'], ") ", $_POST['hospital_id']," patients in database)";
      }
    ?>

  <form action="index.php" method="POST">
    <?php
      //require_once 'dbconfig.php';
      if(!isset($_POST['hospital_id'])||($_POST['hospital_id']==""))
      {
        $sql = "select * from PATIENTINFO";
        $result = mysqli_query($link, $sql);

        while($row = mysqli_fetch_assoc($result)){
          print "<tr>";
          $cnt = 0;
          foreach ($row as $key => $val) {
            if($key=="hospital_id" && $val!=NULL)
            {
              $sql = "select hname, latitude, longitude from HOSPITAL where hospital_id=".$val;
              $re = mysqli_query($link, $sql);
              $location = mysqli_fetch_assoc($re);
              $x = $location["latitude"];
              $y = $location["longitude"];
              $name = $location["hname"];
              $name = str_replace(" ","",$name);

              print "<td> <a href=\"http://localhost/index?$x/$y/$name\">". $val . "</td>";
              # cnt==14면 hospital_id 출력할 차례 -> 구글 맵 연결 시켜야 함
            }
            else
              print "<td>" . $val . "</td>";
            $cnt++;
          }
          #echo $row['hospital_id'].'<br>';
          print "</tr>";
        }
      }
      else {
        $sql = "select * from PATIENTINFO where hospital_id=".$hospital_id;
        $result = mysqli_query($link, $sql);

        while($row = mysqli_fetch_assoc($result)){
          print "<tr>";
          $cnt = 0;
          foreach ($row as $key => $val) {
            if($key=="hospital_id") //$cnt==14
            {
              $sql = "select hname,latitude, longitude from HOSPITAL where hospital_id=".$val;
              $re = mysqli_query($link, $sql);
              $location = mysqli_fetch_assoc($re);
              $x = $location["latitude"];
              $y = $location["longitude"];
              $name = $location["hname"];
              $name = str_replace(" ","",$name);

              print "<td> <a href=\"http://localhost/index?$x/$y/$name\">". $val . "</td>";
              # cnt==14면 hospital_id 출력할 차례 -> 구글 맵 연결 시켜야 함
            }
            else
              print "<td>" . $val . "</td>";
            $cnt++;
          }
          #echo $row['hospital_id'].'<br>';
          print "</tr>";
        }
      }
    ?>
  </form>
</table>

</body>
</html>