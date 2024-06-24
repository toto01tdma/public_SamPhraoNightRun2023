<?php
    require_once("../../service/connect.php");

    $obj = new ConnectDatabase();
    $obj->getSessionStart();

    if(!isset($_SESSION["admin"])){
        header("location: ../../pages/homepage/");
        exit;
    }
    $statment = $obj->getConnect()->prepare("SELECT * FROM contestants WHERE c_id = :c_id");
    $statment->execute(array(":c_id" => $_GET['c_id']));
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
        .card_image_sirt{
            width:80%; 
            display:inline-block; 
            cursor:pointer;
        }
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
                        <h3 class="text-center text-primary font-weight-bold"> แก้ไขข้อมูลผู้เข้าแข่งขัน </h3>
                        <div class="card-body">
                            <form method="post" action="../../service/contest/editcontest_foradmin.php" onsubmit="return checkBeforeSubmit();">
                                <input type="hidden" name="c_id" value="<?php echo $result["c_id"];?>">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="form-row">
                                                        <div class="col-md-12 px-1 px-md-5">
                                                            <div class="form-group">
                                                                <label for="name">ชื่อ - สกุล</label>
                                                                <input type="text" class="form-control" name="name" id="name" value="<?php echo $result["name"];?>" maxlength="100" placeholder="ระบุชื่อ - สกุล" required>
                                                                <p id="alertErrorName" style="color:red;"></p>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="id_card">เลขบัตรประจำตัวประชาชน</label>
                                                                <input type="text" class="form-control" value="<?php echo base64_decode($result["id_card"]);?>" onclick="checkIdCard()" onchange="checkIdCard()" onkeyup="checkIdCard()" name="id_card" id="id_card" maxlength="13" placeholder="ระบุเลขบัตรประจำตัวประชาชน">
                                                                <input type="hidden" value="<?php echo base64_decode($result["id_card"]);?>" name="old_id_card" id="old_id_card">
                                                                <input type="hidden" id="AllowForNotErrorOfIdCard" value="true">
                                                                <p id="alertErrorId_card" style="color:red;"></p>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="birth_day">วัน/เดือน/ปีเกิด (พ.ศ)</label>
                                                                <input type="date" class="form-control" name="birth_day" id="birth_day" onclick="calAge()" onkeyup="calAge()" onchange="calAge()" value="<?php echo $result["birth_day"];?>" required>
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text px-2">อายุ</div>
                                                                        </div>
                                                                        <input type="text" class="form-control" name="age" id="age" placeholder="ระบุวันเกิด" value="<?php echo $result["age"];?>" required readonly>
                                                                        <div class="input-group-append">
                                                                            <div class="input-group-text px-2">ปี</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p id="alertErrorAge" style="color:red;"></p>
                                                                <p id="alertErrorBirth_day" style="color:red;"></p>
                                                            </div>
                                                            <!-- <div class="form-group">
                                                                <label for="gender">เพศ</label>
                                                                <select class="form-control" name="gender" id="gender" readonly>
                                                                    <option value="<?php echo $result["gender"];?>" selected><?php echo $result["gender"];?></option>
                                                                    <option value="ชาย">ชาย</option>
                                                                    <option value="หญิง">หญิง</option>
                                                                </select>
                                                                <p id="alertErrorGender" style="color:red;"></p>
                                                            </div> -->
                                                            <div class="form-group">
                                                                <label for="nationality">เพศ</label>
                                                                <input type="text" class="form-control" name="gender" id="gender"value="<?php echo $result["gender"];?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nationality">สัญชาติ</label>
                                                                <input type="text" class="form-control" name="nationality" id="nationality" placeholder="ระบุสัญชาติ" maxlength="20" value="<?php echo $result["nationality"];?>" required>
                                                                <p id="alertErrorNationality" style="color:red;"></p>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="club">ชมรม (หากไม่มี ไม่ระบุก็ได้)</label>
                                                                <input type="text" class="form-control" name="club" id="club" value="<?php echo $result["club"];?>" placeholder="ระบุชมรม" maxlength="50">
                                                                <p id="alertErrorClub" style="color:red;"></p>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="phone">เบอร์โทรศัพท์</label>
                                                                <input type="text" class="form-control" name="phone" id="phone" value="<?php echo $result["phone"];?>" placeholder="ระบุเบอร์โทรศัพท์" maxlength="10">
                                                                <p id="alertErrorPhone" style="color:red;"></p>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nationality">ไซส์เสื้อผ้า</label>
                                                                <input type="text" class="form-control" name="size" id="size" value="<?php echo $result["size"];?>" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                <div class="card-footer" style="background-color:inherit;">
                                    <button type="submit" class="btn btn-warning btn-block mx-auto w-50" name="submit" id="btn_submit">แก้ไขข้อมูลผู้เข้าแข่งขัน</button>
                                </div>
                            </form>
                            <a href="../../pages/report/contest.php" class="btn btn-info mt-3">&#10094;&#10094;&#10094; ย้อนกลับ</a>
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
    function calAge(){
        let age = 0;
        let d = new Date();
        let date_now = (d.getFullYear())+"-"+(d.getMonth()+1)+"-"+d.getDate();

        let birthDay = document.getElementById("birth_day").value;
        let y_b = "";
        let y_n = "";
        let m_b = "";
        let m_n = "";
        let d_b = "";
        let d_n = "";
        for(let i = 0; i < 4; i++){
            y_b += birthDay[i]; // ดึงค่าปีที่เกิด
            y_n += date_now[i]; // ดึงค่าปีปัจจุบัน
        }
        for(let i = 5; i < 7; i++){
            m_b += birthDay[i]; // ดึงค่าเดือนที่เกิด
            m_n += date_now[i]; // ดึงค่าเดือนปัจจุบัน
        }
        for(let i = 8; i < 10; i++){
            d_b += birthDay[i]; // ดึงค่าวันที่ที่เกิด
            d_n += date_now[i]; // ดึงค่าวันที่ปัจจุบัน
        }

        age = y_n - y_b - 1;

        // เช็คว่าเดือนปัจจุบันกับเดือนเกิดเป็นเดือนเดียวกันหรือไม่ ถ้าใช่ จะเทียบวันที่ปัจจุบันกับวันที่เกิดมาบนโลกใบนี้
        if(m_b == m_n){
            // เช็คว่าวันที่ปัจจุบันเกินกว่าหรือเท่ากับวันที่เกิดหรือไม่ ถ้าใช่จะปัดอายุขึ้นอีก 1 ปี
            if(d_n >= d_b){
                age += 1;
            }
        // เช็คว่าเดือนปัจจุบันเกินกว่าเดือนเกิดหรือไม่ ถ้าใช่จะปัดอายุขึ้นอีก 1 ปี
        }else if(m_n > m_b){
            age += 1;
        }

        document.getElementById("age").value = age;
    }

    function check_IdCard_DuplicateInformation(id_card, old_id_card){
        $.ajax({
            type: "POST",
            url: "../../service/checkForDuplicates/CheckForDuplicatesOfIdCardForEdit.php", // end point api คือส่ง api ไปยังปลายทางที่ระบุไว้
            data: { id_card : id_card,
                    old_id_card : old_id_card}
        }).done(function(resp) {
            document.getElementById("AllowForNotErrorOfIdCard").value = "true";
        }).fail(function(resp) {
            document.getElementById("AllowForNotErrorOfIdCard").value = "false";
        })

        return (document.getElementById("AllowForNotErrorOfIdCard").value == "true") ? true : false;
    }

    function checkIdCard(){
        let notError = true;
        let txtError = "";
        let id_card = document.getElementById("id_card").value;
        let old_id_card = document.getElementById("old_id_card").value;
        if(id_card != old_id_card){
            if(isNaN(id_card) && id_card != ""){
                txtError = "** กรอกเป็นตัวเลขเท่านั้น **";
                notError = false;           
            }else if(id_card.length < 13){
                txtError = "กรุณาระบุเลขบัตรประชาชนให้ครบ 13 หลัก";
                notError = false;            
            }else if(!check_IdCard_DuplicateInformation(id_card, old_id_card)){
                txtError = "** เลขบัตรประจำตัวประชาชนนี้มีผู้อื่นลงทะเบียนแล้ว **";
                notError = false;
            }else{
                txtError = "";
            }
        }
        document.getElementById("alertErrorId_card").innerHTML = txtError;
        return notError;
    }

    function checkBeforeSubmit(){
        let notError = true;
        let notIdCardError = checkIdCard();

        if((notIdCardError) === false){
            notError = false;
            Swal.fire({ 
                text: 'มีข้อมูลผิดพลาด กรุณาตรวจสอบ', 
                icon: 'warning',
                confirmButtonText: 'ตกลง', 
            })
        }
        return notError;
    }
</script>
</body>
</html>
