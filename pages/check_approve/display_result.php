<?php
    if(!isset($_POST["id_card"])){  
        header("location: index.php");  
        exit; 
    }else{
        require_once("../../service/connect.php");

        $obj = new ConnectDatabase();
        $obj->getSessionStart();

        $sql = "SELECT contestants.*, contestants_group.total, contestants_group.overdue_payment, contestants_group.cause FROM contestants INNER JOIN contestants_group WHERE id_card = :id_card";
        $statment = $obj->getConnect()->prepare($sql);
        $statment->execute(array(":id_card" => base64_encode($_POST["id_card"]))); // รันคำสั่ง Sql);
        $count = $statment->rowCount();
        if($count > 0){
            $result = $statment->fetch(PDO::FETCH_ASSOC);
            if($result["gender"] == "ชาย"){
                $g = "M";
            }else{
                $g = "F";
            }
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title> ผลการอนุมัติการแข่งขัน </title>
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
    <br>
    <br>
    <br>
    <br>
    <section class="d-flex align-items-center min-vh-100">
        <div class="container">
            <div class="row justify-content-center">
                <section class="col-lg-6">
                    <div class="card shadow p-3 p-md-4 mt-4">
                        <h3 class="text-center text-primary font-weight-bold"> สิทธิการเข้าแข่งขัน </h3>
                        <div class="card-body">
                            <?php if($count == 0){ ?>
                                        <div class="text-center">
                                            <img src="../../assets/images/eravahrvhereg.png" alt="" width="50%">
                                        </div>
                                        <div class="card-body text-center">
                                            <h4 class="font-weight-bold">ไม่พบข้อมูลผู้ใช้ในระบบ โปรดลงทะเบียนก่อนตรวจสอบ</h4>
                                        </div>                                       
                            <?php }else if($result["status_approve"] == ""){ ?>
                                        <div class="text-center">
                                            <img src="../../assets/images/glass_feoigrgg.png" alt="" width="50%">
                                        </div>
                                        <div class="card-body text-center">
                                            <h4 class="font-weight-bold">ผู้ดูแลกำลังตรวจสอบ...กรุณารอสักครู่</h4>
                                        </div>
                            <?php }else if($result["status_approve"] == "true"){ ?>
                                        <div class="text-center">
                                            <img src="../../assets/images/regregvrsvsrhrthth.png" alt="" width="50%">
                                        </div>
                                        <div class="card-body text-center">
                                            <h4 class="font-weight-bold"><?php echo $result["name"];?></h4>
                                            <h4 class="text-success font-weight-bold">ผลการอนุมัติ ผ่าน</h4>
                                        </div>
                                        <div class="card-body text-center">
                                            <h4 class="font-weight-bold">คุณได้ BIB <?php if($result["type_sirt"] != ""){ ?>และเสื้อไซส์ <?php echo $result["size"];?><?php } ?></h4>
                                            <h6>** BIB ที่เห็นในเว็บ จะเป็นเพียงภาพจำลองเท่านั้น **</h6>
                                        </div>
                                        <div class="text-center" style="border:2px solid black; border-radius:5px; position:relative;">
                                            <img src="../../assets/images/BIB_10km_.png" class="rounded" alt="..." width="100%;">
                                            <h1 style="position:absolute; top:36%; left:3%; font-size:1.5em;"><b><?php echo $result["type"];?></b></h1>
                                            <h2 style="position:absolute; top:62%; left:3%; font-size:1.5em"><b><?php echo $g." ".$result["sub_type"];?></b></h2>
                                        </div>
                                        <?php if($result["type_sirt"] != ""){ ?>
                                            <div class="text-center" style="margin-top:20px;">
                                                <img src="../../assets/images/<?php echo $result["type_sirt"];?>" class="rounded" alt="..." width="100%;">
                                            </div>
                                            <div class="card-body text-center">
                                                <h5 class="font-weight-bold">รอเข้าแข่งขันได้ในวันที่ 4 กุมภาพันธ์ 2566</h5>
                                                <h5 class="font-weight-bold">เวลา 18.00 น. ที่ อบต. สามพร้าว</h5>
                                            </div>
                                        <?php }else{ ?>
                                        <?php } ?>
                            <?php }else if($result["status_approve"] == "false"){ ?>
                                        <div class="text-center">
                                            <img src="../../assets/images/not_applewfwef.png" alt="" width="50%">
                                        </div>
                                        <div class="card-body text-center">
                                            <h4 class="text-danger font-weight-bold">ผลการอนุมัติ ไม่ผ่าน</h4>
                                        </div>
                                        <div class="card-body text-center">
                                            <h4 class="font-weight-bold">ค่าชำระทั้งหมด <?php echo $result["total"];?> บาท</h4>
                                            <h4 class="font-weight-bold">ค้างชำระ : <span style="color:red;"><?php echo $result["overdue_payment"];?></span> บาท</h4>
                                        </div>
                                        <div class="card-body text-center">
                                            <h4 class="font-weight-bold">สาเหตุ : <?php echo $result["cause"];?> </h4>
                                        </div>
                                        <?php if($result["total"] > 0){ ?>
                                            <div class="card-body text-center">
                                                <h5 class="font-weight-bold" style="color:blue;">ถ้าหากชำระเงินยังไม่ครบตามจำนวน ให้ชำระตามค่าชำระที่เหลือ แล้วทำการแนบหลักฐานการชำระเงิน</h5>
                                            </div>
                                        <?php } ?>
                                        <form action="../../service/contest/resubmit_register.php" enctype="multipart/form-data" method="post" onsubmit="return checkBeforeSubmit();">
                                            <input type="hidden" name="cg_id" value="<?php echo $result["cg_id"];?>">
                                            <?php if($result["total"] > 0){ ?>
                                                <div class="card pl-3 pr-3 pt-3">
                                                    <h4>ธนาคาร : กรุงไทย <img class="img-fluid" src="../../assets/images/logo_krungthai.png" alt="" width="10%"></h4>
                                                    <h4>ชื่อบัญชี : สามพร้าวไนท์รัน ครั้งที่ 1</h4>
                                                    <h5 onclick="copyAccountNo()" class="card px-2 py-1" style="cursor:pointer;">
                                                        <b>เลขที่บัญชี : 
                                                            <input onclick="copyAccountNo()" style="color:red; width:50%; border:0px; font-weight:bold; cursor:pointer;" id="account_no" value="2920416413" readonly>
                                                        </b>
                                                    </h5>
                                                    <p> ** คลิกที่เลขบัญชีเพื่อคัดลอกลงคลิปบอร์ดได้ **</p>
                                                    <div class="form-group text-center">
                                                        <img src="../../assets/images/QR_Payment.png" alt="Image Profile" class="img-fluid" width="300px" height="300px">
                                                        <h4 class="font-weight-bold">QR Payment</h4>
                                                    </div>
                                                    <h3 for="customFile">ค่าชำระที่เหลือ <b><span style="color:red;"> <?php echo $result["overdue_payment"];?> </span></b> บาท</h3>
                                                    <div class="custom-file">
                                                        <input type="file" value="" class="custom-file-input" id="customFile" name="slip" onchange="readFile(this)" required>
                                                        <label class="custom-file-label" for="customFile" id="statusUpload">แนบหลักฐานการชำระเงิน</label>
                                                        <input type="hidden" id="AllowForNotErrorOfTypeFile" value="false">
                                                    </div>
                                                    <p>เมื่อชำระเงินแล้วให้ทำการแนบสลิปเพื่อตรวจสอบ โดยจะแนบได้แค่สลิปใบเดียวเท่านั้น</p>
                                                    <div class="form-group text-center">
                                                        <img id="showImage" src="../../assets/images/exmaple_g.png" alt="Image Profile" class="img-fluid p-5" width="300px" height="300px">
                                                    </div>
                                                    <p id="alertErrorTypeFile" style="color:red;"></p>
                                                </div>
                                            <?php } ?>
                                            <div class="card-footer" style="background-color:inherit;">
                                                <button type="submit" class="btn btn-primary btn-block mx-auto w-50" name="submit" id="btn_submit">ยืนยันการชำระอีกรอบ</button>
                                            </div>
                                        </form>
                            <?php } ?>
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
<script>
    function checkBeforeSubmit(){
        let notError = true;
        let img = checkImageType();
        if((img) === false){
            notError = false;
            Swal.fire({ 
                text: 'มีข้อมูลผิดพลาด กรุณาตรวจสอบ', 
                icon: 'warning', 
                confirmButtonText: 'ตกลง', 
            })
        }
        return notError;
    }

    function checkImageType(){
        //-------------------------------- ตรวจสอบรูปก่อนอัพโหลด --------------------------------
            let files = $('#customFile')[0].files; //เป็นการดึงข้อมูลรูปภาพเพื่อเตรียมเช็คไฟล์ก่อนทำงานส่วน Ajax
            let aimgp = document.getElementById("alertErrorTypeFile");
            let inpimg = document.getElementById("AllowForNotErrorOfTypeFile");
    
            let fd = new FormData(); // เตรียมข้อมูล form สำหรับส่งด้วย  FormData Object
            fd.append('file',files[0]); //ใช้ในการแทรกค่าไฟล์รูปภาพใน element
        
            $.ajax({
                url:'../../service/checkForDuplicates/CheckFileSlip.php',
                type:'POST',
                data:fd, //ข้อมูลจาก input ที่ส่งเข้าไปที่ PHP
                contentType: false,
                processData: false,
            }).done(function(resp) {
                inpimg.value = 'true';
                aimgp.innerHTML = "";
            }).fail(function(resp) {
                inpimg.value = 'false';
                aimgp.innerHTML = "** ให้อัพไฟล์ที่เป็นชนิด .jpeg .jpg .png .gif และ .jfif เท่านั้น **";
            });        

            return (inpimg.value == 'true') ? true : false;
        //-------------------------------- ตรวจสอบรูปก่อนอัพโหลด --------------------------------
    }

    function readFile(input){
        if(input.files[0]){
            let reader = new FileReader();
            reader.onload = function (e) {
                let element = document.querySelector('#showImage');
                element.setAttribute("src", e.target.result);

                let element2 = document.getElementById('statusUpload');
                element2.innerHTML = "แนบหลักฐานเรียบร้อยแล้ว";
                element2.setAttribute("style", "color:green; border:1px solid green");
            }  
            reader.readAsDataURL(input.files[0]);

            let img = checkImageType();
        }   
    }

    function copyAccountNo() {
        let copyText = document.getElementById("account_no");
        copyText.select();
        copyText.setSelectionRange(0, 99999)
        document.execCommand("copy");
    }
</script>

</body>
</html>
