<?php
    require_once("../../service/connect.php");
    $obj = new ConnectDatabase();
    $obj->getSessionStart();

    if(!isset($_SESSION["admin"])){
        header("location: ../../pages/homepage/");
        exit;
    }else if($_SESSION["admin"]["level"] != "1"){
        header("location: ../../pages/homepage/");
        exit;
    }

    $statment = $obj->getConnect()->prepare("SELECT * FROM admins WHERE admin_id = :admin_id");
    $statment->execute(array(":admin_id" => $_GET['admin_id']));
    $result = $statment->fetch(PDO::FETCH_ASSOC);

    if($result == false){
        header("location: ../../pages/homepage/");
        exit;
    }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title> จัดการข้อมูลผู้ดูแล </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="image/x-icon" href="../../assets/images/obt_samphrao.png">
  <!-- stylesheet -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit"> -->
  <link rel="stylesheet" href="../../assets/css/adminlte.min.css">
  <link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="../../assets/css/style55.css">
  <style>
        *{font-family: tahoma;}
  </style>
</head>
<body>
    <?php require_once("../../pages/include/navbar.php"); ?>
    <br>
    <section class="d-flex align-items-center min-vh-100">
        <div class="container">
            <div class="row justify-content-center">
                <section class="col-lg-6">
                    <div class="card shadow p-3 p-md-4 mt-4">
                        <h3 class="text-center text-primary font-weight-bold"> แก้ไขข้อมูลผู้ดูแล </h3>
                        <div class="card-body">
                            <div class="card-body">
                                <form method="post" onsubmit="return checkBeforeSubmit()" action="../../service/admin/edit.php">
                                    <div class="form-group col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text px-2">หมายเลขผู้ดูแล</div>
                                            </div>
                                            <input type="text" class="form-control" name="admin_id" id="admin_id" value="<?php echo $result["admin_id"];?>" onkeyup="/*checkUsername()*/" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text px-2">Username</div>
                                            </div>
                                            <input type="text" class="form-control" name="username" id="username" maxlength="20" value="<?php echo $result["username"];?>" onkeyup="/*checkUsername()*/" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text px-3">ชื่อผู้ดูแล</div>
                                            </div>
                                            <input type="text" class="form-control" name="name" maxlength="30" value="<?php echo $result["name"];?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="level">ระดับผู้ดูแล</label>
                                        <select class="form-control" name="level" id="level" required>
                                            <?php if($result["level"] == "1"){ ?>
                                                <option value="1" selected>ผู้ดูแลสูงสุด (Super Admin)</option>
                                                <option value="2">ผู้ดูแลปกติ (Admin)</option>
                                            <?php }else{ ?>
                                                <option value="1">ผู้ดูแลสูงสุด (Super Admin)</option>
                                                <option value="2" selected>ผู้ดูแลปกติ (Admin)</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-warning btn-block">แก้ไข</button>
                                </form>
                            </div>
                            <a href="index.php" class="btn btn-info mt-3">&#10094;&#10094;&#10094; ย้อนกลับ</a>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>

<!-- script -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>

</body>
</html>
