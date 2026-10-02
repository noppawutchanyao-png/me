<?php
require_once 'db.php';

// ตรวจสอบการส่งค่าจากฟอร์ม HTML
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $user = trim($_POST['user'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (!empty($user) && !empty($password)) {

        // ตรวจสอบข้อมูลในตาราง admin
        $stmt = $conn->prepare("SELECT * FROM admin WHERE user = ? AND password = ?");
        $stmt->bind_param("ss", $user, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            
            // บันทึก Session เมื่อเข้าสู่ระบบสำเร็จ
            $_SESSION['admin_user'] = $row['user'];

            echo "<script>
                    alert('เข้าสู่ระบบสำเร็จ!');
                    window.location.href = 'index.php';
                  </script>";
            exit();
        } else {
            echo "<script>
                    alert('User หรือ Password ไม่ถูกต้อง!');
                    window.history.back();
                  </script>";
            exit();
        }

        $stmt->close();
    } else {
        echo "<script>
                alert('กรุณากรอกข้อมูลให้ครบถ้วน!');
                window.history.back();
              </script>";
        exit();
    }
}

$conn->close();
?>