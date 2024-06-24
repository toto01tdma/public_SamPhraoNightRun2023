<?php
    require_once("../../service/connect.php");
    $obj = new ConnectDatabase();
    $obj->getSessionStart();

    if(isset($_SESSION["admin"])){ 
        header("location: ../../pages/homepage/");
        exit;
    }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title> เข้าสู่ระบบ(สำหรับผู้จัดงาน) </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="image/x-icon" href="../../assets/images/obt_samphrao.png">
  <!-- stylesheet -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit"> -->
  <link rel="stylesheet" href="../../assets/css/adminlte.min.css">
  <link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
  <link rel="stylesheet" href="../../assets/css/style55.css">
  <style>
        *{font-family: tahoma;}
  </style>
</head>
<body>
    <?php require_once("../../pages/include/navbar.php"); ?>
    <section class="d-flex align-items-center min-vh-100">
        <div class="container">
            <div class="row justify-content-center">
                <section class="col-lg-6">
                    <div class="card shadow p-3 p-md-4 mt-4">
                        <h3 class="text-center text-primary font-weight-bold"> เข้าสู่ระบบ (สำหรับผู้จัดงาน) </h3>
                        <div class="card-body">
                            <div class="card-body">
                                <form id="formLogin" method="post" action="">
                                    <div class="form-group col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text px-2">ชื่อผู้ใช้งาน</div>
                                            </div>
                                            <input type="text" class="form-control" name="username" placeholder="username" required> <!-- required คือ ตรวจว่า input นี้เป็นค่าว่างมั้ย ถ้าเป็นค่าว่างจะแสดงข้อความแจ้งเตือน -->
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text px-3">รหัสผ่าน</div>
                                            </div>
                                            <input type="password" class="form-control" name="password" placeholder="password" required>
                                        </div>
                                    </div>
                                    <button type="submit" style="background-color:green; border:1px solid green;" class="btn btn-primary btn-block"> เข้าสู่ระบบ</button>
                                </form>
                            </div>
                            <a href="../../pages/homepage/" class="btn btn-info mt-3">&#10094;&#10094;&#10094; ย้อนกลับ</a>
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
<script src="../../plugins/toastr/toastr.min.js"></script>
<script>
    $(function() {
        /** Ajax Submit Login */
        $("#formLogin").submit(function(e){ 
            e.preventDefault()
            $.ajax({
                type: "POST",
                url: "../../service/auth/login.php", 
                data: $(this).serialize()
            }).done(function(resp) {
                window.toastr.remove();
                toastr.success('เข้าสู่ระบบเรียบร้อย');
                setTimeout(() => {
                location.href = '../homepage/';
                }, 800)
            }).fail(function(resp) {
                window.toastr.remove();
                toastr.error('Username หรือ Password ไม่ถูกต้อง');
                // หากอยากเล่นการแจ้งเตือน toastr ให้ไปที่ลิ้ง https://codeseven.github.io/toastr/demo.html
            })
        })
    })
</script>
</body>
</html>
