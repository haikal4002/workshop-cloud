<?php
include '../connect.php';
session_start();

// Tangkap NIM dari URL atau session
if (isset($_GET['username'])) {
    $nim_sesion = $_GET['username']; // Mengambil NIM dari parameter URL
    $_SESSION['pendaftaran']['NIM'] = $nim_sesion; // Simpan NIM ke session jika datang dari URL
    $nim_sesion = $_SESSION['pendaftaran']['NIM']; // Mengambil NIM dari session
} else {
    // Jika tidak ada parameter username atau session pendaftaran, arahkan ke halaman login
    header('Location: login_warga.php');
    exit();
}

// Handle form pembayaran
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $metode_pembayaran = $_POST['metode_pembayaran'] ?? '';
    $nominal = $_POST['nominal'] ?? '';
    $tanggal_pembayaran = $_POST['tanggal_pembayaran'] ?? '';
    $errors = [];

    // Validasi input
    if (empty($metode_pembayaran)) {
        $errors['metode_pembayaran'] = 'Metode pembayaran harus dipilih.';
    }
    if (empty($nominal)) {
        $errors['nominal'] = 'Nominal pembayaran harus diisi.';
    } elseif ((int)$nominal < 900000) {
        $errors['nominal'] = 'Minimal pembayaran adalah Rp 900.000';
    }
    if (empty($tanggal_pembayaran)) {
        $errors['tanggal_pembayaran'] = 'Tanggal pembayaran harus diisi.';
    }

    // Jika tidak ada error, arahkan ke halaman upload bukti
    if (empty($errors)) {
        $_SESSION['pembayaran'] = [
            'metode_pembayaran' => $metode_pembayaran,
            'nominal' => $nominal,
            'tanggal_pembayaran' => $tanggal_pembayaran
        ];
        echo "<script>alert('Pembayaran berhasil! Silakan upload bukti pembayaran.'); window.location.href = 'upload_bukti.php';</script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pembayaran</title>
    <style>
        form {
            width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        h2 {
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input,
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            margin-bottom: 10px;
        }
        .error {
            color: red;
        }
        .payment-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .payment-option {
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            height: 100px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .payment-option img {
            width: 120px;
            height: 60px;
            object-fit: contain;
            margin-bottom: 10px;
        }
        .payment-section {
            margin-bottom: 30px;
        }

        .payment-section h4 {
            margin-bottom: 15px;
            color: #333;
            font-size: 18px;
            border-bottom: 2px solid #eee;
            padding-bottom: 8px;
        }

        .payment-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .payment-option.selected {
            border-color: #007bff;
            background-color: #f8f9ff;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Detail Pembayaran</h2>
    
    <!-- <div class="payment-info">
        <p>NIM: <?= htmlspecialchars($nim_sesion) ?></p>
        <p>Nominal yang harus dibayar: Rp 900.000</p>
    </div> -->

    <form method="POST" id="paymentForm">
    <div class="payment-info">
        <p>NIM: <?= htmlspecialchars($nim_sesion) ?></p>
        <p>Nominal yang harus dibayar: Rp 900.000</p>
    </div>
        <h3>Pilih Metode Pembayaran</h3>
        
        <!-- Bank Transfer Section -->
        <div class="payment-section">
            <h4>Transfer Bank</h4>
            <div class="payment-grid">
                <div class="payment-option" data-method="BCA">
                    <img src="img_pembayaran/BCA.svg" alt="BCA">
                    <p>Bank BCA</p>
                </div>
                <div class="payment-option" data-method="BRI">
                    <img src="img_pembayaran/BRI.svg" alt="BRI">
                    <p>Bank BRI</p>
                </div>
                <div class="payment-option" data-method="BTN">
                    <img src="img_pembayaran/BTN.svg" alt="BTN">
                    <p>Bank BTN</p>
                </div>
                <div class="payment-option" data-method="BNI">
                    <img src="img_pembayaran/BNI.svg" alt="BNI">
                    <p>Bank BNI</p>
                </div>
            </div>
        </div>

        <!-- E-Wallet Section -->
        <div class="payment-section">
            <h4>E-Wallet</h4>
            <div class="payment-grid">
                <div class="payment-option" data-method="GoPay">
                    <img src="img_pembayaran/GoPay.svg" alt="GoPay">
                    <p>GoPay</p>
                </div>
                <div class="payment-option" data-method="DANA">
                    <img src="img_pembayaran/DANA.svg" alt="DANA">
                    <p>DANA</p>
                </div>
                <div class="payment-option" data-method="OVO">
                    <img src="img_pembayaran/OVO.svg" alt="OVO">
                    <p>OVO</p>
                </div>
                <div class="payment-option" data-method="ShopeePay">
                    <img src="img_pembayaran/ShopeePay.svg" alt="ShopeePay">
                    <p>ShopeePay</p>
                </div>
                <div class="payment-option" data-method="LinkAja">
                    <img src="img_pembayaran/LinkAja.svg" alt="LinkAja">
                    <p>LinkAja</p>
                </div>
            </div>
        </div>

        <!-- Retail Store Section -->
        <div class="payment-section">
            <h4>Minimarket</h4>
            <div class="payment-grid">
                <div class="payment-option" data-method="Indomaret">
                    <img src="img_pembayaran/Indomaret.svg" alt="Indomaret">
                    <p>Indomaret</p>
                </div>
                <div class="payment-option" data-method="Alfamart">
                    <img src="img_pembayaran/Alfamart.svg" alt="Alfamart">
                    <p>Alfamart</p>
                </div>
            </div>
            <h4>Pengurus</h4>
            <div class="payment-grid">
                <div class="payment-option" data-method="pengurus 1">
                    <p>pengurus 1</p>
                </div>
                <div class="payment-option" data-method="pengurus 2">
                    <p>Pengurus 2</p>
                </div>
            </div>
        </div>

        <input type="hidden" id="metode_pembayaran" name="metode_pembayaran" required>
        <input type="hidden" id="nominal" name="nominal" value="900000">
        
        <div class="form-group">
            <label for="tanggal_pembayaran">Tanggal Pembayaran</label>
            <input type="date" id="tanggal_pembayaran" name="tanggal_pembayaran" required>
            <span class="error"><?= $errors['tanggal_pembayaran'] ?? '' ?></span>
        </div>

        <div class="buttons">
            <button type="submit">Bayar Sekarang</button>
            <button type="button" onclick="window.location.href='login_warga.php'">Kembali</button>
        </div>
    </form>
</div>

<script>
document.querySelectorAll('.payment-option').forEach(option => {
    option.addEventListener('click', function() {
        // Remove selected class from all options
        document.querySelectorAll('.payment-option').forEach(opt => {
            opt.classList.remove('selected');
        });
        
        // Add selected class to clicked option
        this.classList.add('selected');
        
        // Update hidden input with the payment method name
        document.getElementById('metode_pembayaran').value = this.dataset.method;
    });
});

// Form validation
document.getElementById('paymentForm').addEventListener('submit', function(e) {
    if (!document.getElementById('metode_pembayaran').value) {
        e.preventDefault();
        alert('Silakan pilih metode pembayaran');
    }
});
</script>

</body>
</html>
