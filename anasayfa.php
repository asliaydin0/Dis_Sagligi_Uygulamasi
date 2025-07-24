<?php
ob_start();
include 'baglanti.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?mesaj=login_required");
    exit;
}

$id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT fullname FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    $username = $user['fullname'];
} else {
    session_unset();
    session_destroy();
    header("Location: login.php?mesaj=user_not_found");
    exit;
}
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8" />
  <title>Hoş Geldin <?php echo htmlspecialchars($username); ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <style>
    * {
      box-sizing: border-box;
    }
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #f5f7fa, #c3e0ff, #e0c3fc);
      background-size: 200% 200%;
      animation: backgroundGradient 15s ease infinite;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    @keyframes backgroundGradient {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    .navbar {
      background: linear-gradient(45deg, #ff6b6b, #a855f7, #06b6d4);
      padding: 10px 30px;
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
      border-bottom: 3px solid rgba(255, 255, 255, 0.2);
      position: relative;
      overflow: hidden;
      transition: all 0.3s ease;
    }

    .navbar::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
      transition: 0.5s;
    }

    .navbar:hover::before {
      left: 100%;
    }

    .navbar a {
      color: #fff;
      font-weight: 500;
      text-transform: uppercase;
      letter-spacing: 1px;
      padding: 10px 15px;
      border-radius: 5px;
      transition: all 0.3s ease;
    }

    .navbar a:hover {
      background: rgba(255, 255, 255, 0.2);
      transform: translateY(-2px);
    }

    .navbar-brand {
      font-weight: 700;
      font-size: 1.5rem;
      color: white;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .nav-tabs .nav-link {
      color: white;
      font-weight: 500;
      transition: all 0.3s ease;
      border: none;
      padding: 10px 20px;
    }

    .nav-tabs .nav-link.active {
      background: rgba(255, 255, 255, 0.9);
      color: #4f46e5;
      border-radius: 8px 8px 0 0;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    .nav-tabs .nav-link:hover {
      color: #e0f2fe;
      background: rgba(255, 255, 255, 0.2);
    }

    .container {
      text-align: center;
      padding: 80px 20px;
      flex: 1;
    }

    h1 {
      font-size: 2.8rem;
      color: #023e8a;
      margin-bottom: 60px;
      font-weight: 700;
      text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      animation: fadeIn 1s ease-in-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .box-group {
      display: flex;
      justify-content: center;
      gap: 40px;
      flex-wrap: wrap;
    }

    .box {
      background: linear-gradient(135deg, #ffffff, #f0f9ff);
      border-radius: 20px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
      width: 320px;
      padding: 35px 25px;
      transition: all 0.3s ease;
      text-align: left;
      cursor: pointer;
      border-top: 6px solid #06b6d4;
      position: relative;
      overflow: hidden;
    }

    .box::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(6, 182, 212, 0.2), transparent);
      transition: 0.5s;
    }

    .box:hover::before {
      left: 100%;
    }

    .box:hover {
      transform: translateY(-10px) scale(1.03);
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.25);
      border-top-color: #a855f7;
    }

    .box h2 {
      color: #023e8a;
      font-size: 1.5rem;
      margin-bottom: 15px;
      font-weight: 600;
    }

    .box p {
      color: #444;
      font-size: 1rem;
      line-height: 1.5;
    }

    .box-icon {
      font-size: 2rem;
      margin-bottom: 10px;
      color: #06b6d4;
      transition: color 0.3s ease;
    }

    .box:hover .box-icon {
      color: #a855f7;
    }

    @media (max-width: 768px) {
      .box {
        width: 90%;
      }

    }

footer {
  background: linear-gradient(to bottom, transparent, #023d8aa6 70%); /* Yumuşak geçiş için gradyan */
  padding: 150px 20px 40px 20px; 
  margin-top: 20px; /* Footer'ı sayfanın içeriğinden daha aşağı kaydırır */
  color: white; 
  font-size: 0.9rem;
  font-weight: 500;
 
}

.footer-content {
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 20px;
  max-width: 1200px;
  margin: 0 auto;
}

.footer-section {
  flex: 1;
  min-width: 200px;
}

.footer-section h3 {
  font-size: 1.2rem;
  margin-bottom: 15px;
  font-weight: 600;
  text-transform: uppercase;
}

.footer-section p,
.footer-section a {
  color: white;
  font-size: 0.9rem;
  line-height: 1.6;
  text-decoration: none;
  transition: color 0.3s ease;
}

.footer-section a:hover {
  color: #a855f7;
}

.social-icons {
  display: flex;
  gap: 15px;
}

.social-icons a {
  font-size: 1.5rem;
  color: white;
  transition: transform 0.3s ease, color 0.3s ease;
}

.social-icons a:hover {
  color: #262323ff;
  transform: translateY(-3px);
}

.footer-bottom {
  text-align: center;
  margin-top: 20px;
  padding-top: 20px;
  border-top: 1px solid rgba(255, 255, 255, 0.2);
}

@media (max-width: 768px) {
  .footer-content {
    flex-direction: column;
    text-align: center;
  }
  .social-icons {
    justify-content: center;
  }
}
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <span class="navbar-brand">🦷 Diş Sağlığı</span>
      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link active" href="anasayfa.php">Anasayfa</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="analiz.php">Diş Analizi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="fircalama.php">Fırçalama Takibi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="bahcem.php">Diş Bahçem</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="container">
    <h1>Hoş geldin, <?php echo htmlspecialchars($username); ?> 👋</h1>
    <div class="box-group">
      <div class="box" onclick="window.location.href='analiz.php'">
        <div class="box-icon">🦷</div>
        <h2>Hızlı Diş Analizi</h2>
        <p>Diş sağlığına yönelik şikayetlerini gir, yapay zekâ analiz etsin ve sana özel öneriler sunsun.</p>
      </div>
      <div class="box" onclick="window.location.href='fircalama.php'">
        <div class="box-icon">🪥</div>
        <h2>Fırçalama Takibi</h2>
        <p>Günde kaç kez diş fırçaladığını takip et, hatırlatmalar al ve düzenli alışkanlık kazan.</p>
      </div>
      <div class="box" onclick="window.location.href='bahcem.php'">
        <div class="box-icon">😊</div>
        <h2>Diş Bahçem</h2>
        <p>Diş sağlığını korumak için eğlenceli bir alan.</p>
      </div>
    </div>
  </div>
  <footer>
    <div class="footer-content">
      <div class="footer-section">
        <h3>Bize Ulaşın</h3>
        <p><i class="fas fa-envelope"></i> asliaydn12204@gmail.com</p>
        <p><i class="fas fa-phone"></i> +90 555 123 45 67</p>
        <p><i class="fas fa-map-marker-alt"></i> Aydın Diş Sağlığı Merkezi, Tokat/Türkiye</p>
      </div>
      <div class="footer-section">
        <h3>Bizi Takip Edin</h3>
        <div class="social-icons">
          <a href="https://twitter.com/aslaydn0" target="_blank"><i class="fab fa-twitter"></i></a>
          <a href="https://instagram.com/asliaydn_w" target="_blank"><i class="fab fa-instagram"></i></a>
          <a href="https://www.linkedin.com/in/asliaydin0" target="_blank"><i class="fab fa-linkedin-in"></i></a>
        </div>
      </div>
      <div class="footer-section">
        <h3>Hakkımızda</h3>
        <p>Diş Sağlığı platformu, yapay zeka destekli çözümlerle diş sağlığınızı korumanıza yardımcı olur.</p>
      </div>
    </div>
    <div class="footer-bottom">
      © 2025 Aslı AYDIN tarafından geliştirildi.
    </div>
  </footer>
</body>
</html>
<?php ob_end_flush(); ?>