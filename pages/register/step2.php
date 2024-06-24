<?php
require_once ("../../service/connect.php");
$obj = new ConnectDatabase();
$obj->getSessionStart();

if (!isset($_GET["re_type"])) {
    header("location: index.php");
    exit;
}

$people = (isset($_GET["number_people"])) ? $_GET["number_people"] : 1;

for ($i = 1; $i <= $people; $i++) {
    $name[$i] = (isset($_POST["name" . $i])) ? $_POST["name" . $i] : "";
    $id_card[$i] = (isset($_POST["id_card" . $i])) ? $_POST["id_card" . $i] : "";
    $birth_day[$i] = (isset($_POST["birth_day" . $i])) ? $_POST["birth_day" . $i] : "";
    $age[$i] = (isset($_POST["age" . $i])) ? $_POST["age" . $i] : "";
    $gender[$i] = (isset($_POST["gender" . $i])) ? $_POST["gender" . $i] : "";
    if (isset($_POST["gender" . $i])) {
        if ($_POST["gender" . $i] == "male") {
            $gender_th[$i] = "ชาย";
        } else {
            $gender_th[$i] = "หญิง";
        }
    } else {
        $gender_th[$i] = "";
    }
    $nationality[$i] = (isset($_POST["nationality" . $i])) ? $_POST["nationality" . $i] : "";
    $club[$i] = (isset($_POST["club" . $i])) ? $_POST["club" . $i] : "";
    $phone[$i] = (isset($_POST["phone" . $i])) ? $_POST["phone" . $i] : "";
    $size[$i] = (isset($_POST["size" . $i])) ? $_POST["size" . $i] : "";
    $type_sirt[$i] = (isset($_POST["type_sirt" . $i])) ? $_POST["type_sirt" . $i] : "";
    $type[$i] = (isset($_POST["type" . $i])) ? $_POST["type" . $i] : "";
    $sub_type[$i] = (isset($_POST["sub_type" . $i])) ? $_POST["sub_type" . $i] : "";
    if (isset($_POST["get_delivery" . $i])) {
        $delivery[$i] = ($_POST["get_delivery" . $i] == "Ok") ? true : false;
        $value_delivery[$i] = "Ok";
    } else {
        $delivery[$i] = false;
        $value_delivery[$i] = "No";
    }
    $address[$i] = (isset($_POST["contest_address" . $i])) ? $_POST["contest_address" . $i] : "";
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
        * {
            font-family: tahoma;
        }

        .card_image_sirt {
            width: 80%;
            display: inline-block;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <?php require_once ("../../pages/include/navbar.php"); ?>
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
                        <h3 class="text-center text-primary font-weight-bold"> ลงทะเบียนแข่งขันกีฬา <br> Night Run Sam
                            Phrao 2023 </h3>
                        <div class="card-body">
                            <form enctype="multipart/form-data" method="post" onsubmit="return checkBeforeSubmit()"
                                action="step3.php">
                                <input type="hidden" name="re_type" value="<?php echo $_GET["re_type"]; ?>">
                                <input type="hidden" name="number_people" value="<?php echo $people; ?>">
                                <?php for ($i = 1; $i <= $people; $i++) { ?>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-row">
                                                <div class="col-md-12 px-1 px-md-5">
                                                    <h3> กรอกข้อมูลผู้เข้าแข่งขันคนที่ <?php echo $i; ?></h3>
                                                    <div class="form-group">
                                                        <label for="name<?php echo $i; ?>">ชื่อ - สกุล</label>
                                                        <input type="text" class="form-control" name="name<?php echo $i; ?>"
                                                            id="name<?php echo $i; ?>" value="<?php echo $name[$i]; ?>"
                                                            maxlength="100" placeholder="ระบุชื่อ - สกุล" required>
                                                        <p id="alertErrorName<?php echo $i; ?>" style="color:red;"></p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="id_card<?php echo $i; ?>">เลขบัตรประจำตัวประชาชน</label>
                                                        <input type="text" class="form-control"
                                                            value="<?php echo $id_card[$i]; ?>"
                                                            name="id_card<?php echo $i; ?>" id="id_card<?php echo $i; ?>"
                                                            onclick="checkIdCard('<?php echo $i; ?>')"
                                                            onchange="checkIdCard('<?php echo $i; ?>')"
                                                            onkeyup="checkIdCard('<?php echo $i; ?>')" maxlength="13"
                                                            placeholder="ระบุเลขบัตรประจำตัวประชาชน" required>
                                                        <input type="hidden" id="AllowForNotErrorOfIdCard" value="true">
                                                        <p id="alertErrorId_card<?php echo $i; ?>" style="color:red;"></p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="birth_day<?php echo $i; ?>">ระบุ
                                                            วันที่/เดือน/ปีเกิด</label>
                                                        <input type="date" class="form-control"
                                                            name="birth_day<?php echo $i; ?>" id="birth_day<?php echo $i; ?>"
                                                            onclick="calAge('<?php echo $i; ?>'); activeTypeSirt('<?php echo $i; ?>');"
                                                            onkeyup="calAge('<?php echo $i; ?>'); activeTypeSirt('<?php echo $i; ?>');"
                                                            onchange="calAge('<?php echo $i; ?>'); activeTypeSirt('<?php echo $i; ?>');"
                                                            value="<?php echo $birth_day[$i]; ?>" required>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text px-2">อายุ</div>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    name="age<?php echo $i; ?>" id="age<?php echo $i; ?>"
                                                                    placeholder="ระบุวันเกิด" value="<?php echo $age[$i]; ?>"
                                                                    required readonly>
                                                                <div class="input-group-append">
                                                                    <div class="input-group-text px-2">ปี</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="gender<?php echo $i; ?>">เพศ</label>
                                                        <select class="form-control" name="gender<?php echo $i; ?>"
                                                            id="gender<?php echo $i; ?>"
                                                            onchange="activeTypeSirt('<?php echo $i; ?>');" required>
                                                            <?php if (isset($_POST["gender" . $i])) { ?>
                                                                <option value="<?php echo $gender[$i]; ?>" selected>
                                                                    <?php echo $gender_th[$i]; ?></option>
                                                            <?php } else { ?>
                                                                <option value disabled selected>-- เลือกเพศ --</option>
                                                            <?php } ?>
                                                            <option value="male">ชาย</option>
                                                            <option value="female">หญิง</option>
                                                        </select>
                                                        <p id="alertErrorGender" style="color:red;"></p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nationality<?php echo $i; ?>">สัญชาติ</label>
                                                        <input type="text" class="form-control"
                                                            name="nationality<?php echo $i; ?>"
                                                            id="nationality<?php echo $i; ?>" placeholder="ระบุสัญชาติ"
                                                            maxlength="20" value="<?php echo $nationality[$i]; ?>" required>
                                                        <p id="alertErrorNationality<?php echo $i; ?>" style="color:red;">
                                                        </p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="club<?php echo $i; ?>">ชมรม (หากไม่มี
                                                            ไม่ระบุก็ได้)</label>
                                                        <input type="text" class="form-control" name="club<?php echo $i; ?>"
                                                            id="club<?php echo $i; ?>" value="<?php echo $club[$i]; ?>"
                                                            placeholder="ระบุชมรม" maxlength="50">
                                                        <p id="alertErrorClub<?php echo $i; ?>" style="color:red;"></p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="phone<?php echo $i; ?>">เบอร์โทรศัพท์</label>
                                                        <input type="text" class="form-control" name="phone<?php echo $i; ?>"
                                                            id="phone<?php echo $i; ?>" value="<?php echo $phone[$i]; ?>"
                                                            placeholder="ระบุเบอร์โทรศัพท์" maxlength="10">
                                                        <p id="alertErrorPhone<?php echo $i; ?>" style="color:red;"></p>
                                                    </div>
                                                    <div class="form-group" id="showOptionSize<?php echo $i; ?>">
                                                        <label for="size<?php echo $i; ?>">เลือกไซส์เสื้อผ้า</label>
                                                        <select class="form-control" name="size<?php echo $i; ?>"
                                                            id="size<?php echo $i; ?>" required>
                                                            <?php if (isset($_POST["gender" . $i])) { ?>
                                                                <option value="<?php echo $size[$i]; ?>" selected>
                                                                    <?php echo $size[$i]; ?></option>
                                                            <?php } else { ?>
                                                                <option value disabled selected>-- เลือกไซส์เสื้อผ้า --</option>
                                                            <?php } ?>
                                                            <option value="SSS">SSS (รอบ อก 34 x ยาว 25)</option>
                                                            <option value="SS">SS (รอบ อก 36 x ยาว 26)</option>
                                                            <option value="S">S (รอบ อก 38 x ยาว 27)</option>
                                                            <option value="M">M (รอบ อก 40 x ยาว 28)</option>
                                                            <option value="L">L (รอบ อก 42 x ยาว 29)</option>
                                                            <option value="XL">XL (รอบ อก 44 x ยาว 30)</option>
                                                            <option value="2XL">2XL (รอบ อก 46 x ยาว 31)</option>
                                                            <option value="3XL">3XL (รอบ อก 48 x ยาว 31)</option>
                                                            <option value="4XL">4XL (รอบ อก 50 x ยาว 32)</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="type<?php echo $i; ?>">ประเภทการวิ่ง</label>
                                                        <select class="form-control" name="type<?php echo $i; ?>"
                                                            id="type<?php echo $i; ?>"
                                                            onchange="activeTypeSirt('<?php echo $i; ?>');" required>
                                                            <option value disabled selected>-- เลือกประเภทการวิ่ง --
                                                            </option>
                                                            <option value="_5km_">วิ่ง Fun Run ระยะทาง 5 Km. (ชาย/หญิง)
                                                            </option>
                                                            <option value="_10km_">วิ่ง Mini Marathon ระยะทาง 10 Km.
                                                                (ชาย/หญิง)</option>
                                                        </select>
                                                        <p id="alertErrorType" style="color:red;"></p>
                                                    </div>
                                                    <div class="text-center" id="showSirt<?php echo $i; ?>"
                                                        style="display:none;">
                                                        <h4 class="text-primary font-weight-bold">รูปแบบเสื้อ</h4>
                                                        <div class="text-center card card_image_sirt"
                                                            id="show_shirt<?php echo $i; ?>"
                                                            onclick="activeTypeSirt('<?php echo $i; ?>');">
                                                            <img src="" alt="" width="100%"
                                                                id="showImgSirt<?php echo $i; ?>">
                                                        </div>
                                                    </div>
                                                    <input class="form-control" type="text" value=""
                                                        placeholder="เลือกแบบเสื้อผ้า" name="type_sirt<?php echo $i; ?>"
                                                        id="type_sirt<?php echo $i; ?>" readonly>
                                                    <p id="alertErrorTypeSirt<?php echo $i; ?>" style="color:red;"></p>
                                                    <div class="form-check">
                                                        <input class="form-group" type="checkbox"
                                                            id="delivery<?php echo $i; ?>" value="delivery"
                                                            onclick="getDelivery('<?php echo $i; ?>');">
                                                        <input type="hidden" id="get_delivery<?php echo $i; ?>"
                                                            name="get_delivery<?php echo $i; ?>"
                                                            value="<?php echo $value_delivery[$i]; ?>">
                                                        <span>
                                                            จะทำการจัดส่งเสื้อและ BIB ถึงที่หรือไม่ โดยจะคิดค่าบริการจัดส่ง
                                                            <span style="color:red; font-weight:bold;">50 บาท <br>**
                                                                ถ้าเด็กอายุ 13 ปี จะไม่มีผลกับการติ๊กครั้งนี้ **</span>
                                                        </span>
                                                    </div>
                                                    <div class="form-group" id="showInputAddress<?php echo $i; ?>"
                                                        style="display:none;">
                                                        <label for="Address">กรอกที่อยู่ (กรอกที่อยู่ให้ชัดเจน)</label>
                                                        <textarea class="form-control"
                                                            placeholder="กรอกที่อยู่เช่น บ้านเลขที่ หมู่ ซอย ถนน ตำบล อำเภอ จังหวัด เลขไปรษณีย์"
                                                            rows="3" name="contest_address<?php echo $i; ?>"
                                                            id="contest_address<?php echo $i; ?>"
                                                            maxlength="254"><?php echo $address[$i]; ?></textarea>
                                                        <p id="alertErrorAddress" style="color:red;"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="form-check">
                                    <input class="form-group" type="checkbox" id="confirm" name="confirm"
                                        onclick="checkConfirm()" value="confirm">
                                    <span>
                                        ข้าพเจ้ารับรองว่าข้อความข้างต้นเป็นความจริง
                                        และข้าพเจ้ามีสุขภาพสมบูรณ์พร้อมที่จะเข้าแข่งขันในประเภทที่สมัคร
                                        และจะไม่เรียกร้องค่าเสียหายใดๆ
                                        หากเกิดอันตรายหรือบาดเจ็บทั้งก่อนและหลังขณะแข่งขัน
                                    </span>
                                    <br>
                                    <span id="alertErrorConfirm" style="color:red;"></span>
                                </div>
                                <div class="card-footer" style="background-color:inherit;">
                                    <button type="submit" class="btn btn-primary btn-block mx-auto w-50" name="submit"
                                        id="btn_submit">ไปขั้นตอนต่อไป &#10095;&#10095;&#10095;</button>
                                </div>
                            </form>
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
        function checkIdCard(row) {
            let notError = true;
            let txtError = "";
            let id_card = document.getElementById("id_card" + row).value;
            if (isNaN(id_card) && id_card != "") {
                txtError = "** กรอกเป็นตัวเลขเท่านั้น **";
                notError = false;
            } else if (id_card.length < 13) {
                txtError = "กรุณาระบุเลขบัตรประชาชนให้ครบ 13 หลัก";
                notError = false;
            } else if (!check_IdCard_DuplicateInformation(id_card)) {
                txtError = "** เลขบัตรประจำตัวประชาชนนี้มีผู้อื่นลงทะเบียนแล้ว **";
                notError = false;
            } else {
                txtError = "";
            }
            document.getElementById("alertErrorId_card" + row).innerHTML = txtError;
            return notError;
        }

        function checkConfirm() {
            let notErrorConfirm = true;
            if (document.getElementById("confirm").checked == true) {
                document.getElementById("alertErrorConfirm").innerHTML = "";
            } else {
                document.getElementById("alertErrorConfirm").innerHTML = "** ติ๊กเพื่อยอมรับข้อตกลงก่อนลงทะเบียนแข่งขัน **";
                notErrorConfirm = false;
            }
            return notErrorConfirm;
        }

        function checkBeforeSubmit() {
            let notError = true;
            let notIdCardError = true;
            let notTypeSirtError = true;
            for (let i = 1; i <= <?php echo $people; ?>; i++) {
                notIdCardError = checkIdCard(i);
                if (notIdCardError === false) {
                    break;
                }
            }

            let notErrorConfirm = true;
            notErrorConfirm = checkConfirm();

            for (let i = 1; i <= <?php echo $people; ?>; i++) {
                let val = document.getElementById("type_sirt" + i).value;
                if (val == "") {
                    document.getElementById("alertErrorTypeSirt" + i).innerHTML = "** เลือกแบบเสื้อผ้า **";
                    notTypeSirtError = false;
                }
            }

            if ((notIdCardError && notErrorConfirm && notTypeSirtError) === false) {
                notError = false;
                Swal.fire({
                    text: 'มีข้อมูลผิดพลาด กรุณาตรวจสอบ',
                    icon: 'warning',
                    confirmButtonText: 'ตกลง',
                })
            }
            return notError;
        }

        function getDateInForm() {
            let d = new Date();
            let date = (d.getFullYear()) + "-" + (d.getMonth() + 1) + "-" + d.getDate();
            for (let i = 1; i <= <?php echo $people; ?>; i++) {
                document.getElementById("birth_day" + i).value = date;
            }
        }
        <?php if (!isset($_POST["birth_day" . "1"])) { ?>
            getDateInForm();
        <?php } ?>

        function check_IdCard_DuplicateInformation(id_card) {
            $.ajax({
                type: "POST",
                url: "../../service/checkForDuplicates/CheckForDuplicatesOfIdCard.php", // end point api คือส่ง api ไปยังปลายทางที่ระบุไว้
                data: { id_card: id_card }
            }).done(function (resp) {
                document.getElementById("AllowForNotErrorOfIdCard").value = "true";
            }).fail(function (resp) {
                document.getElementById("AllowForNotErrorOfIdCard").value = "false";
            })

            return (document.getElementById("AllowForNotErrorOfIdCard").value == "true") ? true : false;
        }

        function calAge(row) {
            let age = 0;
            let d = new Date();
            let date_now = (d.getFullYear()) + "-" + (d.getMonth() + 1) + "-" + d.getDate();

            let birthDay = document.getElementById("birth_day" + row).value;
            let y_b = "";
            let y_n = "";
            let m_b = "";
            let m_n = "";
            let d_b = "";
            let d_n = "";
            for (let i = 0; i < 4; i++) {
                y_b += birthDay[i]; // ดึงค่าปีที่เกิด
                y_n += date_now[i]; // ดึงค่าปีปัจจุบัน
            }
            for (let i = 5; i < 7; i++) {
                m_b += birthDay[i]; // ดึงค่าเดือนที่เกิด
                m_n += date_now[i]; // ดึงค่าเดือนปัจจุบัน
            }
            for (let i = 8; i < 10; i++) {
                d_b += birthDay[i]; // ดึงค่าวันที่ที่เกิด
                d_n += date_now[i]; // ดึงค่าวันที่ปัจจุบัน
            }

            age = y_n - y_b - 1;

            // เช็คว่าเดือนปัจจุบันกับเดือนเกิดเป็นเดือนเดียวกันหรือไม่ ถ้าใช่ จะเทียบวันที่ปัจจุบันกับวันที่เกิดมาบนโลกใบนี้
            if (m_b == m_n) {
                // เช็คว่าวันที่ปัจจุบันเกินกว่าหรือเท่ากับวันที่เกิดหรือไม่ ถ้าใช่จะปัดอายุขึ้นอีก 1 ปี
                if (d_n >= d_b) {
                    age += 1;
                }
                // เช็คว่าเดือนปัจจุบันเกินกว่าเดือนเกิดหรือไม่ ถ้าใช่จะปัดอายุขึ้นอีก 1 ปี
            } else if (m_n > m_b) {
                age += 1;
            }

            document.getElementById("age" + row).value = age;
        }

        function activeTypeSirt(row) {
            let gender = document.getElementById("gender" + row).value;
            let type = document.getElementById("type" + row).value;
            let age = document.getElementById("age" + row).value;
            if (age >= 13) {
                document.getElementById("showOptionSize" + row).setAttribute("style", "");
                document.getElementById("size" + row).removeAttribute("disabled");
                if (gender == "male") {
                    if (type == "_5km_") {
                        document.getElementById("showSirt" + row).setAttribute("style", "");
                        document.getElementById("showImgSirt" + row).setAttribute("src", "../../assets/images/5Knohand_.png");
                        document.getElementById('type_sirt' + row).value = "5Knohand_.png";
                        document.getElementById('type_sirt' + row).setAttribute("type", "hidden");
                    } else if (type == "_10km_") {
                        document.getElementById("showSirt" + row).setAttribute("style", "");
                        document.getElementById("showImgSirt" + row).setAttribute("src", "../../assets/images/10Knohand_.png");
                        document.getElementById('type_sirt' + row).value = "10Knohand_.png";
                        document.getElementById('type_sirt' + row).setAttribute("type", "hidden");
                    }
                } else if (gender == "female") {
                    if (type == "_5km_") {
                        document.getElementById("showSirt" + row).setAttribute("style", "");
                        document.getElementById("showImgSirt" + row).setAttribute("src", "../../assets/images/5Khand_.png");
                        document.getElementById('type_sirt' + row).value = "5Khand_.png";
                        document.getElementById('type_sirt' + row).setAttribute("type", "hidden");
                    } else if (type == "_10km_") {
                        document.getElementById("showSirt" + row).setAttribute("style", "");
                        document.getElementById("showImgSirt" + row).setAttribute("src", "../../assets/images/10Khand_.png");
                        document.getElementById('type_sirt' + row).value = "10Khand_.png";
                        document.getElementById('type_sirt' + row).setAttribute("type", "hidden");
                    }
                }
            } else {
                document.getElementById("showSirt" + row).setAttribute("style", "display:none;");
                document.getElementById("showImgSirt" + row).setAttribute("src", "");
                document.getElementById('type_sirt' + row).value = "NoSirt";
                document.getElementById('type_sirt' + row).setAttribute("type", "hidden");

                document.getElementById("size" + row).setAttribute("disabled", "");
                document.getElementById("showOptionSize" + row).setAttribute("style", "display:none;");
            }
        }

        function getDelivery(row) {
            if (document.getElementById("delivery" + row).checked == true) {
                document.getElementById("get_delivery" + row).value = "Ok";
                document.getElementById("showInputAddress" + row).setAttribute("style", "");
                document.getElementById("contest_address" + row).setAttribute("required", "");
            } else {
                document.getElementById("get_delivery" + row).value = "No";
                document.getElementById("showInputAddress" + row).setAttribute("style", "display:none;");
                document.getElementById("contest_address" + row).value = "";
                document.getElementById("contest_address" + row).removeAttribute("required");
            }
        }

        <?php for ($i = 1; $i <= $people; $i++) {
            if ($delivery[$i]) { ?>
                document.getElementById("delivery" + "<?php echo $i; ?>").checked = true;
                getDelivery("<?php echo $i; ?>");
                // document.getElementById("showInputAddress"+"<?php echo $i; ?>").setAttribute("style", "");
            <?php }
        } ?>


    </script>
</body>

</html>