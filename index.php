<?php
  session_start();
  include "connect.php";
  if ($_SESSION["id"] == ""){
    header("Location:Login");
  }
  $id = $_SESSION["id"];
  //ใส่โค๊ดด้านล่างนี้เพื่อทำให้ Query ข้อมูลออกมาเป็นภาษาไทย
  mysqli_query($conn, "SET character_set_results=utf8");
  mysqli_query($conn, "SET character_set_client='utf8'");
  mysqli_query($conn, "SET character_set_connection='utf8'");
  mysqli_query($conn, "collation_connection = utf8_unicode_ci");
  mysqli_query($conn, "collation_database = utf8_unicode_ci");
  mysqli_query($conn, "collation_server = utf8_unicode_ci");
?>
<!DOCTYPE html>
<html>
<head>
  <title>SmartHome</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="Login/images/icons/favicon.ico"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
  <script>
    function chkit(nameInput, chk) {
      statusDevice = 0;
      if (chk.checked) {
        statusDevice = 1
      }else{
        statusDevice = 0
      }

      $.ajax({
              type: 'GET',
              url: 'ajax.php',
              data: { chkYesNo: statusDevice, nameInput: nameInput}
          });
    }
  </script>
</head>
<body>
<div class="container">
  <h2>User : <?php echo $_SESSION["user"]; ?></h2>         
  <table class="table">
    <thead>
      <tr>
        <th>ชื่อกล่อง</th>
        <th>ชื่ออุปกรณ์</th>
        <th>สถานะอุปกรณ์</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $sql = "SELECT * FROM Authority WHERE idCus='" . $id . "'";
        $resultAut = $conn->query($sql);
        if ($resultAut->num_rows > 0) {
          while($rowAut = $resultAut->fetch_assoc()) {
            $sql = "SELECT  idBox, nameBox, statusDevice1,  statusDevice2,  statusDevice3, nameDevice1,  nameDevice2,  nameDevice3 FROM Box WHERE idBox = '" . $rowAut["idBox"] . "'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                ?>
                <tr>
                  <td rowspan="3"><?php echo $row["nameBox"]; ?></td>
                  <td><?php echo $row["nameDevice1"]; ?></td>
                  <?php
                    if ($row["statusDevice1"] == "1"){
                      $nameInput = "statusDevice1_" . $row["idBox"];
                      ?>
                      <td><input name="chk" type="checkbox" checked data-toggle="toggle" onchange="chkit(<?php echo "'" . $nameInput . "'"; ?>,this);"></td>
                      <?php
                    }else{
                      $nameInput = "statusDevice1_" . $row["idBox"];
                      ?>
                      <td><input name="chk" type="checkbox" data-toggle="toggle" onchange="chkit(<?php echo "'" . $nameInput . "'"; ?>,this);"></td>
                      <?php
                    }
                  ?>
                </tr>
                <tr>
                  <td><?php echo $row["nameDevice2"]; ?></td>
                  <?php
                    if ($row["statusDevice2"] == "1"){
                      $nameInput = "statusDevice2_" . $row["idBox"];
                      ?>
                      <td><input name="chk" type="checkbox" checked data-toggle="toggle" onchange="chkit(<?php echo "'" . $nameInput . "'"; ?>,this);"></td>
                      <?php
                    }else{
                      $nameInput = "statusDevice2_" . $row["idBox"];
                      ?>
                      <td><input name="chk" type="checkbox" data-toggle="toggle" onchange="chkit(<?php echo "'" . $nameInput . "'"; ?>,this);"></td>
                      <?php
                    }
                  ?>
                </tr>
                <tr>
                  <td><?php echo $row["nameDevice3"]; ?></td>
                  <?php
                    if ($row["statusDevice3"] == "1"){
                      $nameInput = "statusDevice3_" . $row["idBox"];
                      ?>
                      <td><input name="chk" type="checkbox" checked data-toggle="toggle" onchange="chkit(<?php echo "'" . $nameInput . "'"; ?>,this);"></td>
                      <?php
                    }else{
                      $nameInput = "statusDevice3_" . $row["idBox"];
                      ?>
                      <td><input name="chk" type="checkbox" data-toggle="toggle" onchange="chkit(<?php echo "'" . $nameInput . "'"; ?>,this);"></td>
                      <?php
                    }
                  ?>
                </tr>
                <?php
              }
            } else{
              echo "0 results";
            }
          }
        }
      ?>
    </tbody>
  </table>
</div>

</body>
</html>