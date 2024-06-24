<?php
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        /* Location */
        $imageFileType = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION); // อ่านนามสกุลของไฟล์ที่ส่งมาไฟล์
        $imageFileType = strtolower($imageFileType);
        
        /* Valid extensions */
        $valid_extensions = array("jpg", "jpeg", "png", "gif", "jfif");
        
        /* Check file extension */
        if(in_array(strtolower($imageFileType), $valid_extensions)) {
            http_response_code(200); // 200 คือ Success สำเร็จ
            echo json_encode(array('status' => true, 'message' => 'file is Yes'));            
        }else{
            http_response_code(401); // 401 คือ Unauthorized ไม่มีสิทธิ
            echo json_encode(array('status' => false, 'message' => 'file is No'));            
        }
    }
?>