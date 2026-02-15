<?php
// ກວດສອບວາ່ ວທິ ີການເຂົ້າເຖງິຟາຍນເີ້ປັນແບບ post ບ່ , ຖາ້ບ່ ໃຫເ້ຕັ້ນອອກ
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
header('Location: ./admin.php');
exit;
}


if (!isset($_POST['uid']) || empty($_POST['uid']) ) {
die('Br me user');
}


$uid = $_POST['uid'] ?? '';
$fullname = $_POST['fullname'] ?? '';
$password = $_POST['password'] ?? '';
$repassword = $_POST['repassword'] ?? '';
$email = $_POST['email'] ?? '';
$tel = $_POST['tel'] ?? '';
$role = $_POST['role'] ?? 3;


if (!empty($password) && $password !== $repassword) {
die('ການດາ ເນນີການແກໄ້ຂບ່ ສາ ເລັດ ເນ່ອຼືງຈາກລະຫດັຜາ່ ນບ່ ກງົກນັ.');
}
// ເອນີ້ ໃຊກ້ ານເຊ່ອຼືມຕ່ ຖານຂ ມ້ ນ

require('dbconnect.php');
$sql = "UPDATE users SET fullname = ?, email = ?, tel = ?, role = ?

WHERE uid = ?";

// ຂະບວນການປ້ອງການ SQL injection
$stmt = $conn->prepare($sql);
$stmt->bind_param('sssii', $fullname, $email, $tel, $role, $uid);
// ຄາ ເນນີການ query ຄາ ສງັ MySQL
$stmt->execute();
// ຖາ້ການດາ ເນນີການສາ ເລັດ, ໃຫເ້ຕັ້ນໄປຫນາ້ admin page
if ($stmt->error) {
die("Error: " . $stmt->error);
}

if ($password) {
// ດາ ເນນີການແກໄ້ຂລະຫດັຜາ່ ນໃຫມ່ (ປ່ຽນລະຫດັຜາ່ ນໃຫມ)່
$sql = "UPDATE users SET password = SHA1(?) WHERE uid = ?";
// ຂະບວນການປ້ອງການ SQL injection
$stmt = $conn->prepare($sql);
$stmt->bind_param('si', $password, $uid);
// ຄາ ເນນີການ query ຄາ ສງັ MySQL
$stmt->execute();
if ($stmt->error) {
die( "Error: " . $stmt->error);
}
}
// ດາ ເນນີການສາ ເລັດ, ໃຫເ້ຕັ້ນໄປຫນາ້ admin page
header('Location: ./admin.php');