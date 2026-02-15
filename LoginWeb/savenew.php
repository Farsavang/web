<?php
include('dbconnect.php'); // ກວດສອບຊື່ໄຟລ໌ເຊື່ອມຕໍ່ໃຫ້ຖືກຕ້ອງ

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ຮັບຄ່າຈາກຟອມ ແລະ ປ້ອງກັນ SQL Injection
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $tel      = mysqli_real_escape_string($conn, $_POST['tel']);
    $role     = mysqli_real_escape_string($conn, $_POST['role']);

    // 1. ກວດສອບວ່າລະຫັດຜ່ານກົງກັນຫຼືບໍ່
    if ($password !== $repassword) {
        echo "<script>alert('ລະຫັດຜ່ານບໍ່ກົງກັນ!'); window.history.back();</script>";
        exit();
    }

    // 2. ກວດສອບຊື່ຜູ້ໃຊ້ຊ້ຳ
    $check_query = "SELECT username FROM users WHERE username = '$username'";
    $check_result = mysqli_query($conn, $check_query);
    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('ຊື່ຜູ້ໃຊ້ນີ້ມີໃນລະບົບແລ້ວ!'); window.history.back();</script>";
        exit();
    }

    // 3. ເຂົ້າລະຫັດຜ່ານ SHA-256 (ໃຫ້ໄດ້ 64 ຕົວອັກສອນຕາມຖານຂໍ້ມູນ)
    $hashed_password = hash('sha256', $password);

    // 4. ເພີ່ມຂໍ້ມູນ (ໝາຍເຫດ: ໃຊ້ຄໍລຳ passoword ຕາມຮູບພາບ)
    $sql = "INSERT INTO users (fullName, username, passoword, email, tel, role, created_at, modified_at) 
            VALUES ('$fullname', '$username', '$hashed_password', '$email', '$tel', '$role', NOW(), NOW())";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('ບັນທຶກຂໍ້ມູນສຳເລັດ!'); window.location='admin.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>