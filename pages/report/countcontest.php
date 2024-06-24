<?php
    require_once("../../service/connect.php");
    $obj = new ConnectDatabase();
    $obj->getSessionStart();

    if(!isset($_SESSION["admin"])){ 
        header("location: ../../pages/homepage/");
        exit;
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/x-icon" href="../../assets/images/obt_samphrao.png">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>ตารางสรุปยอดผู้เข้าแข่งขัน</title>
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
                <br>
                <br>
                <div class="card shadow p-3 p-md-4 mt-4" style="overflow-x:auto;">
                    <h3 class="font-weight-bold">ตารางสรุปยอดผู้เข้าแข่งขัน (แยกตามเพศ)</h3>
                    <table class="table" style="border-collapse: collapse; border-spacing: 0; width: 100%; border: 1px solid #ddd;">
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
                    <?php       $total_column = 0;
                                $total_row_male = 0;
                                $total_row_famale = 0;
                                $total_row_all = 0;
                    ?>
                                <tr>
                                    <td scope="col"> 1 </td>
                                    <td scope="col"> 5 Km. ไม่เกิน 13 ปี</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '5 Km.' AND sub_type = 'ไม่เกิน13ปี' AND gender = 'ชาย' ");        $statment->execute();
                                    $t1 = $statment->rowCount(); ?>
                                    <td scope="col"> <?php echo $t1;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '5 Km.' AND sub_type = 'ไม่เกิน13ปี' AND gender = 'หญิง' ");        $statment->execute();
                                    $t2 = $statment->rowCount(); ?>
                                    <td scope="col"> <?php echo $t2;?> คน</td>
                    <?php           $total_column = $t1 + $t2; ?>
                                    <td scope="col"> <?php echo $total_column;?> คน</td>
                                </tr>
                    <?php       $total_row_male += $t1;
                                $total_row_famale += $t2;
                                $total_row_all += $total_column; ?>
                                <tr>
                                    <td scope="col"> 2 </td>
                                    <td scope="col"> 5 Km. รุ่น 13 ปีขึ้นไป</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '5 Km.' AND sub_type = '13ปีขึ้นไป' AND gender = 'ชาย' ");        $statment->execute();
                                    $t1 = $statment->rowCount(); ?>
                                    <td scope="col"> <?php echo $t1;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '5 Km.' AND sub_type = '13ปีขึ้นไป' AND gender = 'หญิง' ");        $statment->execute();
                                    $t2 = $statment->rowCount(); ?>
                                    <td scope="col"> <?php echo $t2;?> คน</td>
                    <?php           $total_column = $t1 + $t2; ?>
                                    <td scope="col"> <?php echo $total_column;?> คน</td>
                                </tr>
                    <?php       $total_row_male += $t1;
                                $total_row_famale += $t2;
                                $total_row_all += $total_column; ?>
                                <tr>
                                    <td scope="col"> 3 </td>
                                    <td scope="col"> 10 Km. รุ่นไม่เกิน 13 ปี</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = 'ไม่เกิน13ปี' AND gender = 'ชาย' ");        $statment->execute();
                                    $t1 = $statment->rowCount(); ?>
                                    <td scope="col"> <?php echo $t1;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = 'ไม่เกิน13ปี' AND gender = 'หญิง' ");        $statment->execute();
                                    $t2 = $statment->rowCount(); ?>
                                    <td scope="col"> <?php echo $t2;?> คน</td>
                    <?php           $total_column = $t1 + $t2; ?>
                                    <td scope="col"> <?php echo $total_column;?> คน</td>
                                </tr>
                    <?php       $total_row_male += $t1;
                                $total_row_famale += $t2;
                                $total_row_all += $total_column; ?>
                                <tr>
                                    <td scope="col"> 4 </td>
                                    <td scope="col"> 10 Km. รุ่น 13 - 19</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '13 - 19' AND gender = 'ชาย' ");        $statment->execute();
                                    $t1 = $statment->rowCount(); ?>
                                    <td scope="col"> <?php echo $t1;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '13 - 19' AND gender = 'หญิง' ");        $statment->execute();
                                    $t2 = $statment->rowCount(); ?>
                                    <td scope="col"> <?php echo $t2;?> คน</td>
                    <?php           $total_column = $t1 + $t2; ?>
                                    <td scope="col"> <?php echo $total_column;?> คน</td>
                                </tr>
                    <?php       $total_row_male += $t1;
                                $total_row_famale += $t2;
                                $total_row_all += $total_column; ?>
                                <tr>
                                    <td scope="col"> 5 </td>
                                    <td scope="col"> 10 Km. รุ่น 20 - 29</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '20 - 29' AND gender = 'ชาย' ");        $statment->execute();
                                    $t1 = $statment->rowCount(); ?>
                                    <td scope="col"> <?php echo $t1;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '20 - 29' AND gender = 'หญิง' ");        $statment->execute();
                                    $t2 = $statment->rowCount(); ?>
                                    <td scope="col"> <?php echo $t2;?> คน</td>
                    <?php           $total_column = $t1 + $t2; ?>
                                    <td scope="col"> <?php echo $total_column;?> คน</td>
                                </tr>
                    <?php       $total_row_male += $t1;
                                $total_row_famale += $t2;
                                $total_row_all += $total_column; ?>
                                <tr>
                                    <td scope="col"> 6 </td>
                                    <td scope="col"> 10 Km. รุ่น 30 - 39</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '30 - 39' AND gender = 'ชาย' ");        $statment->execute();
                                    $t1 = $statment->rowCount(); ?>
                                    <td scope="col"> <?php echo $t1;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '30 - 39' AND gender = 'หญิง' ");        $statment->execute();
                                    $t2 = $statment->rowCount(); ?>
                                    <td scope="col"> <?php echo $t2;?> คน</td>
                    <?php           $total_column = $t1 + $t2; ?>
                                    <td scope="col"> <?php echo $total_column;?> คน</td>
                                </tr>
                    <?php       $total_row_male += $t1;
                                $total_row_famale += $t2;
                                $total_row_all += $total_column; ?>
                                <tr>
                                    <td scope="col"> 7 </td>
                                    <td scope="col"> 10 Km. รุ่น 40 - 49</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '40 - 49' AND gender = 'ชาย' ");        $statment->execute();
                                    $t1 = $statment->rowCount(); ?>
                                    <td scope="col"> <?php echo $t1;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '40 - 49' AND gender = 'หญิง' ");        $statment->execute();
                                    $t2 = $statment->rowCount(); ?>
                                    <td scope="col"> <?php echo $t2;?> คน</td>
                    <?php           $total_column = $t1 + $t2; ?>
                                    <td scope="col"> <?php echo $total_column;?> คน</td>
                                </tr>
                    <?php       $total_row_male += $t1;
                                $total_row_famale += $t2;
                                $total_row_all += $total_column; ?>
                                <tr>
                                    <td scope="col"> 8 </td>
                                    <td scope="col"> 10 Km. รุ่น 50 - 59</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '50 - 59' AND gender = 'ชาย' ");        $statment->execute();
                                    $t1 = $statment->rowCount(); ?>
                                    <td scope="col"> <?php echo $t1;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '50 - 59' AND gender = 'หญิง' ");        $statment->execute();
                                    $t2 = $statment->rowCount(); ?>
                                    <td scope="col"> <?php echo $t2;?> คน</td>
                    <?php           $total_column = $t1 + $t2; ?>
                                    <td scope="col"> <?php echo $total_column;?> คน</td>
                                </tr>
                    <?php       $total_row_male += $t1;
                                $total_row_famale += $t2;
                                $total_row_all += $total_column; ?>
                                <tr>
                                    <td scope="col"> 9 </td>
                                    <td scope="col"> 10 Km. รุ่น 60 ปีขึ้นไป</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '60ปีขึ้นไป' AND gender = 'ชาย' ");        $statment->execute();
                                    $t1 = $statment->rowCount(); ?>
                                    <td scope="col"> <?php echo $t1;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '60ปีขึ้นไป' AND gender = 'หญิง' ");        $statment->execute();
                                    $t2 = $statment->rowCount(); ?>
                                    <td scope="col"> <?php echo $t2;?> คน</td>
                    <?php           $total_column = $t1 + $t2; ?>
                                    <td scope="col"> <?php echo $total_column;?> คน</td>
                                </tr>
                    <?php       $total_row_male += $t1;
                                $total_row_famale += $t2;
                                $total_row_all += $total_column; ?>
                                <tr>
                                    <td colspan="2" class="text-center"><b>รวม</b></td>
                                    <td><b><?php echo $total_row_male;?> คน</b></td>
                                    <td><b><?php echo $total_row_famale;?> คน</b></td>
                                    <td><b><?php echo $total_row_all;?> คน</b></td>
                                </tr>
                        </tbody>
                    </table>
                    <br>
                    <br>
                    <br>
                    <h3 class="font-weight-bold">ตารางสรุปยอดผู้เข้าแข่งขัน (แยกตามไซส์เสื้อ)</h3>
                    <table class="table" style="border-collapse: collapse; border-spacing: 0; width: 100%; border: 1px solid #ddd;">
                        <thead>
                            <tr>
                                <th scope="col">ลำดับที่</th>
                                <th scope="col">ประเภท</th>
                                <th scope="col">SSS</th>
                                <th scope="col">SS</th>
                                <th scope="col">S</th>
                                <th scope="col">M</th>
                                <th scope="col">L</th>
                                <th scope="col">XL</th>
                                <th scope="col">2XL</th>
                                <th scope="col">3XL</th>
                                <th scope="col">4XL</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php       $total_row_SSS = 0;
                                $total_row_SS = 0;
                                $total_row_S = 0;
                                $total_row_M = 0;
                                $total_row_L = 0;
                                $total_row_XL = 0;
                                $total_row_2XL = 0;
                                $total_row_3XL = 0;
                                $total_row_4XL = 0;
                    ?>
                                <tr>
                                    <td scope="col"> 1 </td>
                                    <td scope="col"> 5 Km. ไม่เกิน 13 ปี</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '5 Km.' AND sub_type = 'ไม่เกิน13ปี' AND size = 'SSS' ");        $statment->execute();
                                    $SSS = $statment->rowCount(); 
                                    $total_row_SSS += $SSS; ?>
                                    <td scope="col"> <?php echo $SSS;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '5 Km.' AND sub_type = 'ไม่เกิน13ปี' AND size = 'SS' ");        $statment->execute();
                                    $SS = $statment->rowCount();
                                    $total_row_SS += $SS; ?>
                                    <td scope="col"> <?php echo $SS;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '5 Km.' AND sub_type = 'ไม่เกิน13ปี' AND size = 'S' ");        $statment->execute();
                                    $S = $statment->rowCount();
                                    $total_row_S += $S; ?>
                                    <td scope="col"> <?php echo $S;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '5 Km.' AND sub_type = 'ไม่เกิน13ปี' AND size = 'M' ");        $statment->execute();
                                    $M = $statment->rowCount();
                                    $total_row_M += $M; ?>
                                    <td scope="col"> <?php echo $M;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '5 Km.' AND sub_type = 'ไม่เกิน13ปี' AND size = 'L' ");        $statment->execute();
                                    $L = $statment->rowCount();
                                    $total_row_L += $L; ?>
                                    <td scope="col"> <?php echo $L;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '5 Km.' AND sub_type = 'ไม่เกิน13ปี' AND size = 'XL' ");        $statment->execute();
                                    $XL = $statment->rowCount();
                                    $total_row_XL += $XL; ?>
                                    <td scope="col"> <?php echo $XL;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '5 Km.' AND sub_type = 'ไม่เกิน13ปี' AND size = '2XL' ");        $statment->execute();
                                    $XL2 = $statment->rowCount();
                                    $total_row_2XL += $XL2; ?>
                                    <td scope="col"> <?php echo $XL2;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '5 Km.' AND sub_type = 'ไม่เกิน13ปี' AND size = '3XL' ");        $statment->execute();
                                    $XL3 = $statment->rowCount();
                                    $total_row_3XL += $XL3; ?>
                                    <td scope="col"> <?php echo $XL3;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '5 Km.' AND sub_type = 'ไม่เกิน13ปี' AND size = '4XL' ");        $statment->execute();
                                    $XL4 = $statment->rowCount();
                                    $total_row_4XL += $XL4; ?>
                                    <td scope="col"> <?php echo $XL4;?> คน</td>
                                </tr>
                                <tr>
                                    <td scope="col"> 2 </td>
                                    <td scope="col"> 5 Km. 13ปีขึ้นไป</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '5 Km.' AND sub_type = '13ปีขึ้นไป' AND size = 'SSS' ");        $statment->execute();
                                    $SSS = $statment->rowCount(); 
                                    $total_row_SSS += $SSS; ?>
                                    <td scope="col"> <?php echo $SSS;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '5 Km.' AND sub_type = '13ปีขึ้นไป' AND size = 'SS' ");        $statment->execute();
                                    $SS = $statment->rowCount();
                                    $total_row_SS += $SS; ?>
                                    <td scope="col"> <?php echo $SS;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '5 Km.' AND sub_type = '13ปีขึ้นไป' AND size = 'S' ");        $statment->execute();
                                    $S = $statment->rowCount();
                                    $total_row_S += $S; ?>
                                    <td scope="col"> <?php echo $S;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '5 Km.' AND sub_type = '13ปีขึ้นไป' AND size = 'M' ");        $statment->execute();
                                    $M = $statment->rowCount();
                                    $total_row_M += $M; ?>
                                    <td scope="col"> <?php echo $M;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '5 Km.' AND sub_type = '13ปีขึ้นไป' AND size = 'L' ");        $statment->execute();
                                    $L = $statment->rowCount();
                                    $total_row_L += $L; ?>
                                    <td scope="col"> <?php echo $L;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '5 Km.' AND sub_type = '13ปีขึ้นไป' AND size = 'XL' ");        $statment->execute();
                                    $XL = $statment->rowCount();
                                    $total_row_XL += $XL; ?>
                                    <td scope="col"> <?php echo $XL;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '5 Km.' AND sub_type = '13ปีขึ้นไป' AND size = '2XL' ");        $statment->execute();
                                    $XL2 = $statment->rowCount();
                                    $total_row_2XL += $XL2; ?>
                                    <td scope="col"> <?php echo $XL2;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '5 Km.' AND sub_type = '13ปีขึ้นไป' AND size = '3XL' ");        $statment->execute();
                                    $XL3 = $statment->rowCount();
                                    $total_row_3XL += $XL3; ?>
                                    <td scope="col"> <?php echo $XL3;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '5 Km.' AND sub_type = '13ปีขึ้นไป' AND size = '4XL' ");        $statment->execute();
                                    $XL4 = $statment->rowCount();
                                    $total_row_4XL += $XL4; ?>
                                    <td scope="col"> <?php echo $XL4;?> คน</td>
                                </tr>
                                <tr>
                                    <td scope="col"> 3 </td>
                                    <td scope="col"> 10 Km. ไม่เกิน 13 ปี</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = 'ไม่เกิน13ปี' AND size = 'SSS' ");        $statment->execute();
                                    $SSS = $statment->rowCount(); 
                                    $total_row_SSS += $SSS; ?>
                                    <td scope="col"> <?php echo $SSS;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = 'ไม่เกิน13ปี' AND size = 'SS' ");        $statment->execute();
                                    $SS = $statment->rowCount();
                                    $total_row_SS += $SS; ?>
                                    <td scope="col"> <?php echo $SS;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = 'ไม่เกิน13ปี' AND size = 'S' ");        $statment->execute();
                                    $S = $statment->rowCount();
                                    $total_row_S += $S; ?>
                                    <td scope="col"> <?php echo $S;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = 'ไม่เกิน13ปี' AND size = 'M' ");        $statment->execute();
                                    $M = $statment->rowCount();
                                    $total_row_M += $M; ?>
                                    <td scope="col"> <?php echo $M;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = 'ไม่เกิน13ปี' AND size = 'L' ");        $statment->execute();
                                    $L = $statment->rowCount();
                                    $total_row_L += $L; ?>
                                    <td scope="col"> <?php echo $L;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = 'ไม่เกิน13ปี' AND size = 'XL' ");        $statment->execute();
                                    $XL = $statment->rowCount();
                                    $total_row_XL += $XL; ?>
                                    <td scope="col"> <?php echo $XL;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = 'ไม่เกิน13ปี' AND size = '2XL' ");        $statment->execute();
                                    $XL2 = $statment->rowCount();
                                    $total_row_2XL += $XL2; ?>
                                    <td scope="col"> <?php echo $XL2;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = 'ไม่เกิน13ปี' AND size = '3XL' ");        $statment->execute();
                                    $XL3 = $statment->rowCount();
                                    $total_row_3XL += $XL3; ?>
                                    <td scope="col"> <?php echo $XL3;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = 'ไม่เกิน13ปี' AND size = '4XL' ");        $statment->execute();
                                    $XL4 = $statment->rowCount();
                                    $total_row_4XL += $XL4; ?>
                                    <td scope="col"> <?php echo $XL4;?> คน</td>
                                </tr>
                                <tr>
                                    <td scope="col"> 4 </td>
                                    <td scope="col"> 10 Km. รุ่น 13 - 19</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '13 - 19' AND size = 'SSS' ");        $statment->execute();
                                    $SSS = $statment->rowCount(); 
                                    $total_row_SSS += $SSS; ?>
                                    <td scope="col"> <?php echo $SSS;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '13 - 19' AND size = 'SS' ");        $statment->execute();
                                    $SS = $statment->rowCount();
                                    $total_row_SS += $SS; ?>
                                    <td scope="col"> <?php echo $SS;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '13 - 19' AND size = 'S' ");        $statment->execute();
                                    $S = $statment->rowCount();
                                    $total_row_S += $S; ?>
                                    <td scope="col"> <?php echo $S;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '13 - 19' AND size = 'M' ");        $statment->execute();
                                    $M = $statment->rowCount();
                                    $total_row_M += $M; ?>
                                    <td scope="col"> <?php echo $M;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '13 - 19' AND size = 'L' ");        $statment->execute();
                                    $L = $statment->rowCount();
                                    $total_row_L += $L; ?>
                                    <td scope="col"> <?php echo $L;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '13 - 19' AND size = 'XL' ");        $statment->execute();
                                    $XL = $statment->rowCount();
                                    $total_row_XL += $XL; ?>
                                    <td scope="col"> <?php echo $XL;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '13 - 19' AND size = '2XL' ");        $statment->execute();
                                    $XL2 = $statment->rowCount();
                                    $total_row_2XL += $XL2; ?>
                                    <td scope="col"> <?php echo $XL2;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '13 - 19' AND size = '3XL' ");        $statment->execute();
                                    $XL3 = $statment->rowCount();
                                    $total_row_3XL += $XL3; ?>
                                    <td scope="col"> <?php echo $XL3;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '13 - 19' AND size = '4XL' ");        $statment->execute();
                                    $XL4 = $statment->rowCount();
                                    $total_row_4XL += $XL4; ?>
                                    <td scope="col"> <?php echo $XL4;?> คน</td>
                                </tr>
                                <tr>
                                    <td scope="col"> 5 </td>
                                    <td scope="col"> 10 Km. รุ่น 20 - 29</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '20 - 29' AND size = 'SSS' ");        $statment->execute();
                                    $SSS = $statment->rowCount(); 
                                    $total_row_SSS += $SSS; ?>
                                    <td scope="col"> <?php echo $SSS;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '20 - 29' AND size = 'SS' ");        $statment->execute();
                                    $SS = $statment->rowCount();
                                    $total_row_SS += $SS; ?>
                                    <td scope="col"> <?php echo $SS;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '20 - 29' AND size = 'S' ");        $statment->execute();
                                    $S = $statment->rowCount();
                                    $total_row_S += $S; ?>
                                    <td scope="col"> <?php echo $S;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '20 - 29' AND size = 'M' ");        $statment->execute();
                                    $M = $statment->rowCount();
                                    $total_row_M += $M; ?>
                                    <td scope="col"> <?php echo $M;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '20 - 29' AND size = 'L' ");        $statment->execute();
                                    $L = $statment->rowCount();
                                    $total_row_L += $L; ?>
                                    <td scope="col"> <?php echo $L;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '20 - 29' AND size = 'XL' ");        $statment->execute();
                                    $XL = $statment->rowCount();
                                    $total_row_XL += $XL; ?>
                                    <td scope="col"> <?php echo $XL;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '20 - 29' AND size = '2XL' ");        $statment->execute();
                                    $XL2 = $statment->rowCount();
                                    $total_row_2XL += $XL2; ?>
                                    <td scope="col"> <?php echo $XL2;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '20 - 29' AND size = '3XL' ");        $statment->execute();
                                    $XL3 = $statment->rowCount();
                                    $total_row_3XL += $XL3; ?>
                                    <td scope="col"> <?php echo $XL3;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '20 - 29' AND size = '4XL' ");        $statment->execute();
                                    $XL4 = $statment->rowCount();
                                    $total_row_4XL += $XL4; ?>
                                    <td scope="col"> <?php echo $XL4;?> คน</td>
                                </tr>
                                <tr>
                                    <td scope="col"> 6 </td>
                                    <td scope="col"> 10 Km. รุ่น 30 - 39</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '30 - 39' AND size = 'SSS' ");        $statment->execute();
                                    $SSS = $statment->rowCount(); 
                                    $total_row_SSS += $SSS; ?>
                                    <td scope="col"> <?php echo $SSS;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '30 - 39' AND size = 'SS' ");        $statment->execute();
                                    $SS = $statment->rowCount();
                                    $total_row_SS += $SS; ?>
                                    <td scope="col"> <?php echo $SS;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '30 - 39' AND size = 'S' ");        $statment->execute();
                                    $S = $statment->rowCount();
                                    $total_row_S += $S; ?>
                                    <td scope="col"> <?php echo $S;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '30 - 39' AND size = 'M' ");        $statment->execute();
                                    $M = $statment->rowCount();
                                    $total_row_M += $M; ?>
                                    <td scope="col"> <?php echo $M;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '30 - 39' AND size = 'L' ");        $statment->execute();
                                    $L = $statment->rowCount();
                                    $total_row_L += $L; ?>
                                    <td scope="col"> <?php echo $L;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '30 - 39' AND size = 'XL' ");        $statment->execute();
                                    $XL = $statment->rowCount();
                                    $total_row_XL += $XL; ?>
                                    <td scope="col"> <?php echo $XL;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '30 - 39' AND size = '2XL' ");        $statment->execute();
                                    $XL2 = $statment->rowCount();
                                    $total_row_2XL += $XL2; ?>
                                    <td scope="col"> <?php echo $XL2;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '30 - 39' AND size = '3XL' ");        $statment->execute();
                                    $XL3 = $statment->rowCount();
                                    $total_row_3XL += $XL3; ?>
                                    <td scope="col"> <?php echo $XL3;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '30 - 39' AND size = '4XL' ");        $statment->execute();
                                    $XL4 = $statment->rowCount();
                                    $total_row_4XL += $XL4; ?>
                                    <td scope="col"> <?php echo $XL4;?> คน</td>
                                </tr>
                                <tr>
                                    <td scope="col"> 7 </td>
                                    <td scope="col"> 10 Km. รุ่น 40 - 49</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '40 - 49' AND size = 'SSS' ");        $statment->execute();
                                    $SSS = $statment->rowCount(); 
                                    $total_row_SSS += $SSS; ?>
                                    <td scope="col"> <?php echo $SSS;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '40 - 49' AND size = 'SS' ");        $statment->execute();
                                    $SS = $statment->rowCount();
                                    $total_row_SS += $SS; ?>
                                    <td scope="col"> <?php echo $SS;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '40 - 49' AND size = 'S' ");        $statment->execute();
                                    $S = $statment->rowCount();
                                    $total_row_S += $S; ?>
                                    <td scope="col"> <?php echo $S;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '40 - 49' AND size = 'M' ");        $statment->execute();
                                    $M = $statment->rowCount();
                                    $total_row_M += $M; ?>
                                    <td scope="col"> <?php echo $M;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '40 - 49' AND size = 'L' ");        $statment->execute();
                                    $L = $statment->rowCount();
                                    $total_row_L += $L; ?>
                                    <td scope="col"> <?php echo $L;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '40 - 49' AND size = 'XL' ");        $statment->execute();
                                    $XL = $statment->rowCount();
                                    $total_row_XL += $XL; ?>
                                    <td scope="col"> <?php echo $XL;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '40 - 49' AND size = '2XL' ");        $statment->execute();
                                    $XL2 = $statment->rowCount();
                                    $total_row_2XL += $XL2; ?>
                                    <td scope="col"> <?php echo $XL2;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '40 - 49' AND size = '3XL' ");        $statment->execute();
                                    $XL3 = $statment->rowCount();
                                    $total_row_3XL += $XL3; ?>
                                    <td scope="col"> <?php echo $XL3;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '40 - 49' AND size = '4XL' ");        $statment->execute();
                                    $XL4 = $statment->rowCount();
                                    $total_row_4XL += $XL4; ?>
                                    <td scope="col"> <?php echo $XL4;?> คน</td>
                                </tr>
                                <tr>
                                    <td scope="col"> 8 </td>
                                    <td scope="col"> 10 Km. รุ่น 50 - 59</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '50 - 59' AND size = 'SSS' ");        $statment->execute();
                                    $SSS = $statment->rowCount(); 
                                    $total_row_SSS += $SSS; ?>
                                    <td scope="col"> <?php echo $SSS;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '50 - 59' AND size = 'SS' ");        $statment->execute();
                                    $SS = $statment->rowCount();
                                    $total_row_SS += $SS; ?>
                                    <td scope="col"> <?php echo $SS;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '50 - 59' AND size = 'S' ");        $statment->execute();
                                    $S = $statment->rowCount();
                                    $total_row_S += $S; ?>
                                    <td scope="col"> <?php echo $S;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '50 - 59' AND size = 'M' ");        $statment->execute();
                                    $M = $statment->rowCount();
                                    $total_row_M += $M; ?>
                                    <td scope="col"> <?php echo $M;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '50 - 59' AND size = 'L' ");        $statment->execute();
                                    $L = $statment->rowCount();
                                    $total_row_L += $L; ?>
                                    <td scope="col"> <?php echo $L;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '50 - 59' AND size = 'XL' ");        $statment->execute();
                                    $XL = $statment->rowCount();
                                    $total_row_XL += $XL; ?>
                                    <td scope="col"> <?php echo $XL;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '50 - 59' AND size = '2XL' ");        $statment->execute();
                                    $XL2 = $statment->rowCount();
                                    $total_row_2XL += $XL2; ?>
                                    <td scope="col"> <?php echo $XL2;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '50 - 59' AND size = '3XL' ");        $statment->execute();
                                    $XL3 = $statment->rowCount();
                                    $total_row_3XL += $XL3; ?>
                                    <td scope="col"> <?php echo $XL3;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '50 - 59' AND size = '4XL' ");        $statment->execute();
                                    $XL4 = $statment->rowCount();
                                    $total_row_4XL += $XL4; ?>
                                    <td scope="col"> <?php echo $XL4;?> คน</td>
                                </tr>
                                <tr>
                                    <td scope="col"> 9 </td>
                                    <td scope="col"> 10 Km. รุ่น 60 ปีขึ้นไป</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '60ปีขึ้นไป' AND size = 'SSS' ");        $statment->execute();
                                    $SSS = $statment->rowCount(); 
                                    $total_row_SSS += $SSS; ?>
                                    <td scope="col"> <?php echo $SSS;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '60ปีขึ้นไป' AND size = 'SS' ");        $statment->execute();
                                    $SS = $statment->rowCount();
                                    $total_row_SS += $SS; ?>
                                    <td scope="col"> <?php echo $SS;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '60ปีขึ้นไป' AND size = 'S' ");        $statment->execute();
                                    $S = $statment->rowCount();
                                    $total_row_S += $S; ?>
                                    <td scope="col"> <?php echo $S;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '60ปีขึ้นไป' AND size = 'M' ");        $statment->execute();
                                    $M = $statment->rowCount();
                                    $total_row_M += $M; ?>
                                    <td scope="col"> <?php echo $M;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '60ปีขึ้นไป' AND size = 'L' ");        $statment->execute();
                                    $L = $statment->rowCount();
                                    $total_row_L += $L; ?>
                                    <td scope="col"> <?php echo $L;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '60ปีขึ้นไป' AND size = 'XL' ");        $statment->execute();
                                    $XL = $statment->rowCount();
                                    $total_row_XL += $XL; ?>
                                    <td scope="col"> <?php echo $XL;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '60ปีขึ้นไป' AND size = '2XL' ");        $statment->execute();
                                    $XL2 = $statment->rowCount();
                                    $total_row_2XL += $XL2; ?>
                                    <td scope="col"> <?php echo $XL2;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '60ปีขึ้นไป' AND size = '3XL' ");        $statment->execute();
                                    $XL3 = $statment->rowCount();
                                    $total_row_3XL += $XL3; ?>
                                    <td scope="col"> <?php echo $XL3;?> คน</td>
                    <?php           $statment = $obj->getConnect()->prepare("SELECT c_id FROM contestants WHERE type = '10 Km.' AND sub_type = '60ปีขึ้นไป' AND size = '4XL' ");        $statment->execute();
                                    $XL4 = $statment->rowCount();
                                    $total_row_4XL += $XL4; ?>
                                    <td scope="col"> <?php echo $XL4;?> คน</td>
                                </tr>

                                <tr>
                                    <td colspan="2" class="text-center"><b>รวม</b></td>
                                    <td><b><?php echo $total_row_SSS;?> คน</b></td>
                                    <td><b><?php echo $total_row_SS;?> คน</b></td>
                                    <td><b><?php echo $total_row_S;?> คน</b></td>
                                    <td><b><?php echo $total_row_M;?> คน</b></td>
                                    <td><b><?php echo $total_row_L;?> คน</b></td>
                                    <td><b><?php echo $total_row_XL;?> คน</b></td>
                                    <td><b><?php echo $total_row_2XL;?> คน</b></td>
                                    <td><b><?php echo $total_row_3XL;?> คน</b></td>
                                    <td><b><?php echo $total_row_4XL;?> คน</b></td>
                                </tr>
                        </tbody>
                    </table>
                </div>

            </section>
        </div>
    </div>

    <div class="modal fade" id="showSirtContest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">รูปเสื้อ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <img src="" id="imgSirtContest" class="rounded" alt="..." width="100%;">
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
<script src="../../assets/js/adminlte.min.js"></script>

</body>
</html>
