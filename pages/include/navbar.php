<?php 
    require_once("../../service/getText/index.php");
    require_once("../../service/connect.php");
    $obj_nav = new ConnectDatabase();
    
    $statment_nav = $obj_nav->getConnect()->prepare("SELECT id_mes FROM message_report_problem WHERE status_read IS NULL");
    $statment_nav->execute();
    $count_nav = $statment_nav->rowCount();

    if($count_nav > 0){
        $count_report_message = "<span style='background-color:red; padding:0.5px 6px; border-radius:10px; color:white;'>".$count_nav."</span>";
    }else{
        $count_report_message = "";
    }
?>

    <img src="../../assets/images/background_web.jpg" alt="" style="position:fixed;" width="100%" height="100%">
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="position:fixed; z-index:99; width:100%;">
        <?php   if(isset($_SESSION["admin"])){ ?>
                    <a class="navbar-brand" style="color:#4FE400 !important;" href="#">ชื่อผู้ดูแล : <?php echo $_SESSION["admin"]["name"];?></a>
        <?php   }else{ ?>
                    <a class="navbar-brand" href="#">สามพร้าวไนท์รัน 2023</a>
        <?php   } ?>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="../../pages/homepage/">หน้าหลัก <span class="sr-only">(current)</span></a>
                </li>
                <?php   if(!isset($_SESSION["admin"])){ ?>
                    <li class="nav-item mr-2" style="background-color:#007bff; border-radius:5px; padding:0px 5px;">
                        <a class="nav-link" style="color:white;" href="../../pages/check_approve/">ตรวจสอบการอนุมัติการเข้าแข่งขัน</a>
                    </li>
                    <li class="nav-item mr-2" style="background-color:red; border-radius:5px; padding:0px 5px;">
                        <div type="button" class="nav-link" style="cursor:pointer; color:white;" data-toggle="modal" data-target="#information_nav">
                            กำหนดการจัดกิจกรรม
                        </div>
                    </li>
                    <li class="nav-item mr-2" style="background-color:green; border-radius:5px; padding:0px 5px;">
                        <a class="nav-link" style="color:white;" href="../../pages/register/">ลงทะเบียนวิ่งสามพร้าวไนท์รัน</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            การจัดการแข่งขัน
                        </a>
                        <div class="dropdown-menu text-center" aria-labelledby="navbarDropdownMenuLink">
                            <div type="button" class="nav-link" style="color:black; cursor:pointer;" data-toggle="modal" data-target="#showRules">
                                กติกาการแข่งขัน
                            </div>
                            <div type="button" class="nav-link" style="color:black; cursor:pointer;" data-toggle="modal" data-target="#showObjective">
                                วัตถุประสงค์
                            </div>
                            <div type="button" class="nav-link" style="color:black; cursor:pointer;" data-toggle="modal" data-target="#contestsAndPrizes">
                                ประเภทการจัดการแข่งขันและรางวัล
                            </div>
                            <div type="button" class="nav-link" style="color:black; cursor:pointer;" data-toggle="modal" data-target="#reward">
                                ถ้วยรางวัล
                            </div>
                            <div type="button" class="nav-link" style="color:black; cursor:pointer;" data-toggle="modal" data-target="#barContactNumber">
                                ติดต่อสอบถาม
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#showSendReportMessage">รายงานปัญหา</a>
                    </li>
                <?php   }else{ ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../../pages/read_report_message/">อ่านปัญหา <?php echo $count_report_message;?></a>
                    </li>
                <?php   } ?>
                <?php   if(isset($_SESSION["admin"])){ ?>
                            <li class="nav-item">
                                <a class="nav-link" href="../../pages/report/contest.php">ดูรายชื่อผู้เข้าแข่งขัน</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../../pages/report/approve.php">อนุมัติผู้ลงทะเบียนเข้าแข่งขัน</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../../pages/report/countcontest.php">ตารางแสดงจำนวนยอด</a>
                            </li>
                            <?php   if($_SESSION["admin"]["level"] == "1"){ ?>
                                        <a class="nav-link" href="../../pages/manager_admin/create.php">เพิ่มผู้ดูแล</a>
                                        <a class="nav-link" href="../../pages/manager_admin/">ดูรายชื่อผู้ดูแล</a>
                            <?php   } ?>
                <?php   } ?>
                <?php   if(!isset($_SESSION["admin"])){ ?>
                            <li class="nav-item">
                                <a class="nav-link" href="../../pages/login_for_admin/">เข้าสู่ระบบ (สำหรับผู้จัดงาน)</a>
                            </li>
                <?php   }else{ ?>
                            <li class="nav-item" style="background-color:#C33B00; border-radius:5px; padding:0px 5px;">
                                <a class="nav-link" style="color:white;" href="../../service/auth/logout.php">ออกจากระบบ (สำหรับผู้จัดงาน)</a>
                            </li>
                <?php   } ?>
            </ul>
        </div>
    </nav>

    <div class="modal fade" id="reward" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><b>ถ้วยรางวัล</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="embed-responsive embed-responsive-16by9 mb-3 shadow">
                        <iframe class="embed-responsive-item" src="../../assets/images/video_reward.mp4" allowfullscreen></iframe>
                    </div>
                    <img src="../../assets/images/img_reward1.jpg" class="shadow rounded mx-auto d-block mb-3 w-50" alt="...">
                    <img src="../../assets/images/img_reward2.jpg" class="shadow rounded mx-auto d-block mb-3 w-50" alt="...">
                    <img src="../../assets/images/img_reward3.jpg" class="shadow rounded mx-auto d-block mb-3 w-50" alt="...">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิดหน้านี้</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="information_nav" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><b>กำหนดการจัดกิจกรรม</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="modal-body" style="height:30rem;">
                    <?php getInformation(); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิดหน้านี้</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="showRules" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">กติกาการแข่งขัน</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php getCompetitionRules(); ?>
                    <div class="text-center">
                        <img src="../../assets/images/uigfnuf.png" class="rounded" alt="..." width="50%;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิดหน้านี้</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="showObjective" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">วัตถุประสงค์</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="modal-body" style="height:30rem;">
                    <?php getObjective(); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิดหน้านี้</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="barContactNumber" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">เบอร์ติดต่อสอบถาม</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="modal-body" style="height:30rem;">
                    <?php getContactNumber(); ?>
                    <br>
                    <br>
                    <br>
                    <div class="text-center">
                        <img src="../../assets/images/rgvergergergvre.png" class="rounded" alt="..." width="20%;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิดหน้านี้</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="contestsAndPrizes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">ประเภทการจัดการแข่งขันและรางวัล</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead class="thead-dark text-center">
                            <tr>
                                <th scope="col">ระยะทาง<br>Race</th>
                                <th scope="col">รุ่นอายุชาย<br>Male Age</th>
                                <th scope="col">รุ่นอายุหญิง<br>Famale Age</th>
                                <th scope="col">ค่าสมัคร</th>
                                <th scope="col">เงินรางวัล (ตามอันดับ)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th rowspan="2"> 5 Km.</th>
                                <td>ไม่เกิน 13 ปี</td>
                                <td>ไม่เกิน 13 ปี</td>
                                <td>ฟรี</td>
                                <td>1,000/500/300</td>
                            </tr>
                            <tr>
                                <td>13 ปีขึ้นไป</td>
                                <td>13 ปีขึ้นไป</td>
                                <td>300</td>
                                <td>1,000/500/300</td>
                            </tr>
                            <tr>
                                <th rowspan="7">10 Km.</th>
                                <td>ไม่เกิน 12 ปี</td>
                                <td>ไม่เกิน 12 ปี</td>
                                <td>ฟรี</td>
                                <td>1,000/500/300</td>
                            </tr>
                            <tr>
                                <td>13 - 19 ปี</td>
                                <td>13 - 19 ปี</td>
                                <td>500</td>
                                <td>1,000/500/300</td>
                            </tr>
                            <tr>
                                <td>20 - 29 ปี</td>
                                <td>20 - 29 ปี</td>
                                <td>500</td>
                                <td>1,000/500/300</td>
                            </tr>
                            <tr>
                                <td>30 - 39 ปี</td>
                                <td>30 - 39 ปี</td>
                                <td>500</td>
                                <td>1,000/500/300</td>
                            </tr>
                            <tr>
                                <td>40 - 49 ปี</td>
                                <td>40 - 49 ปี</td>
                                <td>500</td>
                                <td>1,000/500/300</td>
                            </tr>
                            <tr>
                                <td>50 - 59 ปี</td>
                                <td>50 - 59 ปี</td>
                                <td>500</td>
                                <td>1,000/500/300</td>
                            </tr>
                            <tr>
                                <td>60 ปีขึ้นไป</td>
                                <td>60 ปีขึ้นไป</td>
                                <td>500</td>
                                <td>1,000/500/300</td>
                            </tr>
                            <tr>
                                <td colspan="5"><b>มีรางวัล Overall 1000 บาท <br> ระยะ <span style="color:green;">5 Km</span>/<span style="color:red;">10 Km</span> (ชาย/หญิง)</b></td>
                            </tr>
                            <tr>
                                <td colspan="5"><b>รางวัล<span style="color:#DA52FF;">แฟนซี</span> 1000/500/300</b></td>
                            </tr>
                            <tr>
                                <td colspan="5"><b>รางวัลวิ่งชุมชน <span style="color:#FEB500;">(รับถ้วยรางวัล)</span></b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิดหน้านี้</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="showSendReportMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">รายงานปัญหา</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text px-2">หัวข้อปัญหา</div>
                            </div>
                            <input type="text" class="form-control" name="head_problem" id="head_problem" value="" placeholder="ระบุหัวข้อปัญหา" maxlength="100" required>
                        </div>
                        <p id="alertErrorHeadTextProblem" style="color:red;"></p>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">ระบุปัญหา</span>
                            </div>
                            <textarea class="form-control" aria-label="With textarea" name="text_problem" id="text_problem" placeholder="ระบุปัญหา" maxlength="254" required></textarea>
                        </div>
                        <p id="alertErrorTextProblem" style="color:red;"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="btn_submit" onclick="checkFormProblem();">รายงานปัญหา</button>
                    <button class="btn btn-secondary" data-dismiss="modal">ปิดหน้านี้</button>
                </div>
            </div>
        </div>
    </div>

    <?php 
        if(isset($_SESSION["alert"])){ 
            echo " <script> alert(' ".$_SESSION["alert"]." '); </script>";
            unset($_SESSION["alert"]);
        }
    ?>

    <script>
        function checkFormProblem(){
            let headProblem = document.getElementById("head_problem").value;
            let textProblem = document.getElementById("text_problem").value;

            let notErrorTextProblem = true;
            if(headProblem == ""){
                notErrorTextProblem = false;
                document.getElementById("alertErrorHeadTextProblem").innerHTML = "** ระบุหัวข้อปัญหา **";
            }else{
                document.getElementById("alertErrorHeadTextProblem").innerHTML = "";
            }

            if(textProblem == ""){
                notErrorTextProblem = false;
                document.getElementById("alertErrorTextProblem").innerHTML = "** ระบุปัญหา **";
            }else{
                document.getElementById("alertErrorTextProblem").innerHTML = "";
            }

            if(notErrorTextProblem) {
                $.ajax({  
                    type: "POST",  
                    url: "../../service/report_messages/create.php",
                    data: { head_problem: headProblem,
                            text_problem: textProblem }
                }).done(function() {
                    Swal.fire({
                        text: 'รายงานปัญหาเรียบร้อย',
                        icon: 'success',
                        confirmButtonText: 'ตกลง',
                    }).then((result) => {
                        location.reload();
                    });
                }).fail(function() {
                    Swal.fire({
                        text: 'รายงานปัญหาไม่สำเร็จ',
                        icon: 'error',
                        confirmButtonText: 'ตกลง',
                    }).then((result) => {
                        location.reload();
                    });
                })
            }
        }
    </script>