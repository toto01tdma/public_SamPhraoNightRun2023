<?php
    require_once("../../service/connect.php");
    $obj = new ConnectDatabase();
    $obj->getSessionStart();

    if(!isset($_SESSION["admin"])){ 
        header("location: ../../pages/homepage/");
        exit;
    }elseif($_SESSION["admin"]["level"] != "1"){
        header("location: ../../pages/homepage/");
        exit;
    }

    $obj = new ConnectDatabase();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/x-icon" href="../../assets/images/obt_samphrao.png">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>แสดงรายชื่อผู้ดูแล</title>
  <link rel="shortcut icon" type="image/x-icon" href="">
  <!-- stylesheet -->
  <link rel="stylesheet" href="../../assets/css/adminlte.min.css">
  <link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="../../assets/css/style55.css">
  <style>
        *{
            font-family:tahoma;
        }
        .table, tr, th, td{
            border:1px solid black;
        }
  </style>
</head>
<body>
    <?php require_once("../../pages/include/navbar.php"); ?>
    <div class="container">
        <div class="justify-content-center row">
            <section class="col-lg-12">
                <br>
                <br>
                <br>
                <a href="../../pages/homepage/" class="btn btn-info mt-3 shadow">&#10094;&#10094;&#10094; ย้อนกลับ</a>
                <!-- <a href="contest.php" class="btn btn-dark mt-3 shadow"><< ดูรายชื่อผู้เข้าแข่งขันทั้งหมด >> </a> -->
                <div class="card shadow p-3 p-md-4 mt-4" style="overflow-x:auto;">
                    <h3 class="font-weight-bold">รายชื่อผู้ดูแลทั้งหมด</h3>
                    <table class="table" id="list_team" style="border-collapse: collapse; border-spacing: 0; width: 100%; border: 1px solid #ddd;">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">ลำดับ</th>
                                <th scope="col">Username ผู้ดูแล</th>
                                <th scope="col">ชื่อผู้ดูแล</th>
                                <th scope="col">ระดับผู้ดูแล</th>
                                <?php if($_SESSION["admin"]["level"] == "1"){ ?>
                                    <th scope="col">แก้ไข</th>
                                    <th scope="col">ลบ</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                    $statment = $obj->getConnect()->prepare("SELECT * FROM admins");
                                    $statment->execute();
                                    $index = 0;
                                    while($result = $statment->fetch(PDO::FETCH_ASSOC)){
                                        $index += 1;
                                        $txt_level = ($result["level"] == "1") ? "ผู้ดูแลสูงสุด (Super Admin)" : "ผู้ดูแลปกติ (Admin)";?>
                                        <tr>
                                            <td scope="col"> <?php echo $index;?> </td>
                                            <td scope="col"> <?php echo $result["username"];?> </td>
                                            <td scope="col"> <?php echo $result["name"];?> </td>
                                            <td scope="col"> <?php echo $txt_level;?> </td>
                                            <?php if($_SESSION["admin"]["level"] == "1"){ ?>
                                                <td scope="col" class="text-center"> <a href="edit.php?admin_id=<?php echo $result["admin_id"];?>" class="btn btn-warning">แก้ไข</a> </td>
                                                <td scope="col" class="text-center"> <a href="../../service/admin/delete.php?admin_id=<?php echo $result["admin_id"];?>" onclick="return confirmDelete();" class="btn btn-danger">ลบ</a> </td>
                                            <?php } ?>
                                        </tr>
                            <?php   } ?>
                        </tbody>
                    </table>
                </div>

            </section>
        </div>
    </div>

<!-- scripts -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/adminlte.min.js"></script>
<script>
    function confirmDelete(){
        if(confirm("คุณต้องการลบผู้ดูแลรายนี้ออกใช่หรือไม่ ?")){
            return true;
        }else{
            return false;
        }
    }
</script>

</body>
</html>
