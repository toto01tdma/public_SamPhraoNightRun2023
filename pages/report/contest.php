<?php
    require_once("../../service/connect.php");
    $obj = new ConnectDatabase();
    $obj->getSessionStart();

    if(!isset($_SESSION["admin"])){ 
        header("location: ../../pages/homepage/");
        exit;
    }

    $condition = "";
    $head_text = "ทั้งหมด";
    $return_to_page = "../../pages/homepage/";

    if(isset($_GET["condition"])){
        $condition = "WHERE name LIKE '%".$_GET["condition"]."%' ";
        $head_text = "ที่ค้นหา";
    }else if(isset($_GET["cg_id"])){
        $condition = "WHERE cg_id = '".$_GET["cg_id"]."' ";
        $head_text = " ของหมายเลขกลุ่ม '".$_GET["cg_id"]."' ";
        $return_to_page = "../../pages/report/approve.php";
    }else if(isset($_GET["gender"])){
        if($_GET["gender"] == "male"){
            $condition = "WHERE gender = 'ชาย' ";
            $head_text = " เพศชาย";
        }else{
            $condition = "WHERE gender = 'หญิง' ";
            $head_text = " เพศหญิง";
        }
    }else if(isset($_GET["approve"])){
        if($_GET["approve"] == "true"){
            $condition = "WHERE status_approve = 'true' ";
            $head_text = " ที่ผ่านการอนุมัติ";            
        }else if($_GET["approve"] == "wait"){
            $condition = "WHERE status_approve IS NULL OR status_approve = '' ";
            $head_text = " ที่รออนุมัติ";   
        }else if($_GET["approve"] == "false"){
            $condition = "WHERE status_approve = 'false' ";
            $head_text = " ที่ไม่ผ่านการอนุมัติ";   
        }
    }else if(isset($_GET["type"])){
        $head_text = " ประเภทวิ่ง ".$_GET["type"];
        $condition = "WHERE type = '".$_GET["type"]."' "; 
    }else if(isset($_GET["type_nosirt"])){
        $head_text = " ประเภท ".$_GET["type_nosirt"]." (ไม่รับเสื้อ)";
        $condition = "WHERE type = '".$_GET["type_nosirt"]."' AND (type_sirt = '' OR type_sirt IS NULL)";
    }else if(isset($_GET["type_havesirt"])){
        $head_text = " ประเภท ".$_GET["type_havesirt"]." (รับเสื้อ)";
        $condition = "WHERE type = '".$_GET["type_havesirt"]."' AND type_sirt <> '' ";
    }else if(isset($_GET["size"])){
        $head_text = " ที่เลือกเสื้อไซส์ ".$_GET["size"];
        $condition = "WHERE size = '".$_GET["size"]."' ";
    }else if(isset($_GET["sub_type"])){
        $head_text = " รุ่น ".$_GET["sub_type"];
        $condition = "WHERE sub_type = '".$_GET["sub_type"]."' ";
    }
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
                <a href="<?php echo $return_to_page;?>" class="btn btn-info mt-3 shadow">&#10094;&#10094;&#10094; ย้อนกลับ</a>
                <br>
                <br>
                <form action="contest.php" method="get">
                    <div class="col-md-8 px-1 px-md-5">
                        <div class="input-group">
                            <input type="text" class="form-control" name="condition" maxlength="60" id="" value="" placeholder="ระบุเพื่อค้นหา" require>
                            <div class="input-group-prepend">
                                <button type="submit" class="input-group-text px-5" style="border-radius:0px 5px 5px 0px; background-color:#28a745; color:white;">ค้นหา</button>
                            </div>
                        </div>
                    </div>
                </form>
                <a href="contest.php" class="btn btn-dark mt-3 shadow">ดูรายชื่อผู้เข้าแข่งขันทั้งหมด</a>
                <br>
                <a href="contest.php?gender=male" class="btn btn-dark mt-3 shadow">ผู้เข้าแข่งขันเพศชาย</a>
                <a href="contest.php?gender=female" class="btn btn-dark mt-3 shadow">ผู้เข้าแข่งขันเพศหญิง</a>
                <a href="contest.php?approve=true" class="btn btn-success mt-3 shadow">ผู้เข้าแข่งขันที่อนุมัติแล้ว</a>
                <a href="contest.php?approve=wait" class="btn btn-info mt-3 shadow">ผู้เข้าแข่งขันที่รออนุมัติ</a>
                <a href="contest.php?approve=false" class="btn btn-danger mt-3 shadow">ผู้เข้าแข่งขันที่ไม่ผ่านอนุมัติ</a>
                <br>
                <a href="contest.php?type=5 Km." class="btn btn-primary mt-3 shadow">ประเภทวิ่ง 5 Km. (ทั้งหมด)</a>
                <a href="contest.php?type=10 Km." class="btn btn-primary mt-3 shadow">ประเภทวิ่ง 10 Km. (ทั้งหมด)</a>
                <br>
                <a href="contest.php?type_nosirt=5 Km." class="btn btn-light mt-3 shadow">ประเภทวิ่ง 5 Km. (ไม่ได้รับเสื้อ)</a>
                <a href="contest.php?type_nosirt=10 Km." class="btn btn-light mt-3 shadow">ประเภทวิ่ง 10 Km. (ไม่ได้รับเสื้อ)</a>
                <a href="contest.php?type_havesirt=5 Km." class="btn btn-dark mt-3 shadow">ประเภทวิ่ง 5 Km. (ได้รับเสื้อ)</a>
                <a href="contest.php?type_havesirt=10 Km." class="btn btn-dark mt-3 shadow">ประเภทวิ่ง 10 Km. (ได้รับเสื้อ)</a>
                <br>
                <a href="contest.php?size=SSS" class="btn btn-primary mt-3 shadow">เสื้อไซส์ SSS</a>
                <a href="contest.php?size=SS" class="btn btn-primary mt-3 shadow">เสื้อไซส์ SS</a>
                <a href="contest.php?size=S" class="btn btn-primary mt-3 shadow">เสื้อไซส์ S</a>
                <a href="contest.php?size=M" class="btn btn-primary mt-3 shadow">เสื้อไซส์ M</a>
                <a href="contest.php?size=L" class="btn btn-primary mt-3 shadow">เสื้อไซส์ L</a>
                <a href="contest.php?size=XL" class="btn btn-primary mt-3 shadow">เสื้อไซส์ XL</a>
                <a href="contest.php?size=2XL" class="btn btn-primary mt-3 shadow">เสื้อไซส์ 2XL</a>
                <a href="contest.php?size=3XL" class="btn btn-primary mt-3 shadow">เสื้อไซส์ 3XL</a>
                <a href="contest.php?size=4XL" class="btn btn-primary mt-3 shadow">เสื้อไซส์ 4XL</a>
                <br>
                <a href="contest.php?sub_type=ไม่เกิน13ปี" class="btn btn-info mt-3 shadow">ไม่เกิน13ปี</a>
                <a href="contest.php?sub_type=13ปีขึ้นไป" class="btn btn-info mt-3 shadow">13ปีขึ้นไป (5Km.)</a>
                <a href="contest.php?sub_type=13 - 19" class="btn btn-info mt-3 shadow">13 - 19</a>
                <a href="contest.php?sub_type=20 - 29" class="btn btn-info mt-3 shadow">20 - 29</a>
                <a href="contest.php?sub_type=30 - 39" class="btn btn-info mt-3 shadow">30 - 39</a>
                <a href="contest.php?sub_type=40 - 49" class="btn btn-info mt-3 shadow">40 - 49</a>
                <a href="contest.php?sub_type=50 - 59" class="btn btn-info mt-3 shadow">50 - 59</a>
                <a href="contest.php?sub_type=60ปีขึ้นไป" class="btn btn-info mt-3 shadow">60ปีขึ้นไป (10Km.)</a>
                <div class="card shadow p-3 p-md-4 mt-4" style="overflow-x:auto;">
                    <h3 class="font-weight-bold">รายชื่อผู้ลงทะเบียนเข้าแข่งขัน<?php echo $head_text;?> <span style="color:green;" id="getNumberContest"></span></h3>
                    <h6 class="">ในกรณีที่ผู้เข้าแข่งขัน <span style="color:red; font-weight:bold;">ไม่ผ่านการอนุมัติ</span> จะต้อง<span style="color:green; font-weight:bold;">รอ</span>ให้ผู้เข้าแข่งขันแนบหลักฐานการชำระเงินอีกครั้ง เพื่อให้ผู้ดูแล<span style="color:blue; font-weight:bold;">อนุมัติอีกรอบ</span></h6>
                    <table class="table" id="list_team" style="border-collapse: collapse; border-spacing: 0; width: 100%; border: 1px solid #ddd;">
                        <thead>
                            <tr>
                                <th scope="col">สถานะการอนุมัติ</th>
                                <th scope="col">ชื่อ-สกุล</th>
                                <th scope="col">เลขบัตรประจำตัวประชาชน</th>
                                <th scope="col">วันเกิด</th>
                                <th scope="col">อายุ</th>
                                <th scope="col">เพศ</th>
                                <th scope="col">สัญชาติ</th>
                                <th scope="col">ชมรม</th>
                                <th scope="col">เบอร์โทรศัพท์</th>
                                <th scope="col">ไซส์เสื้อผ้า</th>
                                <th scope="col">ประเภทวิ่ง</th>
                                <th scope="col">แบบเสื้อ</th>
                                <th scope="col">ขนาดอายุ</th>
                                <th scope="col">การจัดส่ง</th>
                                <th scope="col">ที่อยู่</th>
                                <th scope="col">ค่าชำระ</th>
                                <th scope="col">หลักฐานการชำระเงิน</th>
                                <th scope="col">แก้ไข</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                    $statment = $obj->getConnect()->prepare("SELECT * FROM contestants $condition ORDER BY status_approve ASC");
                                    $statment->execute();
                                    $total_price = 0;
                                    $total_people = 0;
                                    while($result = $statment->fetch(PDO::FETCH_ASSOC)){ ?>
                                        <tr>
                                            <?php if($result["status_approve"] == ""){ ?>
                                                    <td scope="col" style="font-weight:bold;">
                                                        <a href="../../pages/report/approve.php" class="btn btn-info">รออนุมัติ</a> 
                                                    </td>
                                            <?php }else if($result["status_approve"] == "false"){ ?>
                                                    <td scope="col" style="color:red; font-weight:bold;">
                                                        ไม่ผ่าน
                                                    </td>                                                    
                                            <?php }else if($result["status_approve"] == "true"){ ?>
                                                    <td scope="col" style="color:green; font-weight:bold;"> ผ่าน </td>
                                            <?php } ?>
                                            <td scope="col"> <?php echo $result["name"];?> </td>
                                            <td scope="col"> <?php echo base64_decode($result["id_card"]);?> </td>
                                            <td scope="col"> <?php echo $result["birth_day"];?> </td>
                                            <td scope="col"> <?php echo $result["age"];?> </td>
                                            <td scope="col"> <?php echo $result["gender"];?> </td>
                                            <td scope="col"> <?php echo $result["nationality"];?> </td>
                                            <td scope="col"> <?php echo $result["club"];?> </td>
                                            <td scope="col"> <?php echo $result["phone"];?> </td>
                                            <td scope="col"> <?php echo $result["size"];?> </td>
                                            <td scope="col"> <?php echo $result["type"];?> </td>
                                            <td scope="col">
                                                <a href="#" onclick="activeSirtContest('<?php echo $result['type_sirt'];?>');" data-toggle="modal" data-target="#showSirtContest">
                                                    <img src="../../assets/images/<?php echo $result["type_sirt"];?>" width="100%" alt="">
                                                </a>
                                            </td>
                                            <td scope="col"> <?php echo $result["sub_type"];?> </td>
                                            <?php if($result["delivery"] == "Ok"){ ?>
                                                <td scope="col"><span style="color:green; font-weight:bold;"><?php echo $result["delivery"];?></span></td>
                                            <?php }else if($result["delivery"] == "No"){ ?>
                                                <td scope="col"><span style="color:red; font-weight:bold;"><?php echo $result["delivery"];?></span></td>
                                            <?php }else{ ?>
                                                <td scope="col"><span style="color:black; font-weight:bold;"><?php echo $result["delivery"];?></span></td>
                                            <?php } ?>
                                            <td scope="col"> <?php echo $result["address"];?> </td>
                                            <?php   if($result["delivery"] == "Ok"){ ?>
                                                        <td scope="col"> <?php echo $result["price"];?> + ค่าจัดส่ง 50 บาท</td>
                                            <?php       $result["price"] += 50;
                                                    }else{ ?>
                                                        <td scope="col"> <?php echo $result["price"];?> </td>
                                            <?php   } ?>
                                            <td scope="col"> <a href="showslip.php?cg_id=<?php echo $result["cg_id"];?>&re_to=contest" class="btn btn-info">ดูหลักฐานการชำระเงินทั้งหมด</a> </td>
                                            <td scope="col" class="text-center"> 
                                                <a href="../register/editcontest_foradmin.php?c_id=<?php echo $result["c_id"];?>" class="btn btn-warning">แก้ไข</a> 
                                            </td>
                                        </tr>
                            <?php   $total_price += $result["price"];
                                    $total_people += 1;
                                    } ?>
                                    <tr style="font-size:140%;">
                                        <td scope="col" colspan="11" class="text-center" ><b>รวม</b></td>
                                        <td scope="col" colspan="4" class="text-center" ><b><?php echo $total_people;?> คน</b></td>
                                        <td scope="col" colspan="2"><b><?php echo $total_price;?> บาท</b></td>
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
<script>
    function activeSirtContest(srt){
        document.getElementById("imgSirtContest").setAttribute("src", "../../assets/images/"+srt)
    }

    document.getElementById("getNumberContest").innerHTML = "(<?php echo $total_people;?> คน)";
</script>

</body>
</html>
