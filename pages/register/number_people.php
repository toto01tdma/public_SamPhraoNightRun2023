<?php
    require_once("../../service/connect.php");
    $obj = new ConnectDatabase();
    $obj->getSessionStart();
    
    if(!isset($_GET["re_type"])){ header("location: index.php"); exit; }
    if($_GET["re_type"] == "1"){ header("location: index.php"); exit; }

    $min = 2;
    $max = 100;
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
                        <h3 class="text-center text-primary font-weight-bold"> ลงทะบียนแข่งขันกีฬา <br> Night Run Sam Phrao 2023 </h3>
                        <div class="card-body">
                            <div class="card-body">
                                <form action="step2.php" methode="get">
                                    <input type="hidden" value="<?php echo $_GET["re_type"];?>" name="re_type">
                                    <div class="form-row">
                                        <div class="col-md-12 px-1 px-md-5">
                                            <div class="form-group">
                                                <label for="number_people">จำนวนผู้เข้าแข่งขันที่จะลงทะเบียน</label>
                                                <div class="form-group col-sm-12">
                                                    <div class="input-group">
                                                        <input type="number" class="form-control" onkeyup="checkNumberPeople();" name="number_people" id="number_people" min="<?php echo $min;?>" max="<?php echo $max;?>" value="<?php echo $min;?>" required>
                                                        <div class="input-group-append">
                                                            <div class="input-group-text px-2">คน</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p id="alertErrorNumberPeople" style="color:red;"></p>
                                            </div>   
                                            <div class="form-group">
                                                <button class="btn btn-primary btn-block mx-auto">ไปขั้นตอนต่อไป &#10095;&#10095;&#10095;</button>
                                            </div>
                                        </div>
                                    </div>
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
    function checkNumberPeople(){
        let n = document.getElementById("number_people").value;
        if(n > <?php echo $max;?>){
            document.getElementById("number_people").value = <?php echo $max;?>;
        }else if(n < <?php echo $min;?>){
            document.getElementById("number_people").value = <?php echo $min;?>;
        }
    }
</script>

<?php   if(isset($_SESSION["alert"])){ ?>
            <script>
                alert("<?php echo $_SESSION["alert"]?>");
            </script>
<?php       unset($_SESSION["alert"]);
        } ?>
</body>
</html>
