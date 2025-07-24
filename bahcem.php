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

$health_score = 82; // örnek veri

function isBadTooth($i) {
    return ($i % 5 == 0);
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Diş Bahçem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #f9f9ff, #e0f7fa);
            margin: 0;
            padding: 0;
        }
        .navbar {
            background: linear-gradient(45deg, #ff6b6b, #a855f7, #06b6d4);
            padding: 10px 30px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
            border-bottom: 3px solid rgba(255, 255, 255, 0.2);
            position: relative;
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
        .container {
            max-width: 1000px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-top: 6px solid #06b6d4;
        }
        h1 {
            color: #2e7d32;
            text-align: center;
        }
        .username {
            font-size: 20px;
            text-align: center;
            margin-bottom: 20px;
        }
        .tooth-map {
            display: grid;
            grid-template-columns: repeat(8, 1fr);
            gap: 15px;
            justify-content: center;
            margin: 30px 0;
            
        }
        .tooth {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #e0ffe0;
            position: relative;
            transition: transform 0.3s ease;
        }
        .tooth:hover {
            transform: scale(1.2);
            z-index: 10;
        }
        .tooth img {
            width: 40px;
            height: 40px;
        }
        .tooth.bad img {
            filter: grayscale(100%) brightness(0.8);
        }
        .tooltip {
            position: absolute;
            bottom: 65px;
            background: #fff;
            padding: 6px 10px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0,0,0,0.2);
            font-size: 12px;
            display: none;
        }
        .tooth:hover .tooltip {
            display: block;
        }
        .stats {
            text-align: center;
            margin-top: 30px;
        }
        .stats span {
            display: inline-block;
            margin: 10px;
            font-size: 16px;
        }
        .badge {
            background-color: gold;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: bold;
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
                <li class="nav-item"><a class="nav-link" href="anasayfa.php">Anasayfa</a></li>
                <li class="nav-item"><a class="nav-link" href="analiz.php">Diş Analizi</a></li>
                <li class="nav-item"><a class="nav-link" href="fircalama.php">Fırçalama Takibi</a></li>
                <li class="nav-item"><a class="nav-link active" href="bahcem.php">Diş Bahçem</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h1>Diş Bahçem</h1>
        <div class="username">👋 Hoş geldin, <strong><?php echo htmlspecialchars($username); ?></strong></div>

        <div class="tooth-map">
            <?php
            for ($i = 1; $i <= 32; $i++) {
                $bad = isBadTooth($i);
                $img = $bad ? 'mutsuz-dis.png' : 'mutlu-dis.png';
                echo '<div class="tooth ' . ($bad ? 'bad' : '') . '">';
                echo '<img src="img/' . $img . '" alt="Diş ' . $i . '"><div class="tooltip">Diş ' . $i . ' - ' . ($bad ? 'Sorunlu' : 'Sağlıklı') . '</div>';
                echo '</div>';
            }
            ?>
        </div>

        <div class="stats">
            <span>🧠 Sağlık Puanı: <strong><?php echo $health_score; ?></strong></span>
            <span class="badge">🎖️ Temiz Diş Rozeti</span>
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
