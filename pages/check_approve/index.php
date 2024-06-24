<?php
    require_once("../../service/connect.php");
    $obj = new ConnectDatabase();
    $obj->getSessionStart();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title> ตรวจสอบสิทธิการเข้าแข่งขัน </title>
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
    <section class="d-flex align-items-center min-vh-100">
        <div class="container">
            <div class="row justify-content-center">
                <section class="col-lg-6">
                    <div class="card shadow p-3 p-md-4 mt-4">
                        <h3 class="text-center text-primary font-weight-bold"> ตรวจสอบสิทธิการเข้าแข่งขัน </h3>
                        <div class="card-body">
                            <div class="card-body">
                                <form action="display_result.php" method="post" onsubmit="return checkBeforeSubmit()">
                                    <div class="form-group col-sm-12">
                                        <label for="id_card">เลขบัตรประจำตัวประชาชน</label>
                                        <input type="text" class="form-control" name="id_card" id="id_card" value="" onkeyup="checkIdCard();" placeholder="ระบุเพื่อตรวจสอบ" maxlength="13" required> <!-- required คือ ตรวจว่า input นี้เป็นค่าว่างมั้ย ถ้าเป็นค่าว่างจะแสดงข้อความแจ้งเตือน -->
                                        <p id="alertErrorId_card" style="color:red;"></p>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">ตรวจสอบ</button>
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
    function checkIdCard(){
        let notError = true;
        let txtError = "";
        let id_card = document.getElementById("id_card").value;
        if(isNaN(id_card) && id_card != ""){
            txtError = "** กรอกเป็นตัวเลขเท่านั้น **";
            notError = false;           
        }else if(id_card.length < 13){
            txtError = "กรุณาระบุเลขบัตรประชาชนให้ครบ 13 หลัก";
            notError = false;            
        }else{
            txtError = "";
        }
        document.getElementById("alertErrorId_card").innerHTML = txtError;
        return notError;
    }

    function checkBeforeSubmit(){
        let notIdCardError = checkIdCard();
        if((notIdCardError) === false){
            notError = false;
            Swal.fire({ 
                text: 'มีข้อมูลผิดพลาด กรุณาตรวจสอบ', 
                icon: 'error', 
                confirmButtonText: 'ตกลง', 
            })
        }
        return notIdCardError;
    }
</script>

</body>
</html>
