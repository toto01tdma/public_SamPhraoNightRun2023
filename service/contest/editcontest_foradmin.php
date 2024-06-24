<?php
if($_SERVER['REQUEST_METHOD'] === "POST"){

    require_once("../connect.php");
    $obj = new ConnectDatabase();
    $conn = $obj->getConnect();
    $obj->getSessionStart();

    $sql = "UPDATE `contestants` SET `name` = :name, `id_card` = :id_card, `birth_day` = :birth_day, `age` = :age, `gender` = :gender, 
                                    `nationality` = :nationality, `club` = :club, `phone` = :phone, `size` = :size WHERE `c_id` = :c_id";
    $statment = $conn->prepare($sql); // ใส่โค้ด Sql ลงไป
    $result = $statment->execute(array(
                        ":c_id" => $_POST["c_id"],
                        ":id_card" => base64_encode($_POST["id_card"]),
                        ":name" => $_POST["name"],
                        ":birth_day" => $_POST["birth_day"],
                        ":age" => $_POST["age"],
                        ":gender" => $_POST["gender"],
                        ":nationality" => $_POST["nationality"],
                        ":club" => $_POST["club"],
                        ":phone" => $_POST["phone"],
                        ":size" => $_POST["size"])); // รันคำสั่ง Sql
    if($result){
        $_SESSION["alert"] = "แก้ไขข้อมูลผู้เข้าแข่งขันสำเร็จ";
        header("location: ../../pages/report/contest.php");
    }else{
        $_SESSION["alert"] = "แก้ไขข้อมูลผู้เข้าแข่งขันไม่สำเร็จ"; 
        header("location: ../../pages/report/contest.php");
    }
}else{
    echo "No";
}
?>
