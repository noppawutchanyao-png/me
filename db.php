<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ตั้งค่าการเชื่อมต่อฐานข้อมูล XAMPP
$servername  = "localhost";
$username_db = "root";   // Default ของ XAMPP
$password_db = "";       // Default ของ XAMPP (ค่าว่าง)
$dbname      = "me";     // ชื่อฐานข้อมูลตาม me.sql

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("เชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error);
}

// ตั้งค่ารองรับภาษาไทย
$conn->set_charset("utf8mb4");
?>