<?php
    require_once("../../service/connect.php");
    $obj = new ConnectDatabase();
    $obj->getSessionStart();

    if(!isset($_SESSION["admin"])){ 
        header("location: ../../pages/homepage/");
        exit;
    }

    $statment_nav = $obj->getConnect()->prepare("UPDATE `message_report_problem` SET `status_read` = 'true' WHERE status_read IS NULL");
    $statment_nav->execute();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/x-icon" href="../../assets/images/obt_samphrao.png">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>กล่องข้อความรายงานปัญหา</title>
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
                <div class="card shadow p-3 p-md-4 mt-4">
                    <h3 class="font-weight-bold">ข้อความรายงานปัญหา</h3>
                    <table class="table" id="list_team">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">ลำดับ</th>
                                <th scope="col">รายงานเมื่อว้นที่</th>
                                <th scope="col">หัวข้อ</th>
                                <th scope="col">เนื้อหา</th>
                                <th scope="col">ลบ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                    $index = 0;
                                    $statment = $obj->getConnect()->prepare("SELECT * FROM message_report_problem");
                                    $statment->execute();
                                    while($result = $statment->fetch(PDO::FETCH_ASSOC)){ 
                                        $index += 1; ?>
                                        <tr>
                                            <td scope="col" class="text-center"> <?php echo $index;?> </td>
                                            <td scope="col" class="text-center"> <?php echo $result["date_report"];?> </td>
                                            <td scope="col"> <?php echo $result["head_mes"];?> </td>
                                            <td scope="col"> <?php echo $result["content_mes"];?> </td>
                                            <td scope="col" class="text-center"> 
                                                <a href="#" onclick="delete_message('<?php echo $result['id_mes'];?>');" class="btn btn-danger">ลบ</a> 
                                            </td>
                                        </tr>
                            <?php   } ?>
                        </tbody>
                    </table>
                </div>

            </section>
        </div>
    </div>

<!-- scripts -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>

<script>
    function delete_message(id_mes){
        Swal.fire({
            text: "แน่ใจว่าจะลบข้อความนี้",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ลบเลย',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({  
                    type: "POST",  
                    url: "../../service/report_messages/delete.php",
                    data: { id_mes: id_mes }
                }).done(function() {
                    Swal.fire({
                        text: 'ลบเรียบร้อย',
                        icon: 'success',
                        confirmButtonText: 'ตกลง',
                    }).then((result) => {
                            location.reload();
                    });
                }).fail(function() {
                    Swal.fire({
                        text: 'ลบไม่สำเร็จ',
                        icon: 'error',
                        confirmButtonText: 'ตกลง',
                    }).then((result) => {
                        location.reload();
                    });
                })
            }
        })
    }
</script>

</body>
</html>
