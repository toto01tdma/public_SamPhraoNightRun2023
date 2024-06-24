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
                        <h3 class="text-center text-primary font-weight-bold"> เพิ่มผู้ดูแล </h3>
                        <div class="card-body">
                            <div class="card-body">
                                <form method="post" onsubmit="return checkBeforeSubmit()" action="../../service/admin/create.php">
                                    <div class="form-group col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text px-2">Username</div>
                                            </div>
                                            <input type="text" class="form-control" name="username" id="username" placeholder="ระบุ username" maxlength="20" onkeyup="checkUsername()" required>
                                        </div>
                                        <input type="hidden" id="AllowForNotErrorOfUsername" value="true">
                                        <p id="alertErrorUsername" style="color:red;"></p>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text px-3">Password</div>
                                            </div>
                                            <input type="password" class="form-control" name="password" id="password1" maxlength="60" onkeyup="checkConfirmPassword()" placeholder="ระบุ password" required>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text px-3">ยืนยัน Password</div>
                                            </div>
                                            <input type="password" class="form-control" id="password2" maxlength="60" onkeyup="checkConfirmPassword()" placeholder="ยืนยัน password" required>
                                            <p id="alertErrorConfirmPassword" style="color:red;"></p>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text px-3">ชื่อผู้ดูแล</div>
                                            </div>
                                            <input type="text" class="form-control" name="name" maxlength="30" placeholder="ระบุชื่อแอดมิน" required>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">เพิ่มผู้ดูแล</button>
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
<script>
    function checkUsername(){
        let notError = true;
        let username = document.getElementById("username").value;
        let txtError = "";
        if(!checkUsernameDuplicateInformation(username)){
            notError = false;
            txtError = "** Username นี้มีผู้อื่นใช้แล้ว กรุณาใช้ Username อื่น **";
        }else{
            txtError = "";
        }
        document.getElementById("alertErrorUsername").innerHTML = txtError;
        return notError;
    }

    function checkUsernameDuplicateInformation(username){
        $.ajax({
            type: "POST",
            url: "../../service/checkForDuplicates/CheckUsername.php", // end point api คือส่ง api ไปยังปลายทางที่ระบุไว้
            data: { username : username}
        }).done(function(resp) {
            document.getElementById("AllowForNotErrorOfUsername").value = "true";
        }).fail(function(resp) {
            document.getElementById("AllowForNotErrorOfUsername").value = "false";
        })

        return (document.getElementById("AllowForNotErrorOfUsername").value == "true") ? true : false;
    }

    function checkConfirmPassword(){
        let notError = true;
        let pass1 = document.getElementById("password1").value;
        let pass2 = document.getElementById("password2").value;

        if(pass1 != pass2){
            notError = false;
            document.getElementById("alertErrorConfirmPassword").innerHTML = "** password และ ยืนยัน password จะต้องกรอกให้เหมือนกัน **";
        }else{
            document.getElementById("alertErrorConfirmPassword").innerHTML = "";
        }
        return notError;
    }

    function checkBeforeSubmit(){
        let notError = true;
        let notErrorUsername = checkUsername();
        let notErrorConfirmPassword = checkConfirmPassword();
        if((notErrorUsername && notErrorConfirmPassword) == false){
            notError = false;
            Swal.fire({ 
                text: 'มีข้อมูลผิดพลาด กรุณาตรวจสอบ', 
                icon: 'error', 
                confirmButtonText: 'ตกลง', 
            })
        }
        return notError;
    }
</script>

</body>
</html>
