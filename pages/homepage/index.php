<?php

require_once ("../../service/connect.php");
$obj = new ConnectDatabase();
$obj->getSessionStart();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="keywords"
        content="SamphraoNightRun, samphraonightrun, Samphraonightrun, Samphraonightrun2023, สามพร้าวไนท์รัน, สามพร้าวไนท์รัน 2023, สามพร้าววิ่ง, ลงทะเบียนสามพร้าวไนท์รัน, ลงทะเบียนสามพร้าวไนท์รัน 2023, ลงทะเบียนสามพร้าวไนท์รัน2023, ลงทะเบียนแข่งวิ่งสามพร้าวไนท์รัน, ลงทะเบียนวิ่งสามพร้าวไนท์รัน, ลงทะเบียนวิ่งสามพร้าวไนท์รัน 2023, ลงทะเบียนวิ่งสามพร้าวไนท์รัน2023, S_P_N_R">
    <meta name="description" content="สามพร้าวไนท์รัน SamphraoNightrun SamphraoNightrun2023">
    <meta name="googlebot"
        content="SamphraoNightRun, samphraonightrun, Samphraonightrun, Samphraonightrun2023, สามพร้าวไนท์รัน, สามพร้าวไนท์รัน 2023, สามพร้าววิ่ง, ลงทะเบียนสามพร้าวไนท์รัน, ลงทะเบียนสามพร้าวไนท์รัน 2023, ลงทะเบียนสามพร้าวไนท์รัน2023, ลงทะเบียนแข่งวิ่งสามพร้าวไนท์รัน, ลงทะเบียนวิ่งสามพร้าวไนท์รัน, ลงทะเบียนวิ่งสามพร้าวไนท์รัน 2023, ลงทะเบียนวิ่งสามพร้าวไนท์รัน2023, S_P_N_R">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/images/obt_samphrao.png">
    <link rel="stylesheet" href="../../assets/css/adminlte.min.css">
    <link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="../../assets/css/style55.css">
    <title>ลงทะเบียนสามพร้าวไนท์รัน 2023</title>
    <style>
        * {
            font-family: tahoma;
        }

        .selector-for-some-widget {
            box-sizing: content-box;
        }

        .grid_image {
            background-color: inherit;
            display: inline-block;
            border: 0px;
        }

        .card {
            box-shadow: 0 0 0px;
        }

        .getTextStandByOnLeft {
            transition: 0.5s;
            margin: 0 0 0 -100%;
        }

        .getTextToLeft {
            transition: 0.5s;
        }

        td,
        th {
            border: 1px solid #FFFFFF;
        }
    </style>
</head>

<body>
    <?php require_once ("../../pages/include/navbar.php"); ?>
    <div style="position:fixed; z-index:99; left:2%; bottom:1%;">
        <div class="card p-2" style="background-color:rgba(0, 0, 0, 0.5); color:white;">
            <h5 id="navShowCounterTimeOut"></h5>
            <h5>เริ่มแข่งขันในวันที่ 4 กุมภาพันธ์ 2566 เวลา 18.00 น. ที่ อบต. สามพร้าว</h5>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <div class="container">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img style="border-radius:10px;" class="d-block w-100" src="../../assets/images/rub_napok.png"
                        alt="First slide">
                </div>
                <div class="carousel-item">
                    <img style="border-radius:10px;" class="d-block w-100" src="../../assets/images/two_slide.png"
                        alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img style="border-radius:10px;" class="d-block w-100" src="../../assets/images/dugdurngburdg.png"
                        alt="Three slide">
                </div>
                <div class="carousel-item">
                    <img style="border-radius:10px;" class="d-block w-100" src="../../assets/images/rgaregvreg.jpg"
                        alt="Four slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <br>
        <br>
        <div class="text-center">
            <div class="card grid_image mt-2" style="width: 40%;">
                <div class="card-body" style="padding:0 0;">
                    <img class="card-img-top" src="../../assets/images/5Knohand_.png" alt="ของรางวัลเสื้อ 5K ไม่มีแขน"
                        width="100%;">
                </div>
            </div>
            <div class="card grid_image mt-2" style="width: 40%;">
                <div class="card-body" style="padding:0 0;">
                    <img class="card-img-top" src="../../assets/images/10Knohand_.png" alt="ของรางวัลเสื้อ 10K ไม่มีแขน"
                        width="100%;">
                </div>
            </div>
            <div class="card grid_image mt-2" style="width: 40%;">
                <div class="card-body" style="padding:0 0;">
                    <img class="card-img-top" src="../../assets/images/5Khand_.png" alt="ของรางวัลเสื้อ 5K มีแขน"
                        width="100%;">
                </div>
            </div>
            <div class="card grid_image mt-2" style="width: 40%;">
                <div class="card-body" style="padding:0 0;">
                    <img class="card-img-top" src="../../assets/images/10Khand_.png" alt="ของรางวัลเสื้อ 10K มีแขน"
                        width="100%;">
                </div>
            </div>
        </div>

        <div id="slideCompetitionRules" class="card getTextStandByOnLeft"
            style="max-width:400px; margin-bottom:16px; background-color:rgba(0, 0, 0, 0.5); color:white;">
            <div class="card-header" style="border-bottom:1px solid white; opacity:100%;">
                <h3>กติกาการแข่งขัน</h3>
            </div>
            <div class="card-body" style="font-size:1rem;">
                <?php getCompetitionRules(); ?>
            </div>
        </div>
        <div id="slideObjective" class="card getTextStandByOnLeft"
            style="max-width:400px; margin-bottom:16px; background-color:rgba(0, 0, 0, 0.5); color:white;">
            <div class="card-header" style="border-bottom:1px solid white;">
                <h3>วัตถุประสงค์</h3>
            </div>
            <div class="card-body" style="font-size:1rem;">
                <?php getObjective(); ?>
            </div>
        </div>
        <div id="contactNumber" class="card getTextStandByOnLeft"
            style="max-width:400px; margin-bottom:16px; background-color:rgba(0, 0, 0, 0.5); color:white;">
            <div class="card-header" style="border-bottom:1px solid white;">
                <h3>ติดต่อสอบถาม</h3>
            </div>
            <div class="card-body" style="font-size:1rem;">
                <?php getContactNumber(); ?>
            </div>
        </div>
        <div id="numberOfCompetitors" class="card getTextStandByOnLeft"
            style="max-width:400px; margin-bottom:16px; background-color:rgba(0, 0, 0, 0.5); color:white;">
            <div class="card-header" style="border-bottom:1px solid white;">
                <h3>จำนวนผู้ที่ลงทะเบียนเข้าแข่งขัน</h3>
            </div>
            <div class="card-body" style="font-size:1rem;">
                <?php
                $statment_numberOfCom = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE gender = 'ชาย' AND status_approve = 'true' ");
                $statment_numberOfCom->execute();
                $numberOfgender_male = $statment_numberOfCom->rowCount();

                $statment_numberOfCom = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE gender = 'หญิง' AND status_approve = 'true' ");
                $statment_numberOfCom->execute();
                $numberOfgender_female = $statment_numberOfCom->rowCount();

                $statment_numberOfCom = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '5 Km.' AND status_approve = 'true' ");
                $statment_numberOfCom->execute();
                $numberOf_5km = $statment_numberOfCom->rowCount();

                $statment_numberOfCom = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND status_approve = 'true' ");
                $statment_numberOfCom->execute();
                $numberOf_10km = $statment_numberOfCom->rowCount();

                $total_people = $numberOf_5km + $numberOf_10km;
                ?>
                <h5>
                    <span style="color:#0664FF;">เพศชาย : <?php echo $numberOfgender_male; ?> คน </span><br>
                    <span style="color:#C674FF;">เพศหญิง : <?php echo $numberOfgender_female; ?> คน </span><br>
                    <span style="color:#17FF33;">ประเภทวิ่ง 5 กิโลเมตร : <?php echo $numberOf_5km; ?> คน </span><br>
                    <span style="color:#FFBB28;">ประเภทวิ่ง 10 กิโลเมตร : <?php echo $numberOf_10km; ?> คน </span><br>
                    มีผู้เข้าแข่งขันทั้งหมด : <?php echo $total_people; ?> คน <br>
                </h5>
            </div>
        </div>
        <div id="counterTimeOut" class="card getTextStandByOnLeft"
            style="max-width:400px; margin-bottom:16px; background-color:rgba(0, 0, 0, 0.5); color:white;">
            <div class="card-header" style="border-bottom:1px solid white;">
                <h3>เวลาที่เหลือในการลงทะเบียน</h3>
            </div>
            <div class="card-body" style="font-size:1rem;">
                <h5 id="ShowCounterTimeOut"></h5>
            </div>
        </div>
        <div id="information" class="card getTextStandByOnLeft"
            style="max-width:400px; margin-bottom:16px; background-color:rgba(0, 0, 0, 0.5); color:white;">
            <div class="card-header" style="border-bottom:1px solid white;">
                <h3>กำหนดการจัดกิจกรรม</h3>
            </div>
            <div class="card-body" style="font-size:1rem;">
                <?php getInformation(); ?>
            </div>
        </div>

        <div class="text-center card" style="background-color:rgba(0, 0, 0, 0.4); color:white;">
            <h2>ถ้วยรางวัล</h2>
            <div class="embed-responsive embed-responsive-16by9 mb-3">
                <iframe class="embed-responsive-item" src="../../assets/images/video_reward.mp4"
                    allowfullscreen></iframe>
            </div>

            <img src="../../assets/images/img_reward1.jpg" class="rounded mx-auto d-block mb-3 w-50" alt="...">

            <img src="../../assets/images/img_reward2.jpg" class="rounded mx-auto d-block mb-3 w-50" alt="...">

            <img src="../../assets/images/img_reward3.jpg" class="rounded mx-auto d-block mb-3 w-50" alt="...">
        </div>

        <div class="text-center card" style="background-color:rgba(0, 0, 0, 0.4); color:white;">
            <h3 class="font-weight-bold">ตารางสรุปยอดผู้เข้าแข่งขัน (แยกตามเพศ)</h3>
            <table class="table"
                style="border-collapse: collapse; border-spacing: 0; width: 100%; border: 1px solid #ddd;">
                <thead>
                    <tr>
                        <th scope="col">ลำดับที่</th>
                        <th scope="col">ประเภท</th>
                        <th scope="col">ชาย</th>
                        <th scope="col">หญิง</th>
                        <th scope="col">รวม</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total_column = 0;
                    $total_row_male = 0;
                    $total_row_famale = 0;
                    $total_row_all = 0;
                    ?>
                    <tr>
                        <td scope="col"> 1 </td>
                        <td scope="col"> 5 Km. ไม่เกิน 13 ปี</td>
                        <?php $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '5 Km.' AND sub_type = 'ไม่เกิน13ปี' AND gender = 'ชาย' ");
                        $statment->execute();
                        $t1 = $statment->rowCount(); ?>
                        <td scope="col"> <?php echo $t1; ?> คน</td>
                        <?php $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '5 Km.' AND sub_type = 'ไม่เกิน13ปี' AND gender = 'หญิง' ");
                        $statment->execute();
                        $t2 = $statment->rowCount(); ?>
                        <td scope="col"> <?php echo $t2; ?> คน</td>
                        <?php $total_column = $t1 + $t2; ?>
                        <td scope="col"> <?php echo $total_column; ?> คน</td>
                    </tr>
                    <?php $total_row_male += $t1;
                    $total_row_famale += $t2;
                    $total_row_all += $total_column; ?>
                    <tr>
                        <td scope="col"> 2 </td>
                        <td scope="col"> 5 Km. รุ่น 13 ปีขึ้นไป</td>
                        <?php $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '5 Km.' AND sub_type = '13ปีขึ้นไป' AND gender = 'ชาย' ");
                        $statment->execute();
                        $t1 = $statment->rowCount(); ?>
                        <td scope="col"> <?php echo $t1; ?> คน</td>
                        <?php $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '5 Km.' AND sub_type = '13ปีขึ้นไป' AND gender = 'หญิง' ");
                        $statment->execute();
                        $t2 = $statment->rowCount(); ?>
                        <td scope="col"> <?php echo $t2; ?> คน</td>
                        <?php $total_column = $t1 + $t2; ?>
                        <td scope="col"> <?php echo $total_column; ?> คน</td>
                    </tr>
                    <?php $total_row_male += $t1;
                    $total_row_famale += $t2;
                    $total_row_all += $total_column; ?>
                    <tr>
                        <td scope="col"> 3 </td>
                        <td scope="col"> 10 Km. รุ่นไม่เกิน 13 ปี</td>
                        <?php $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = 'ไม่เกิน13ปี' AND gender = 'ชาย' ");
                        $statment->execute();
                        $t1 = $statment->rowCount(); ?>
                        <td scope="col"> <?php echo $t1; ?> คน</td>
                        <?php $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = 'ไม่เกิน13ปี' AND gender = 'หญิง' ");
                        $statment->execute();
                        $t2 = $statment->rowCount(); ?>
                        <td scope="col"> <?php echo $t2; ?> คน</td>
                        <?php $total_column = $t1 + $t2; ?>
                        <td scope="col"> <?php echo $total_column; ?> คน</td>
                    </tr>
                    <?php $total_row_male += $t1;
                    $total_row_famale += $t2;
                    $total_row_all += $total_column; ?>
                    <tr>
                        <td scope="col"> 4 </td>
                        <td scope="col"> 10 Km. รุ่น 13 - 19</td>
                        <?php $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '13 - 19' AND gender = 'ชาย' ");
                        $statment->execute();
                        $t1 = $statment->rowCount(); ?>
                        <td scope="col"> <?php echo $t1; ?> คน</td>
                        <?php $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '13 - 19' AND gender = 'หญิง' ");
                        $statment->execute();
                        $t2 = $statment->rowCount(); ?>
                        <td scope="col"> <?php echo $t2; ?> คน</td>
                        <?php $total_column = $t1 + $t2; ?>
                        <td scope="col"> <?php echo $total_column; ?> คน</td>
                    </tr>
                    <?php $total_row_male += $t1;
                    $total_row_famale += $t2;
                    $total_row_all += $total_column; ?>
                    <tr>
                        <td scope="col"> 5 </td>
                        <td scope="col"> 10 Km. รุ่น 20 - 29</td>
                        <?php $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '20 - 29' AND gender = 'ชาย' ");
                        $statment->execute();
                        $t1 = $statment->rowCount(); ?>
                        <td scope="col"> <?php echo $t1; ?> คน</td>
                        <?php $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '20 - 29' AND gender = 'หญิง' ");
                        $statment->execute();
                        $t2 = $statment->rowCount(); ?>
                        <td scope="col"> <?php echo $t2; ?> คน</td>
                        <?php $total_column = $t1 + $t2; ?>
                        <td scope="col"> <?php echo $total_column; ?> คน</td>
                    </tr>
                    <?php $total_row_male += $t1;
                    $total_row_famale += $t2;
                    $total_row_all += $total_column; ?>
                    <tr>
                        <td scope="col"> 6 </td>
                        <td scope="col"> 10 Km. รุ่น 30 - 39</td>
                        <?php $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '30 - 39' AND gender = 'ชาย' ");
                        $statment->execute();
                        $t1 = $statment->rowCount(); ?>
                        <td scope="col"> <?php echo $t1; ?> คน</td>
                        <?php $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '30 - 39' AND gender = 'หญิง' ");
                        $statment->execute();
                        $t2 = $statment->rowCount(); ?>
                        <td scope="col"> <?php echo $t2; ?> คน</td>
                        <?php $total_column = $t1 + $t2; ?>
                        <td scope="col"> <?php echo $total_column; ?> คน</td>
                    </tr>
                    <?php $total_row_male += $t1;
                    $total_row_famale += $t2;
                    $total_row_all += $total_column; ?>
                    <tr>
                        <td scope="col"> 7 </td>
                        <td scope="col"> 10 Km. รุ่น 40 - 49</td>
                        <?php $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '40 - 49' AND gender = 'ชาย' ");
                        $statment->execute();
                        $t1 = $statment->rowCount(); ?>
                        <td scope="col"> <?php echo $t1; ?> คน</td>
                        <?php $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '40 - 49' AND gender = 'หญิง' ");
                        $statment->execute();
                        $t2 = $statment->rowCount(); ?>
                        <td scope="col"> <?php echo $t2; ?> คน</td>
                        <?php $total_column = $t1 + $t2; ?>
                        <td scope="col"> <?php echo $total_column; ?> คน</td>
                    </tr>
                    <?php $total_row_male += $t1;
                    $total_row_famale += $t2;
                    $total_row_all += $total_column; ?>
                    <tr>
                        <td scope="col"> 8 </td>
                        <td scope="col"> 10 Km. รุ่น 50 - 59</td>
                        <?php $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '50 - 59' AND gender = 'ชาย' ");
                        $statment->execute();
                        $t1 = $statment->rowCount(); ?>
                        <td scope="col"> <?php echo $t1; ?> คน</td>
                        <?php $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '50 - 59' AND gender = 'หญิง' ");
                        $statment->execute();
                        $t2 = $statment->rowCount(); ?>
                        <td scope="col"> <?php echo $t2; ?> คน</td>
                        <?php $total_column = $t1 + $t2; ?>
                        <td scope="col"> <?php echo $total_column; ?> คน</td>
                    </tr>
                    <?php $total_row_male += $t1;
                    $total_row_famale += $t2;
                    $total_row_all += $total_column; ?>
                    <tr>
                        <td scope="col"> 9 </td>
                        <td scope="col"> 10 Km. รุ่น 60 ปีขึ้นไป</td>
                        <?php $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '60ปีขึ้นไป' AND gender = 'ชาย' ");
                        $statment->execute();
                        $t1 = $statment->rowCount(); ?>
                        <td scope="col"> <?php echo $t1; ?> คน</td>
                        <?php $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '60ปีขึ้นไป' AND gender = 'หญิง' ");
                        $statment->execute();
                        $t2 = $statment->rowCount(); ?>
                        <td scope="col"> <?php echo $t2; ?> คน</td>
                        <?php $total_column = $t1 + $t2; ?>
                        <td scope="col"> <?php echo $total_column; ?> คน</td>
                    </tr>
                    <?php $total_row_male += $t1;
                    $total_row_famale += $t2;
                    $total_row_all += $total_column; ?>
                    <tr>
                        <td colspan="2" class="text-center"><b style="color:#17FF33;">รวม</b></td>
                        <td><b style="color:#17FF33;"><?php echo $total_row_male; ?> คน</b></td>
                        <td><b style="color:#17FF33;"><?php echo $total_row_famale; ?> คน</b></td>
                        <td><b style="color:#17FF33;"><?php echo $total_row_all; ?> คน</b></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <?php if (!isset($_SESSION["admin"])) { ?>
            <div class="text-center">
                <div class="card grid_image" style="background-color:inherit;">
                    <div class="card-body">
                        <a href="../../pages/check_approve/">
                            <button type="button" class="btn btn-primary py-2 px-5">ตรวจสอบสิทธิการเข้าแข่งขัน</button>
                        </a>
                        <a href="../../pages/register/">
                            <button type="button" class="btn btn-success py-2 px-5">ลงทะเบียนวิ่งสามพร้าวไนท์รัน</button>
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>

        <div class="modal fade" id="showAlertAtHomePage" tabindex="-1" role="dialog" aria-labelledby="alertAtHomePage"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-bold" id="alertAtHomePage">แจ้งข่าว</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">X</span>
                        </button>
                    </div>
                    <div class="modal-body" style="height:30rem;">
                        - ตอนนี้ได้ทำการ <span style="color:red; font-weight:bold;">ปิดรับลงทะเบียน</span>
                        ผ่านหน้าเว็บแล้ว ท่านสามารถลงทะเบียนได้อีกทีในวันที่ 4 กุมภาพันธ์ พศ.2566 ที่ อบต.สามพร้าว <br>
                        <br>

                        - ผู้ที่ลงทะเบียนก่อนวันที่ 23 มกราคม พศ.2566 <span
                            style="color:green; font-weight:bold;">สามารถมารับเสื้อ</span>ได้ที่ กองการศึกษา
                        อบต.สามพร้าว
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal" data-toggle="modal"
                            data-target="#information_nav">ดูกำหนดการจัดกิจกรรม</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <br> <br> <br> <br> <br> <br> <br>

    <script src="../../plugins/jquery/jquery.min.js"></script>
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#showAlertAtHomePage').modal('show');
        });

        $(function () {
            var nua = navigator.userAgent;
            var isAndroid = (nua.indexOf('Mozilla/5.0') > -1 && nua.indexOf('Android ') > -1 && nua.indexOf('AppleWebKit') > -1 && nua.indexOf('Chrome') === -1)
            if (isAndroid) {
                $('select.form-control').removeClass('form-control').css('width', '100%')
            }
        })

        $(document).ready(function () {
            $(document).scroll(function () {
                scrollFunction();
            });
        });

        function scrollFunction() {
            // console.log(document.documentElement.scrollTop);
            if ($(window).width() <= 960 && $(window).height() <= 850) {
                if (document.documentElement.scrollTop >= 0) {
                    document.getElementById("slideCompetitionRules").classList.add("getTextToLeft");
                    document.getElementById("slideCompetitionRules").classList.remove("getTextStandByOnLeft");
                } else {
                    document.getElementById("slideCompetitionRules").classList.add("getTextStandByOnLeft");
                    document.getElementById("slideCompetitionRules").classList.remove("getTextToLeft");
                }
                if (document.documentElement.scrollTop > 50) {
                    document.getElementById("slideObjective").classList.add("getTextToLeft");
                    document.getElementById("slideObjective").classList.remove("getTextStandByOnLeft");
                } else {
                    document.getElementById("slideObjective").classList.add("getTextStandByOnLeft");
                    document.getElementById("slideObjective").classList.remove("getTextToLeft");
                }
                if (document.documentElement.scrollTop > 420) {
                    document.getElementById("contactNumber").classList.add("getTextToLeft");
                    document.getElementById("contactNumber").classList.remove("getTextStandByOnLeft");
                } else {
                    document.getElementById("contactNumber").classList.add("getTextStandByOnLeft");
                    document.getElementById("contactNumber").classList.remove("getTextToLeft");
                }
                if (document.documentElement.scrollTop > 470) {
                    document.getElementById("numberOfCompetitors").classList.add("getTextToLeft");
                    document.getElementById("numberOfCompetitors").classList.remove("getTextStandByOnLeft");
                } else {
                    document.getElementById("numberOfCompetitors").classList.add("getTextStandByOnLeft");
                    document.getElementById("numberOfCompetitors").classList.remove("getTextToLeft");
                }
                if (document.documentElement.scrollTop > 1000) {
                    document.getElementById("counterTimeOut").classList.add("getTextToLeft");
                    document.getElementById("counterTimeOut").classList.remove("getTextStandByOnLeft");

                    document.getElementById("information").classList.add("getTextToLeft");
                    document.getElementById("information").classList.remove("getTextStandByOnLeft");
                } else {
                    document.getElementById("counterTimeOut").classList.add("getTextStandByOnLeft");
                    document.getElementById("counterTimeOut").classList.remove("getTextToLeft");

                    document.getElementById("information").classList.add("getTextStandByOnLeft");
                    document.getElementById("information").classList.remove("getTextToLeft");
                }
            } else {
                if (document.documentElement.scrollTop > 600) {
                    document.getElementById("slideCompetitionRules").classList.add("getTextToLeft");
                    document.getElementById("slideCompetitionRules").classList.remove("getTextStandByOnLeft");
                } else {
                    document.getElementById("slideCompetitionRules").classList.add("getTextStandByOnLeft");
                    document.getElementById("slideCompetitionRules").classList.remove("getTextToLeft");
                }
                if (document.documentElement.scrollTop > 950) {
                    document.getElementById("slideObjective").classList.add("getTextToLeft");
                    document.getElementById("slideObjective").classList.remove("getTextStandByOnLeft");
                } else {
                    document.getElementById("slideObjective").classList.add("getTextStandByOnLeft");
                    document.getElementById("slideObjective").classList.remove("getTextToLeft");
                }
                if (document.documentElement.scrollTop > 1100) {
                    document.getElementById("contactNumber").classList.add("getTextToLeft");
                    document.getElementById("contactNumber").classList.remove("getTextStandByOnLeft");
                } else {
                    document.getElementById("contactNumber").classList.add("getTextStandByOnLeft");
                    document.getElementById("contactNumber").classList.remove("getTextToLeft");
                }
                if (document.documentElement.scrollTop > 1170) {
                    document.getElementById("numberOfCompetitors").classList.add("getTextToLeft");
                    document.getElementById("numberOfCompetitors").classList.remove("getTextStandByOnLeft");
                } else {
                    document.getElementById("numberOfCompetitors").classList.add("getTextStandByOnLeft");
                    document.getElementById("numberOfCompetitors").classList.remove("getTextToLeft");
                }
                if (document.documentElement.scrollTop > 1500) {
                    document.getElementById("counterTimeOut").classList.add("getTextToLeft");
                    document.getElementById("counterTimeOut").classList.remove("getTextStandByOnLeft");

                    document.getElementById("information").classList.add("getTextToLeft");
                    document.getElementById("information").classList.remove("getTextStandByOnLeft");
                } else {
                    document.getElementById("counterTimeOut").classList.add("getTextStandByOnLeft");
                    document.getElementById("counterTimeOut").classList.remove("getTextToLeft");

                    document.getElementById("information").classList.add("getTextStandByOnLeft");
                    document.getElementById("information").classList.remove("getTextToLeft");
                }
            }
        }

        // ******************************** Counter Time ********************************
        // Set the date we're counting down to
        var countDownDate = new Date("Jan 26, 2023 00:00:00").getTime();

        // Update the count down every 1 second
        var x = setInterval(function () {
            // Get today's date and time
            let now = new Date().getTime();

            // Find the distance between now and the count down date
            let distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            let days = Math.floor(distance / (1000 * 60 * 60 * 24));
            let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="demo"
            document.getElementById("navShowCounterTimeOut").innerHTML = "เหลือเวลาลงทะเบียน : <span style='color:#FFBB28;'>" + days + " วัน </span> <span style='color:#1DBDFE;'>" + hours + " ชั่วโมง </span> <span style='color:#C97FFF;'>" + minutes + " นาที </span> <span style='color:#FB7C44;'>" + seconds + " วินาที </span>";
            document.getElementById("ShowCounterTimeOut").innerHTML = "เหลือเวลาลงทะเบียน : <span style='color:#FFBB28;'>" + days + " วัน </span> <span style='color:#1DBDFE;'>" + hours + " ชั่วโมง </span> <span style='color:#C97FFF;'>" + minutes + " นาที </span> <span style='color:#FB7C44;'>" + seconds + " วินาที </span>";

            // If the count down is over, write some text 
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("navShowCounterTimeOut").innerHTML = "<span style='color:red;'>หมดเวลาลงทะเบียนแล้ว</span>";
                document.getElementById("ShowCounterTimeOut").innerHTML = "<span style='color:red;'>หมดเวลาลงทะเบียนแล้ว</span>";
            }
        }, 1000);
        // ******************************** Counter Time ********************************
    </script>
</body>

</html>