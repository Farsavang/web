<?php
// ກວດສອບວາ່ ມກີານລ່ງົ paramater uid ມາບ່ , ຖາ້ບ່ ໃຫເ້ຕັ້ນອອກໄປຫນາ້ admin.php
if (!isset($_GET['id']) || empty($_GET['id'])) {
header('Location: ./admin.php');
exit;
}
require('dbconnect.php');
$sql = "DELETE FROM users WHERE uid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $_GET['id']);
// ຖາ້ການດາ ເນນີການສາ ເລັດ ໃຫເ້ຕັ້ນໄປຫນາ້ admin page
if ($stmt->execute()) {
header('Location: ./admin.php');
} else {
die( "Error: " . $stmt->error);
}