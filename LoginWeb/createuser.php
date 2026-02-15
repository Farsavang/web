<!DOCTYPE html>
<html lang="lo">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - Modern Look</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Lao:wght@300;400;700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --glass-bg: rgba(255, 255, 255, 0.95);
        }

        body {
            font-family: 'Noto Sans Lao', 'Poppins', sans-serif;
            background: #f0f2f5;
            /* ໃສ່ພື້ນຫຼັງແບບ Gradient ໃຫ້ເບິ່ງມີມິຕິ */
            background-image: radial-gradient(circle at 10% 20%, rgb(239, 246, 249) 0%, rgb(206, 239, 253) 90%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .card {
            border: none;
            border-radius: 20px;
            background: var(--glass-bg);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        h1 {
            font-weight: 700;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 30px;
        }

        .form-label {
            font-weight: 600;
            color: #555;
            margin-left: 5px;
        }

        .form-control, .form-select {
            border-radius: 12px;
            padding: 12px 15px;
            border: 1px solid #e1e1e1;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #764ba2;
            box-shadow: 0 0 0 0.25rem rgba(118, 75, 162, 0.15);
        }

        .btn-primary {
            background: var(--primary-gradient);
            border: none;
            border-radius: 12px;
            padding: 12px 30px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            box-shadow: 0 5px 15px rgba(118, 75, 162, 0.4);
            transform: scale(1.02);
            opacity: 0.9;
        }

        .btn-secondary {
            background: #f8f9fa;
            color: #666;
            border: 1px solid #ddd;
            border-radius: 12px;
            padding: 12px 30px;
        }

        /* ຕົບແຕ່ງ Icon ໃຫ້ input (ຖ້າຕ້ອງການ) */
        .input-group-text {
            background: none;
            border: none;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card p-4 p-md-5 mx-auto" style="max-width: 600px;">
        <h1 class="text-center">ສ້າງບັນຊີຜູ້ໃຊ້ໃໝ່</h1>
        
        <form id="createUserForm" action="savenew.php" method="post">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="fullname" class="form-label">ຊື່ ແລະ ນາມສະກຸນ <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="fullname" id="fullname" placeholder="ປ້ອນຊື່ແທ້ຂອງທ່ານ" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="username" class="form-label">ຊື່ບັນຊີຜູ້ໃຊ້ <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="username" id="username" placeholder="username" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">ອີເມວ <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="example@mail.com" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="password" class="form-label">ລະຫັດຜ່ານ <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="repassword" class="form-label">ຢືນຢັນລະຫັດຜ່ານ <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" name="repassword" id="repassword" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="tel" class="form-label">ເບີໂທ</label>
                    <input type="tel" class="form-control" name="tel" id="tel" placeholder="020 xxx xxxx">
                </div>

                <div class="col-md-6 mb-3">
    <label for="role" class="form-label">ປະເພດຜູ້ໃຊ້ <span class="text-danger">*</span></label>
    <select class="form-select" name="role" id="role" required>
        <option value="" selected disabled>-- ກະລຸນາເລືອກປະເພດຜູ້ໃຊ້ --</option>
        
        <option value="1">Administrator (ຜູ້ດູແລ)</option>
        <option value="2">Staff (ພະນັກງານ)</option>
        <option value="3">Customer (ລູກຄ້າ)</option>
    </select>
</div>
            </div>
            
            <div class="mt-4 d-grid gap-2 d-md-flex justify-content-md-center">
                <button type="submit" class="btn btn-primary px-5">
                    <i class="bi bi-person-plus-fill"></i> ຕົກລົງສ້າງໃໝ່
                </button>
                <a href="admin.php" class="btn btn-secondary px-5">ຍົກເລີກ</a>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>