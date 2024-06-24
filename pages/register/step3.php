<?php
    require_once("../../service/connect.php");
    $obj = new ConnectDatabase();
    $obj->getSessionStart();
    
    if(!($_SERVER['REQUEST_METHOD'] === "POST")){   header("location: index.php"); exit;}

    $account_no = "2920416413";
    $total = 0;
    $price_delivery = [];
    $total_delivery = 0;
    $type = [];
    $age = [];
    $sub_type = [];
    $price = [];
    $gender = [];
    $got_shirt = [];

    for($i = 0; $i < $_POST["number_people"]; $i++){
        $_POST["size".$i+1] = (isset($_POST["size".$i+1])) ? $_POST["size".$i+1] : "";

        $got_shirt[$i] = true;
        $price_delivery[$i] = ($_POST["get_delivery".($i+1)] == "Ok") ? 50 : 0;

        $age[$i] = $_POST["age".($i+1)];
        $gender[$i] = $_POST["gender".($i+1)];
        if($gender[$i] == "male"){
            $g = "M";
            $gender_th[$i] = "ชาย";
        }else{
            $g = "F";
            $gender_th[$i] = "หญิง";
        }

        if($_POST["type".($i+1)] == "_5km_"){
            $type[$i] = "5 Km.";
            if($age[$i] <= 12){
                $got_shirt[$i] = false;
                $price[$i] = 0;
                $total += $price[$i];
                $sub_type[$i] = "ไม่เกิน13ปี";
            }elseif($age[$i] >= 13){
                $price[$i] = 300;
                $total += $price[$i];
                $sub_type[$i] = "13ปีขึ้นไป";
            }
        }elseif($_POST["type".($i+1)] == "_10km_"){
            $type[$i] = "10 Km.";
            if($age[$i] <= 12){
                $got_shirt[$i] = false;
                $price[$i] = 0;
                $total += $price[$i];
                $sub_type[$i] = "ไม่เกิน13ปี";
            }elseif($age[$i] >= 13 && $age[$i] <= 19){
                $price[$i] = 500;
                $total += $price[$i];
                $sub_type[$i] = "13 - 19";
            }elseif($age[$i] >= 20 && $age[$i] <= 29){
                $price[$i] = 500;
                $total += $price[$i];
                $sub_type[$i] = "20 - 29";
            }elseif($age[$i] >= 30 && $age[$i] <= 39){
                $price[$i] = 500;
                $total += $price[$i];
                $sub_type[$i] = "30 - 39";
            }elseif($age[$i] >= 40 && $age[$i] <= 49){
                $price[$i] = 500;
                $total += $price[$i];
                $sub_type[$i] = "40 - 49";
            }elseif($age[$i] >= 50 && $age[$i] <= 59){
                $price[$i] = 500;
                $total += $price[$i];
                $sub_type[$i] = "50 - 59";
            }elseif($age[$i] >= 60){
                $price[$i] = 500;
                $total += $price[$i];
                $sub_type[$i] = "60ปีขึ้นไป";
            }
        }

        if($got_shirt[$i] == false){
            $price_delivery[$i] = 0;
        }
        $total_delivery += $price_delivery[$i];
        $total += $price_delivery[$i];
    }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>ลงทะเบียนเข้าแข่งขัน</title>
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
                            <h3 class="text-center text-primary font-weight-bold"> ลงทะเบียนแข่งขันกีฬา <br> Night Run Sam Phrao 2023 </h3>
                            <div class="card-body">
                                <form action="../../service/contest/register.php" enctype="multipart/form-data" method="post" onsubmit="return checkBeforeSubmit();">
                                    <div class="form-row">
                                        <input type="hidden" name="number_people" value="<?php echo $_POST["number_people"];?>">
                                        <div class="col-md-12 px-1 px-md-5">
                                            <?php   for($i = 1; $i <= $_POST["number_people"]; $i++){ ?>
                                                        <div onclick="document.getElementById('groupDataForShowAndHide<?php echo $i;?>').classList.toggle('d-none')" class="btn btn-dark mt-1 mb-2">
                                                            แสดง/ซ่อนข้อมูลผู้เข้าแข่งขันคนที่ <?php echo $i;?> ค่าชำระ : <?php echo $price[$i-1];?> บาท
                                                        </div>

                                                        <input type="hidden" name="price<?php echo $i;?>" value="<?php echo $price[$i-1];?>" readonly>

                                                        <div id="groupDataForShowAndHide<?php echo $i;?>" class="d-none card pl-3 pr-3 pt-3">
                                                            <div class="form-group">
                                                                <label for="name<?php echo $i;?>">ชื่อ - สกุล</label>
                                                                <input type="text" class="form-control" name="name<?php echo $i;?>" id="name<?php echo $i;?>" value="<?php echo $_POST["name".$i];?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="id_card<?php echo $i;?>">เลขบัตรประจำตัวประชาชน</label>
                                                                <input type="text" class="form-control" name="id_card<?php echo $i;?>" id="id_card<?php echo $i;?>" value="<?php echo $_POST["id_card".$i];?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="birth_day<?php echo $i;?>">วัน/เดือน/ปีเกิด</label>
                                                                <input type="text" class="form-control" name="birth_day<?php echo $i;?>" id="birth_day<?php echo $i;?>" value="<?php echo $_POST["birth_day".$i];?>" readonly>
                                                                <label for="age<?php echo $i;?>">อายุ</label>
                                                                <input type="text" class="form-control" name="age<?php echo $i;?>" id="age<?php echo $i;?>" value="<?php echo $_POST["age".$i];?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="gender<?php echo $i;?>">เพศ</label>
                                                                <input type="text" class="form-control" name="gender<?php echo $i;?>" id="gender<?php echo $i;?>" value="<?php echo $gender_th[$i-1];?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nationality<?php echo $i;?>">สัญชาติ</label>
                                                                <input type="text" class="form-control" name="nationality<?php echo $i;?>" id="nationality<?php echo $i;?>" value="<?php echo $_POST["nationality".$i];?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="club<?php echo $i;?>">ชมรม</label>
                                                                <input type="text" class="form-control" name="club<?php echo $i;?>" id="club<?php echo $i;?>" value="<?php echo $_POST["club".$i];?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="phone<?php echo $i;?>">เบอร์โทรศัพท์</label>
                                                                <input type="text" class="form-control" name="phone<?php echo $i;?>" id="phone<?php echo $i;?>" value="<?php echo $_POST["phone".$i];?>" readonly>
                                                            </div>
                                                            <?php if($got_shirt[$i-1]){ ?>
                                                                <div class="form-group">
                                                                    <label for="size<?php echo $i;?>">ไซส์เสื้อผ้า</label>
                                                                    <input type="text" class="form-control" name="size<?php echo $i;?>" id="size<?php echo $i;?>" value="<?php echo $_POST["size".$i];?>" readonly>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="type_sirt<?php echo $i;?>">แบบเสื้อ</label>
                                                                    <input type="hidden" value="<?php echo $_POST["type_sirt".$i];?>" name="type_sirt<?php echo $i;?>" id="type_sirt<?php echo $i;?>">
                                                                    <div class="text-center card" style="width:80%;">
                                                                        <img src="../../assets/images/<?php echo $_POST["type_sirt".$i];?>" alt="" width="100%">
                                                                    </div>
                                                                </div>
                                                            <?php }else{ ?>
                                                                <input type="hidden" value="" name="size<?php echo $i;?>" id="">
                                                                <input type="hidden" value="" name="type_sirt<?php echo $i;?>" id="">
                                                            <?php } ?>
                                                            <div class="form-group">
                                                                <label for="type<?php echo $i;?>">ประเภทการวิ่ง</label>
                                                                <input type="text" class="form-control" name="type<?php echo $i;?>" id="type<?php echo $i;?>" value="<?php echo $type[$i-1];?>" readonly>
                                                                <input type="text" class="form-control" name="sub_type<?php echo $i;?>" id="sub_type<?php echo $i;?>" value="<?php echo $sub_type[$i-1]?>" readonly>
                                                            </div>
                                                            <?php if($got_shirt[$i-1]){ ?>
                                                                <div class="form-group">
                                                                    <label for="get_delivery<?php echo $i;?>">การจัดส่ง</label>
                                                                    <input type="text" class="form-control" name="get_delivery<?php echo $i;?>" id="get_delivery<?php echo $i;?>" value="<?php echo $_POST["get_delivery".$i];?>" readonly>
                                                                </div>
                                                                <?php if($_POST["get_delivery".$i] == "Ok"){ ?>
                                                                    <div class="form-group">
                                                                        <label for="Address">กรอกที่อยู่</label>
                                                                        <textarea class="form-control" placeholder="" rows="3" name="contest_address<?php echo $i;?>" id="contest_address<?php echo $i;?>" maxlength="254" readonly><?php echo $_POST["contest_address".$i];?></textarea>
                                                                    </div>
                                                                <?php }else{ ?>
                                                                        <input type="hidden" name="contest_address<?php echo $i;?>" value="">
                                                                <?php } ?>
                                                            <?php }else{ ?>
                                                                <input type="hidden" name="get_delivery<?php echo $i;?>"  value="ไม่มีการจัดส่ง">
                                                                <input type="hidden" name="contest_address<?php echo $i;?>" value="">
                                                            <?php } ?>    
                                                        </div>
                                            <?php   } ?>
                                                    <div class="btn btn-dark mt-1 mb-2">
                                                        ค่าจัดส่งทั้งหมด : <?php echo $total_delivery;?> บาท
                                                    </div>
                                            <?php if($total > 0){ ?>
                                                    <div class="card pl-3 pr-3 pt-3">
                                                        <h4>ธนาคาร : กรุงไทย <img class="img-fluid" src="../../assets/images/logo_krungthai.png" alt="" width="10%"></h4>
                                                        <h4>ชื่อบัญชี : สามพร้าวไนท์รัน ครั้งที่ 1</h4>
                                                        <h5 onclick="copyAccountNo()" class="card px-2 py-1" style="cursor:pointer;">
                                                            <b>เลขที่บัญชี : 
                                                                <input onclick="copyAccountNo()" style="color:red; width:50%; border:0px; font-weight:bold; cursor:pointer;" id="account_no" value="<?php echo $account_no;?>" readonly>
                                                            </b>
                                                        </h5>
                                                        <p> ** คลิกที่เลขบัญชีเพื่อคัดลอกลงคลิปบอร์ดได้ **</p>
                                                        <div class="form-group text-center">
                                                            <img src="../../assets/images/QR_Payment.png" alt="Image Profile" class="img-fluid" width="300px" height="300px">
                                                            <h4 class="font-weight-bold">QR Payment</h4>
                                                        </div>
                                                        <h3 for="customFile">ค่าชำระทั้งหมด <b><span style="color:red;"> <?php echo $total;?> </span></b> บาท</h3>
                                                        <div class="custom-file">
                                                            <input type="file" value="" class="custom-file-input" id="customFile" name="slip" onchange="readFile(this)" required>
                                                            <label class="custom-file-label" for="customFile" id="statusUpload">แนบหลักฐานการชำระเงิน</label>
                                                            <input type="hidden" id="AllowForNotErrorOfTypeFile" value="true">
                                                        </div>
                                                        <p>เมื่อชำระเงินแล้วให้ทำการแนบสลิปเพื่อตรวจสอบ โดยจะแนบได้แค่สลิปใบเดียวเท่านั้น</p>
                                                        <div class="form-group text-center">
                                                            <img id="showImage" src="../../assets/images/exmaple_g.png" alt="Image Profile" class="img-fluid p-5" width="300px" height="300px">
                                                        </div>
                                                        <p id="alertErrorTypeFile" style="color:red;"></p>
                                                    </div>
                                            <?php } ?>
                                                    <input type="hidden" name="total" value="<?php echo $total;?>">

                                                    <div class="card-footer" style="background-color:inherit;">
                                                        <button type="submit" class="btn btn-primary btn-block mx-auto w-50" name="submit" id="btn_submit">ยืนยันการลงทะเบียน</button>
                                                    </div>
                                        </div>
                                    </div>
                                </form>
                                <form action="step2.php?number_people=<?php echo $_POST["number_people"];?>&re_type=<?php echo $_POST["re_type"];?>" method="post">
                                    <?php for($i = 1; $i <= $_POST["number_people"]; $i++){ ?>
                                            <input type="hidden" name="name<?php echo $i;?>" value="<?php echo $_POST["name".$i];?>">
                                            <input type="hidden" name="id_card<?php echo $i;?>" value="<?php echo $_POST["id_card".$i];?>">
                                            <input type="hidden" name="birth_day<?php echo $i;?>" value="<?php echo $_POST["birth_day".$i];?>">
                                            <input type="hidden" name="age<?php echo $i;?>" value="<?php echo $_POST["age".$i];?>">
                                            <input type="hidden" name="gender<?php echo $i;?>" value="<?php echo $_POST["gender".$i];?>">
                                            <input type="hidden" name="nationality<?php echo $i;?>" value="<?php echo $_POST["nationality".$i];?>">
                                            <input type="hidden" name="club<?php echo $i;?>" value="<?php echo $_POST["club".$i];?>">
                                            <input type="hidden" name="phone<?php echo $i;?>" value="<?php echo $_POST["phone".$i];?>">
                                            <input type="hidden" name="size<?php echo $i;?>" value="<?php echo $_POST["size".$i];?>">
                                            <input type="hidden" name="type_sirt<?php echo $i;?>" value="<?php echo $_POST["type_sirt".$i];?>">
                                            <input type="hidden" name="type<?php echo $i;?>" value="<?php echo $type[$i-1];?>">
                                            <input type="hidden" name="sub_type<?php echo $i;?>" value="<?php echo $sub_type[$i-1];?>">
                                            <input type="hidden" name="get_delivery<?php echo $i;?>" value="<?php echo $_POST["get_delivery".$i];?>">
                                            <input type="hidden" name="contest_address<?php echo $i;?>" value="<?php echo $_POST["contest_address".$i];?>">
                                    <?php } ?>
                                    <button type="submit" class="btn btn-info mt-3">&#10094;&#10094;&#10094; ย้อนกลับ / แก้ไขข้อมูล</button>
                                </form>
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
        function copyAccountNo() {
            let copyText = document.getElementById("account_no");
            copyText.select();
            copyText.setSelectionRange(0, 99999)
            document.execCommand("copy");
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

        function checkBeforeSubmit(){
            let img = checkImageType();

            if(img){
                return true;
            }else{
                Swal.fire({
                    text: 'มีข้อมูลผิดพลาด กรุณาตรวจสอบ',
                    icon: 'warning',
                    confirmButtonText: 'ตกลง',
                })
                return false;
            }
        }
    </script>

</body>
</html>
