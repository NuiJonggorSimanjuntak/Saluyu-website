<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Warning: Tidak Ada Akses</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #f8f9fa;
    }

    .warning-box {
      max-width: 525px;
      padding: 30px;
      border-radius: 12px;
      background: linear-gradient(to bottom, #ffcccc, #ffb3b3);
      /* Gradien dari atas ke bawah */
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    }

    h1 {
      font-size: 32px;
      margin-bottom: 20px;
      color: #dc3545;
    }

    p {
      font-size: 22px;
      margin-bottom: 30px;
    }

    .btn-back {
      padding: 12px 24px;
      font-size: 20px;
      background-color: #dc3545;
      border: none;
      border-radius: 8px;
      color: #fff;
      text-decoration: none;
      transition: background-color 0.3s ease;
    }

    .btn-back:hover {
      background-color: #c82333;
    }

    .icon-warning {
      font-size: 48px;
      margin-bottom: 20px;
      color: #dc3545;
    }
  </style>
</head>

<body>
  <div class="warning-box text-center">
    <i class="fas fa-exclamation-triangle icon-warning"></i>
    <h1>Warning: Tidak Ada Akses</h1>
    <p>Maaf, Anda tidak memiliki akses ke halaman ini.</p>
    <a href="#" class="btn-back" onclick="goBack()">Kembali</a>
    <script>
      function goBack() {
        window.history.back();
      }
    </script>
  </div>

  <!-- Bootstrap JS (Optional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Font Awesome -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</body>

</html>