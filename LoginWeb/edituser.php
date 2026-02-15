<?php
// ກວດສອບ Parameter ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: admin.php');
    exit;
}

require('dbconnect.php'); // ກວດສອບຊື່ໄຟລ໌ໃຫ້ຖືກຕ້ອງ (dbconnect.php ຫຼື config.php)

$user = null; 
$uid_param = $_GET['id'];

// ໃຊ້ Prepared Statement ເພື່ອຄວາມປອດໄພ
$sql = "SELECT uid, fullName, username, email, tel, role FROM users WHERE uid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $uid_param);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "<script>alert('ບໍ່ພົບຂໍ້ມູນຜູ້ໃຊ້!'); window.location='admin.php';</script>";
    exit;
}
?>

<!-- <!DOCTYPE html>
<html lang="lo">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * { font-family: 'Noto Sans Lao', Arial, sans-serif; }
        @media (min-width: 768px) { .card { width: 50% !important; } }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="card shadow p-4 mx-auto my-3">
        <h1 class="text-center mb-4">ແກ້ໄຂບັນຊີຜູ້ໃຊ້</h1>
        <form id="editUserForm" action="updateuser.php" method="post">
            <input type="hidden" name="uid" value="<?php echo $user['uid']; ?>">
            
            <div class="mb-3">
                <label class="form-label">ຊື່ ແລະ ນາມສະກຸນ <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="fullname" required 
                       value="<?php echo htmlspecialchars($user['fullName']); ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">ຊື່ບັນຊີຜູ້ໃຊ້ (ບໍ່ສາມາດແກ້ໄຂໄດ້)</label>
                <input type="text" class="form-control" readonly 
                       value="<?php echo htmlspecialchars($user['username']); ?>">
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="changePassword">
                <label class="form-check-label text-danger" for="changePassword">ປ່ຽນລະຫັດຜ່ານ</label>
            </div>

            <div class="d-none" id="passSection">
                <div class="mb-3">
                    <label class="form-label">ລະຫັດຜ່ານໃໝ່</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div class="mb-3">
                    <label class="form-label">ຢືນຢັນລະຫັດຜ່ານໃໝ່</label>
                    <input type="password" class="form-control" name="repassword" id="repassword">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">ອີເມວ <span class="text-danger">*</span></label>
                <input type="email" class="form-control" name="email" required 
                       value="<?php echo htmlspecialchars($user['email']); ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">ເບີໂທ</label>
                <input type="tel" class="form-control" name="tel" 
                       value="<?php echo htmlspecialchars($user['tel']); ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">ປະເພດຜູ້ໃຊ້</label>
                <select class="form-select" name="role" required>
                    <option value="3" <?php echo ($user['role'] == 3) ? 'selected' : ''; ?>>Customer</option>
                    <option value="2" <?php echo ($user['role'] == 2) ? 'selected' : ''; ?>>Staff</option>
                    <option value="1" <?php echo ($user['role'] == 1) ? 'selected' : ''; ?>>Administrator</option>
                </select>
            </div>

            <div class="mt-4 text-center">
                <button type="submit" class="btn btn-primary">ບັນທຶກການແກ້ໄຂ</button>
                <a href="admin.php" class="btn btn-secondary">ຍົກເລີກ</a>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $("#changePassword").change(function() {
        if($(this).is(":checked")) {
            $("#passSection").removeClass("d-none");
            $("#password, #repassword").attr("required", true);
        } else {
            $("#passSection").addClass("d-none");
            $("#password, #repassword").val("").attr("required", false);
        }
    });
});
</script>
</body>
</html> -->

<!DOCTYPE html>
<html lang="lo">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - Modern Style</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Lao:wght@300;400;700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <style>
        :root {
            --edit-gradient: linear-gradient(135deg, #FF8C00 0%, #F83600 100%); /* ສີສົ້ມ-ແດງ ສື່ເຖິງການ Edit */
            --bg-color: #f4f7f6;
        }

        body {
            font-family: 'Noto Sans Lao', 'Poppins', sans-serif;
            background: var(--bg-color);
            background-image: radial-gradient(circle at 50% 50%, #ffffff 0%, #e1e8ed 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .card {
            border: none;
            border-radius: 24px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
            border: 1px solid rgba(255,255,255,0.3);
        }

        .header-icon {
            width: 70px;
            height: 70px;
            background: var(--edit-gradient);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            margin: -35px auto 20px;
            box-shadow: 0 10px 20px rgba(248, 54, 0, 0.3);
        }

        h1 {
            font-weight: 700;
            color: #333;
            font-size: 1.8rem;
        }

        .form-label {
            font-weight: 600;
            color: #4a5568;
            font-size: 0.9rem;
        }

        .form-control, .form-select {
            border-radius: 12px;
            padding: 12px 16px;
            border: 1.5px solid #edf2f7;
            background: #f8fafc;
            transition: all 0.3s;
        }

        .form-control:focus {
            background: #fff;
            border-color: #F83600;
            box-shadow: 0 0 0 4px rgba(248, 54, 0, 0.1);
        }

        .form-control[readonly] {
            background-color: #e2e8f0;
            cursor: not-allowed;
            color: #718096;
        }

        /* ລູກເລ່ນ Switch ປ່ຽນລະຫັດຜ່ານ */
        .form-check-input:checked {
            background-color: #F83600;
            border-color: #F83600;
        }

        #passSection {
            background: #fff5f2;
            padding: 20px;
            border-radius: 15px;
            border: 1px dashed #F83600;
            margin-top: 15px;
        }

        .btn-update {
            background: var(--edit-gradient);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 12px 35px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-update:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(248, 54, 0, 0.3);
            color: white;
        }

        .btn-cancel {
            background: #edf2f7;
            color: #4a5568;
            border: none;
            border-radius: 12px;
            padding: 12px 35px;
            transition: all 0.2s;
        }

        .btn-cancel:hover {
            background: #e2e8f0;
        }
    </style>
</head>
<body>

<div class="container my-5">
    <div class="card p-4 p-md-5 mx-auto" style="max-width: 700px;">
        <div class="header-icon">
            <i class="bi bi-pencil-square"></i>
        </div>
        
        <h1 class="text-center mb-4">ແກ້ໄຂຂໍ້ມູນຜູ້ໃຊ້</h1>
        
        <form id="editUserForm" action="updateuser.php" method="post">
            <input type="hidden" name="uid" value="<?php echo $user['uid']; ?>">
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">ຊື່ບັນຊີຜູ້ໃຊ້ (ID: <?php echo $user['uid']; ?>)</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-0"><i class="bi bi-person-lock"></i></span>
                        <input type="text" class="form-control" readonly 
                               value="<?php echo htmlspecialchars($user['username']); ?>">
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">ປະເພດຜູ້ໃຊ້</label>
                    <select class="form-select" name="role" required>
                        <option value="1" <?php echo ($user['role'] == 1) ? 'selected' : ''; ?>>Administrator</option>
                        <option value="2" <?php echo ($user['role'] == 2) ? 'selected' : ''; ?>>Staff</option>
                        <option value="3" <?php echo ($user['role'] == 3) ? 'selected' : ''; ?>>Customer</option>
                    </select>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">ຊື່ ແລະ ນາມສະກຸນ <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="fullname" required 
                           value="<?php echo htmlspecialchars($user['fullName']); ?>">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">ອີເມວ <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="email" required 
                           value="<?php echo htmlspecialchars($user['email']); ?>">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">ເບີໂທ</label>
                    <input type="tel" class="form-control" name="tel" 
                           value="<?php echo htmlspecialchars($user['tel']); ?>">
                </div>
            </div>

            <div class="mb-3 mt-2">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="changePassword">
                    <label class="form-check-label fw-bold text-danger" for="changePassword">
                        ຕ້ອງການປ່ຽນລະຫັດຜ່ານ?
                    </label>
                </div>
            </div>

            <div id="passSection" style="display: none;">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label class="form-label">ລະຫັດຜ່ານໃໝ່</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label">ຢືນຢັນລະຫັດຜ່ານໃໝ່</label>
                        <input type="password" class="form-control" name="repassword" id="repassword">
                    </div>
                </div>
                <small class="text-muted"><i class="bi bi-info-circle"></i> ລະຫັດຜ່ານຈະຖືກປ່ຽນເມື່ອທ່ານປ້ອນຂໍ້ມູນໃນຊ່ອງນີ້ເທົ່ານັ້ນ.</small>
            </div>

            <div class="mt-5 d-grid gap-2 d-md-flex justify-content-md-center">
                <button type="submit" class="btn btn-update">
                    <i class="bi bi-check-circle-fill me-2"></i> ບັນທຶກການແກ້ໄຂ
                </button>
                <a href="admin.php" class="btn btn-cancel">ຍົກເລີກ</a>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // ໃຊ້ slideToggle ເພື່ອຄວາມ Smooth
    $("#changePassword").change(function() {
        if($(this).is(":checked")) {
            $("#passSection").slideDown(300);
            $("#password, #repassword").attr("required", true);
        } else {
            $("#passSection").slideUp(300);
            $("#password, #repassword").val("").attr("required", false);
        }
    });
});
</script>
</body>
</html>