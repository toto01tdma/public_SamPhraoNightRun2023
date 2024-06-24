<?php
    require_once("../../service/connect.php");
    $obj = new ConnectDatabase();
    $obj->getSessionStart();

    if(!isset($_SESSION["admin"])){ 
        header("location: ../../pages/homepage/");
        exit;
    }

    if(isset($_GET["condition"])){

    }else{

    }

    $statment = $obj->getConnect()->prepare("SELECT * FROM contestants_group WHERE status_approve = '' OR status_approve IS NULL ORDER BY date_register ASC");
    $statment->execute();
    $count = $statment->rowCount();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/x-icon" href="../../assets/images/obt_samphrao.png">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>รายชื่อผู้ลงทะเบียนเข้าแข่งขัน</title>
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
                <a href="contest.php" class="btn btn-dark mt-3 shadow">ดูรายชื่อผู้เข้าแข่งขันแบบรายบุคคล</a>
                <div class="card shadow p-3 p-md-4 mt-4" style="overflow-x:auto;">
                    <h3 class="font-weight-bold">รายชื่อผู้ลงทะเบียนเข้าแข่งขันที่<span style="color:blue;">รออนุมัติ</span> (รายกลุ่ม) จำนวน <span style="color:blue;"><?php echo $count;?></span> กลุ่ม</h3>
                    <table class="table" id="list_team" style="border-collapse: collapse; border-spacing: 0; width: 100%; border: 1px solid #ddd;">
                        <thead>
                            <tr>
                                <th scope="col">การอนุมัติ</th>
                                <th scope="col">วันที่ชำระเงิน</th>
                                <th scope="col">ค่าชำระทั้งหมด</th>
                                <th scope="col">ค้างชำระ</th>
                                <th scope="col">ดูรายละเอียดผู้เข้าแข่งขัน</th>
                                <th scope="col">หลักฐานการชำระเงิน (สลิปล่าสุด)</th>
                                <th scope="col">หลักฐานการชำระเงินทั้งหมด</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                    while($result = $statment->fetch(PDO::FETCH_ASSOC)){
                                        $statment_for_get_slip = $obj->getConnect()->prepare("SELECT * FROM slips WHERE cg_id = '".$result["cg_id"]."' ORDER BY upload_date DESC");
                                        $statment_for_get_slip->execute();
                                        $slip = $statment_for_get_slip->fetch(PDO::FETCH_ASSOC); ?>
                                        <tr>
                                            <?php if($result["status_approve"] == ""){ ?>
                                                    <td scope="col"> 
                                                        <div onclick="approve('<?php echo $result['cg_id'];?>');" class="btn btn-success">อนุมัติให้ผ่าน</div>
                                                        <div onclick="getDataToFormModal('<?php echo $result['cg_id'];?>', '<?php echo $result['overdue_payment'];?>', '<?php echo $result['total'];?>');" data-toggle="modal" data-target="#formCancelApprove" class="btn btn-danger mt-2">ไม่อนุมัติให้ผ่าน</div>
                                                    </td>
                                            <?php }else if($result["status_approve"] == "true"){ ?>
                                                    <td scope="col" style="color:green;"> <h2 class="font-weight-bold">อนุมัติผ่านแล้ว</h2> </td>
                                            <?php }else if($result["status_approve"] == "false"){ ?>
                                                    <td scope="col" style="color:red;"> <h2 class="font-weight-bold">อนุมัติไม่ผ่าน</h2> </td>
                                            <?php } ?>
                                            <td scope="col" class="font-weight-bold" style="font-size:1.5rem;"> <?php echo $result["date_register"];?> </td>
                                            <td scope="col" style="font-size:1.5rem;"> <?php echo $result["total"];?> </td>
                                            <?php if($result["overdue_payment"] > 0){ ?>
                                                    <td scope="col" style="font-size:1.5rem; color:red;"> <?php echo $result["overdue_payment"];?> </td>
                                            <?php }else{ ?>
                                                    <td scope="col" style="font-size:1.5rem;"> <?php echo $result["overdue_payment"];?> </td>
                                            <?php } ?>
                                            <td scope="col"> <a href="contest.php?cg_id=<?php echo $result["cg_id"];?>" class="btn btn-dark">ดูรายชื่อผู้เข้าแข่งขันของกลุ่มนี้</a> </td>
                                            <td scope="col" class="text-center p-2">
                                                <?php if($result["total"] > 0){ ?>
                                                    <a href="#" onclick="activeShowSlipContest('<?php echo $slip['slip_name'];?>');" data-toggle="modal" data-target="#showSlipContest">
                                                        <img src="../../assets/slips/<?php echo $slip["slip_name"];?>" class="rounded" width="100%" alt="หลักฐานการชำระ">
                                                    </a>
                                                <?php }else{ ?>
                                                        ถ้าการชำระทั้งหมดเป็น 0 บาท จะไม่มีการแนบหลักฐานการชำระเงิน
                                                <?php } ?>
                                            </td>
                                            <td scope="col"> <a href="showslip.php?cg_id=<?php echo $result["cg_id"];?>&re_to=approve" class="btn btn-info">ดูหลักฐานการชำระเงินทั้งหมด</a> </td>
                                        </tr>
                            <?php   } ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>

    <div class="modal fade" id="showSlipContest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">รูปหลักฐานการชำระเงิน (ที่อัพล่าสุด)</h5>
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

    <div class="modal fade" id="formCancelApprove" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">ระบุเหตุผลที่ไม่อนุมัติ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="modal-body" style="height:30rem;">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text px-2">รหัสกลุ่มผู้เข้าแข่งขัน : </div>
                            </div>
                            <input type="text" class="form-control" name="cg_id" id="cg_id" value="" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">ระบุเหตุผล</span>
                            </div>
                            <textarea class="form-control" aria-label="With textarea" name="cause" id="cause" maxlength="254" required></textarea>
                        </div>
                        <p id="alertErrorCause" style="color:red;"></p>
                    </div>
                    <p> ถ้าหากผู้เข้าแข่งขันชำระเงิน<span class="font-weight-bold" style="color:red;">ยังไม่ครบตามจำนวน</span> ให้ระบุจำนวนเงินที่ชำระแล้ว เพื่อแจ้งค่าชำระที่เหลือไปยังผู้เข้าแข่งขัน <span class="font-weight-bold" style="color:blue;">เช่น มีค่าชำระ 300 บาท ถ้าผู้เข้าแข่งขันชำระไปแล้ว 200 บาท ให้ระบุ 200</span></p>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text px-2">ค่าชำระทั้งหมด</div>
                            </div>
                            <input type="text" class="form-control font-weight-bold" id="total" value="" readonly>
                            <div class="input-group-append">
                                <div class="input-group-text px-2">บาท</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text px-2">ค่าชำระที่ผู้เข้าแข่งขันชำระแล้ว (แก้ไขได้)</div>
                            </div>
                            <input type="text" class="form-control font-weight-bold" id="paid" onkeyup="checkNumberPaidAndCal();" onclick="checkNumberPaidAndCal();" onchange="checkNumberPaidAndCal();" value="0" require>
                            <div class="input-group-append">
                                <div class="input-group-text px-2">บาท</div>
                            </div>
                        </div>
                        <p id="alertErrorPaid" style="color:red;"></p>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text px-2">ค้างค่าชำระ</div>
                            </div>
                            <input type="text" style="color:red;" class="form-control font-weight-bold" name="overdue_payment" id="overdue_payment" placeholder="ระบุจำนวนเงินที่ค้างค่าชำระ" maxlength="10" value="" readonly>
                            <div class="input-group-append">
                                <div class="input-group-text px-2">บาท</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" onclick="cancelApprove();">ยืนยันไม่อนุมัติ</button>
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

    function approve(cg_id){
        Swal.fire({
            text: "ถ้าหากผู้เข้าแข่งขันกลุ่มนี้ ได้ชำระเงินครบตามจำนวนแล้ว สามารถกดยืนยันได้",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({  
                    type: "POST",  
                    url: "../../service/contest/approve.php",  
                    data: { cg_id: cg_id }
                }).done(function() {
                    Swal.fire({
                        text: 'อนุมัติผู้เข้าแข่งขันเรียบร้อย',
                        icon: 'success',
                        confirmButtonText: 'ตกลง',
                    }).then((result) => {
                        location.reload();
                    });
                })
            }
        })
    }

    function cancelApprove(){
        let cg_id = document.getElementById("cg_id").value;
        let cause = document.getElementById("cause").value;
        let op = document.getElementById("overdue_payment").value;

        let notErrorNumberPaid = checkNumberPaidAndCal();

        let notErrorCause = true;
        if(cause == ""){
            notErrorCause = false;
            document.getElementById("alertErrorCause").innerHTML = "** ระบุเหตุผล **";
        }

        if(notErrorNumberPaid && notErrorCause) {
            $.ajax({  
                type: "POST",  
                url: "../../service/contest/cancel_approve.php",
                data: { cg_id: cg_id,
                        cause: cause,
                        op: op }
            }).done(function() {
                Swal.fire({
                    text: 'แจ้งผลอนุมัติผู้เข้าแข่งขันเรียบร้อย',
                    icon: 'success',
                    confirmButtonText: 'ตกลง',
                }).then((result) => {
                    location.reload();
                });
            })
        }
    }

    function getDataToFormModal(cg_id, op, total){
        document.getElementById("cg_id").value = cg_id;
        document.getElementById("overdue_payment").value = op;
        document.getElementById("total").value = total;
    }

    function checkNumberPaidAndCal(){
        let notError = true;
        let txtError = "";
        let total = document.getElementById("total").value;
        let val = document.getElementById("paid").value;
        if(isNaN(val) && val != ""){
            txtError = "** กรอกเป็นตัวเลขเท่านั้น **";
            notError = false;           
        }else{
            let op = total - val;
            document.getElementById("overdue_payment").value = op;
        }
        document.getElementById("alertErrorPaid").innerHTML = txtError;
        return notError;
    }
</script>

</body>
</html>
