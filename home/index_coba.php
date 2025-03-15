<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Tahunan</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .welcome-section {
            background-color: #f5f8fd;
            padding: 50px;
            display: flex;
            align-items: center;
        }

        .welcome-text h1 {
            font-size: 3rem;
            font-weight: bold;
        }

        .welcome-text p {
            color: #6c757d;
        }

        .welcome-image img {
            max-width: 100%;
            border-radius: 10px;
        }

        .btn-start {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-start:hover {
            background-color: #0056b3;
        }

        .logo-placeholder {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 50%;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="welcome-section">
        <div class="container">
            <div class="row align-items-center">
                <!-- Text Section -->
                <div class="col-md-6">
                    <div class="welcome-text">
                        <h1>Laporan Tahunan Perusahaan</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In consequat mi non libero congue, at
                            aliquam augue faucibus. Fusce et felis semper, dapibus diam ut, ultricies metus.</p>
                        <a href="#" class="btn-start">Mulai Presentasi <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <!-- Image Section -->
                <div class="col-md-6">
                    <div class="welcome-image">
                        <img src="https://via.placeholder.com/500x300" alt="Gedung Perusahaan">
                    </div>
                </div>
            </div>
        </div>
        <!-- Logo Placeholder -->
        <div class="logo-placeholder">
            LOGO DISINI
        </div>
    </div>

    <!-- Bootstrap JS and Dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</body>

</html>
