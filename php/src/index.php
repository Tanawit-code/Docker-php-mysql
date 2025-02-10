<?php  
    # เช็คว่าการร้องขอ (Request) เป็น POST
    # เช็คว่ามีปุ่ม Submit (name="submit") ถูกกด
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    # ตั้งค่าตัวแปรสำหรับการเชื่อมต่อฐานข้อมูล
    $host = 'db';                        
    $user = 'MYSQL_USER';               
    $pass = 'MYSQL_PASSWORD';           
    $db = 'MYSQL_DATABASE';     

    # ใช้ new mysqli() เพื่อเชื่อมต่อไปยัง MySQL
    $conn = new mysqli($host, $user, $pass, $db);

    # หากเกิดข้อผิดพลาด (connect_error) ให้หยุดทำงาน (die()) และแสดงข้อความ
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    # รับค่าจากฟอร์ม
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $age = (int) $_POST['age'];

    # ป้องกัน SQL Injection
    # ป้องกันไม่ให้ผู้ใช้ใส่ '; DROP TABLE users;-- แล้วทำให้ฐานข้อมูลเสียหาย
    $first_name = $conn->real_escape_string($first_name);
    $last_name = $conn->real_escape_string($last_name);

    # คำสั่ง INSERT
    $sql_insert = "INSERT INTO users (first_name, last_name, age) VALUES ('$first_name', '$last_name', $age)";

    # ใช้ header("Location: ".$_SERVER['PHP_SELF']);
    # รีเฟรชหน้าเว็บ เพื่อป้องกันการเพิ่มข้อมูลซ้ำจากการกด Refresh
    # exit(); หยุดการทำงานหลัง header()
    if ($conn->query($sql_insert) === TRUE) {
        header("Location: ".$_SERVER['PHP_SELF']); // ใช้ header() ก่อนมี Output ใด ๆ
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <!-- <?php require_once 'nav.php'; ?> -->
     
    <?php  echo "WELCOME MY DOCKER"     ## แสดงข้อความ "WELCOME MY DOCKER" 
    ?>    

<?php

    # $host = 'db'; → กำหนด host เป็น "db" ซึ่งเป็นชื่อของ MySQL container ใน Docker
    # $user, $pass, $db → ใช้ข้อมูล environment variables ที่กำหนดใน docker-compose.yml
        $host = 'db';                       
        $user = 'MYSQL_USER';               
        $pass = 'MYSQL_PASSWORD';           
        $db = 'MYSQL_DATABASE';    
        
    # สร้างการเชื่อมต่อ MySQL โดยใช้
        $conn = new mysqli($host, $user, $pass, $db);

    # ตรวจสอบว่าการเชื่อมต่อกับ MySQL สำเร็จหรือไม่ 
    # ถ้าล้มเหลว ($conn->connect_error) ให้หยุดการทำงาน (die()) และแสดงข้อความข้อผิดพลาด 
    # ถ้าสำเร็จ จะแสดง "Connected to MySQL server successfully!"
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            echo "Connected to MySQL server successfully!";
        }
        

    # ดึงข้อมูลจากฐานข้อมูล
        $sql = "SELECT * FROM users";
        $users = [];

    # ใช้ $conn->query($sql) เพื่อรัน SQL Query
    # ถ้า Query สำเร็จ ($result ไม่เป็น false) → วนลูปดึงข้อมูลจากฐานข้อมูล
        # ถ้า fetch_object() → แปลงข้อมูลแต่ละแถวเป็น object
        # $users[] = $data; → เก็บข้อมูลลงในอาร์เรย์ $users
        if ($result = $conn->query($sql)) {                     #    
            while($data = $result->fetch_object()) {            #
                $users[] = $data;
            }
        }
    # วนลูป $users เพื่อแสดงข้อมูลที่ดึงมา
    # สร้าง <ul> และ <li> แสดงค่าจากฟิลด์ first_name, last_name, และ age
        echo "<ul>";
        foreach($users as $user) {
            echo "<li>";
            echo $user->first_name . " " . $user->last_name . " " . $user->age;
            echo "</li>";
            
        }
        echo "</ul>";
        $conn->close();
    ?>
</body>
</html>