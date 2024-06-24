<?php
    require_once("../../service/connect.php");
    $obj = new ConnectDatabase();
    $obj->getSessionStart();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title> ลงทะเบียนเข้าแข่งขัน </title>
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
                        <h3 class="text-center text-primary font-weight-bold"> ลงทะเบียนแข่งขันกีฬา <br> Night Run Sam Phrao 2023 </h3>
                        <div class="card-body">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-md-12 px-1 px-md-5">
                                        <div class="form-group">
                                            <a href="step2.php?re_type=1" class="btn btn-dark btn-block mx-auto">ลงทะเบียนรายบุคคล</a>
                                            <a href="number_people.php?re_type=2" class="btn btn-dark btn-block mx-auto">ลงทะเบียนรายกลุ่ม</a>
                                        </div>
                                    </div>
                                </div>
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

</body>
</html>
