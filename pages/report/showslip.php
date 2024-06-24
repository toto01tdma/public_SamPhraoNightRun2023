<?php
    require_once("../../service/connect.php");
    $obj = new ConnectDatabase();
    $obj->getSessionStart();

    if(!isset($_SESSION["admin"])){ 
        header("location: ../../pages/homepage/");
        exit;
    }

    $statment_forcheck = $obj->getConnect()->prepare("SELECT cg_id FROM slips WHERE cg_id = :cg_id");
    $statment_forcheck->execute(array(":cg_id" => $_GET['cg_id']));
    $result_forcheck = $statment_forcheck->fetch(PDO::FETCH_ASSOC);

    if($result_forcheck == false){
        header("location: contest.php");
        exit;
    }

    $statment = $obj->getConnect()->prepare("SELECT * FROM slips WHERE cg_id = :cg_id ORDER BY upload_date ASC");
    $statment->execute(array(":cg_id" => $_GET['cg_id']));

    
    if($_GET["re_to"] == "approve"){
        $re_to = "approve.php";
    }else{
        $re_to = "contest.php";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/x-icon" href="../../assets/images/obt_samphrao.png">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>ดูหลักฐานการชำระเงินของหมายเลขกลุ่ม <?php echo $_GET['cg_id'];?></title>
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
                <a href="<?php echo $re_to;?>" class="btn btn-info mt-3 shadow">&#10094;&#10094;&#10094; ย้อนกลับ</a>
                <div class="card shadow p-3 p-md-4 mt-4">
                    <h3 class="font-weight-bold">หลักฐานการชำระเงินทั้งหมดของหมายเลขกลุ่ม <?php echo $_GET['cg_id'];?></h3>
                    <div class="row">
                    <?php while($result = $statment->fetch(PDO::FETCH_ASSOC)){ ?>
                        <div class="col-sm-3">
                            <div class="card" style="width: 16rem;">
                                <a href="#" onclick="activeShowSlipContest('<?php echo $result['slip_name'];?>');" data-toggle="modal" data-target="#showSlipContest">
                                    <img class="card-img-top" src="../../assets/slips/<?php echo $result["slip_name"];?>" class="rounded" width="100%" alt="Card image cap">
                                    <div class="card-body">
                                        <p class="card-text font-weight-bold">อัพเมื่อ : <?php echo $result["upload_date"];?></p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <div class="modal fade" id="showSlipContest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">รูปหลักฐานการชำระเงิน</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <img src="" id="imgSlipContest" class="rounded" alt="..." width="100%;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิดหน้านี้</button>
                </div>
            </div>
        </div>
    </div>

<!-- scripts -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
<script>
    function activeShowSlipContest(srt){
        document.getElementById("imgSlipContest").setAttribute("src", "../../assets/slips/"+srt)
    }
</script>

</body>
</html>
