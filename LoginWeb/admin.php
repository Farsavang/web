<?php
// ເອີ້ນໃຊ້ການເຊື່ອມຕໍ່ຖານຂໍ້ມູນ (ກວດສອບຊື່ໄຟລ໌ໃຫ້ຖືກຕ້ອງ)
require('dbconnect.php'); 

$users = []; 

// ຄຳສັ່ງ SQL ເພື່ອດຶງຂໍ້ມູນຜູ້ໃຊ້ ແລະ Role ທີ່ກ່ຽວຂ້ອງ
// ອ້າງອີງຕາມໂຄງສ້າງຕາຕະລາງ u.role = r.rid
$sql = "SELECT u.uid, u.fullName, u.username, u.email, u.tel, r.name as roleName, u.created_at 
        FROM users as u 
        LEFT JOIN roles as r ON u.role = r.rid";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $users = $result->fetch_all(MYSQLI_ASSOC);
}

// ປິດການເຊື່ອມຕໍ່
mysqli_close($conn);
?>



<!DOCTYPE html>
<html lang="lo">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * { font-family: 'Noto Sans Lao', Arial, sans-serif; }
    </style>

</head>
<body>

<div class="container mt-5">
    <h1 class="text-center mb-4">ບໍລິການຈັດການບັນຊີຜູ້ໃຊ້</h1>
    
    <div class="d-flex justify-content-between mb-3">
        <a class="btn btn-success" href="createuser.php">+ ເພີ່ມບັນຊີໃໝ່</a>
        <a class="btn btn-outline-secondary" href="logout.php">ອອກຈາກລະບົບ</a>
    </div>

    <table class="table table-bordered table-striped shadow-sm">
        <thead class="table-dark text-center">
            <tr>
                <th>ID</th>
                <th>ຊື່ ແລະ ນາມສະກຸນ</th>
                <th>ຊື່ບັນຊີຜູ້ໃຊ້</th>
                <th>ອີເມວ</th>
                <th>ເບີໂທ</th>
                <th>ປະເພດຜູ້ໃຊ້</th>
                <th>ຈັດການ</th>
            </tr>
        </thead>
        <tbody>
            <?php if(count($users) > 0) { ?>
                <?php foreach($users as $user) { 
                    $uid = $user['uid']; // ແກ້ໄຂເຄື່ອງໝາຍ Quote ຢູ່ບ່ອນນີ້
                ?>
                <tr>
                    <td class="text-center"><?php echo $uid; ?></td>
                    <td><?php echo htmlspecialchars($user['fullName']); ?></td>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td class="text-center"><?php echo htmlspecialchars($user['tel']); ?></td>
                    <td class="text-center">
                        <span class="badge bg-info text-dark">
                            <?php echo htmlspecialchars($user['roleName'] ? $user['roleName'] : 'ບໍ່ມີກຸ່ມ'); ?>
                        </span>
                    </td>
                    <td class="text-center">
                        <a href="edituser.php?id=<?php echo $uid; ?>" class="btn btn-sm btn-primary">ແກ້ໄຂ</a>
                        <a href="deleteuser.php?id=<?php echo htmlspecialchars($user['uid'])?>"
                            class="btn btn-danger" onclick="return confirm('ຕອ້ ງການລ ບບນັຊຜີໃູ້ຊນ້ ແີ້ ທ?' ້ )">ລຶບ</a>       
                    </td>
                </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="7" class="text-center">ບໍ່ມີຂໍ້ມູນຜູ້ໃຊ້ໃນລະບົບ</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>