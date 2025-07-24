<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Hızlı Diş Analizi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', sans-serif;
    }

    body {
      background: linear-gradient(to right, #eef2f3, #8ec5fc);
      min-height: 100vh;
      color: #1e293b;
      display: flex;
      flex-direction: column;
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
      flex: 1;
      max-width: 900px;
      margin: 40px auto;
      background: white;
      padding: 40px;
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      
      border-top: 6px solid #06b6d4;
      
  
    }

    h2 {
      font-size: 26px;
      text-align: center;
      color: #4f46e5;
      margin-bottom: 20px;
    }

    textarea {
      width: 100%;
      height: 150px;
      padding: 15px;
      font-size: 16px;
      border: 2px solid #cbd5e1;
      border-radius: 12px;
      background: #f8fafc;
      color: #1e293b;
      resize: none;
    }

    textarea:focus {
      outline: none;
      border-color: #4f46e5;
      box-shadow: 0 0 8px rgba(79, 70, 229, 0.3);
    }

    .btn {
      display: block;
      width: 100%;
      margin-top: 25px;
      background: #4f46e5;
      color: white;
      border: none;
      padding: 15px;
      font-size: 16px;
      font-weight: 600;
      border-radius: 12px;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .btn:hover {
      background: #4338ca;
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(79, 70, 229, 0.4);
    }

    .ai-response {
      margin-top: 30px;
      background: #f1f5f9;
      padding: 20px;
      border-left: 6px solid #4f46e5;
      border-radius: 10px;
      color: #1e293b;
      line-height: 1.6;
    }

    .bottom-buttons {
      display: flex;
      justify-content: center;
      margin-top: 30px;
    }

    .bottom-buttons a {
      text-decoration: none;
      background: #16a34a;
      color: white;
      padding: 12px 25px;
      border-radius: 10px;
      transition: background 0.3s ease;
    }

    .bottom-buttons a:hover {
      background: #15803d;
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
    .tooth {
    min-width: 60px;
    text-align: center;
    border-radius: 8px;
    transition: 0.3s;
    }

    .tooth.active {
    background-color: #4f46e5 !important;
    color: white !important;
    border-color: #4f46e5 !important;
  }
      .tooth-image {
      width: 100%;
      max-height: 350px;
      object-fit: contain;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 8px;
    }

    label {
      font-weight: 500;
    }

    select, textarea {
      margin-bottom: 20px;
    }

    .btn-primary {
      background-color: #0077b6;
      border: none;
    }

    .btn-primary:hover {
      background-color: #023e8a;
    }

    .ai-suggestion {
      background-color: #e0f7fa;
      padding: 15px;
      border-left: 4px solid #00acc1;
      margin-top: 20px;
      border-radius: 8px;
    }
      .mhrs-btn {
      display: block; /* Block yaparak tam genişlik alır */
      margin-left: auto; /* Sağdan ve soldan otomatik margin ile ortalar */
      margin-right: auto;
      margin-top: 20px;
      background: #16a34a;
      color: white;
      border: none;
      padding: 10px 20px;
      font-size: 14px;
      font-weight: 500;
      border-radius: 8px;
      text-decoration: none;
      transition: all 0.3s ease;
      width: fit-content; /* Butonun içeriğe göre genişlik almasını sağlar */
  }

  .mhrs-btn:hover {
    background: #107133ff;
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(79, 70, 229, 0.3);
  }

  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <span class="navbar-brand">🦷 Diş Sağlığı</span>
      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link" href="anasayfa.php">Anasayfa</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="analiz.php">Diş Analizi</a>
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
  <h2>Hızlı Diş Analizi</h2>

  <img src="img/dis-numarali.png" alt="Numaralandırılmış Diş Görseli" class="tooth-image">

  <form method="POST">
    <div class="mb-3">
      <label for="toothNumber" class="form-label">Lütfen şikayetçi olduğunuz diş numarasını seçin:</label>
      <select class="form-select" name="toothNumber" id="toothNumber" required>
        <option value="" disabled selected>Seçiniz</option>
        <?php
        for ($i = 1; $i <= 32; $i++) {
            echo "<option value='$i'>$i</option>";
        }
        ?>
      </select>
    </div>

    <div class="mb-3">
      <label for="complaint" class="form-label">Şikayetinizi kısaca yazın:</label>
      <textarea class="form-control" name="complaint" id="complaint" rows="4" placeholder="Örneğin: Ağrı, hassasiyet, şişlik..." required></textarea>
    </div>

    <div class="mb-3">
      <label for="painLevel" class="form-label">Şikayet Seviyesi:</label>
      <select class="form-select" name="painLevel" id="painLevel" required>
        <option value="" disabled selected>Seçiniz</option>
        <option value="Hafif">Hafif</option>
        <option value="Orta">Orta</option>
        <option value="Şiddetli">Şiddetli</option>
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Analizi Göster</button>
    <a href="https://www.mhrs.gov.tr" target="_blank" class="mhrs-btn btn-sm">MHRS'den Randevu Al</a>
    
  </form>
  <?php

require_once 'gemini_api.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $tooth = htmlspecialchars($_POST['toothNumber']);
    $complaint = htmlspecialchars($_POST['complaint']);
    $pain = htmlspecialchars($_POST['painLevel']);

    $aiResponse = analyzeToothWithGemini($tooth, $complaint, $pain);

    echo "<div class='ai-suggestion'>";
    echo "<strong>Yapay Zeka Önerisi:</strong><br>";
    echo "📍 Diş: <strong>$tooth</strong><br>";
    echo "📄 Şikayet: <em>$complaint</em><br>";
    echo "🔺 Ağrı Şiddeti: <strong>$pain</strong><br><br>";
    echo "🤖 $aiResponse";
    echo "</div>";
}
  ?>
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
        <p>Diş Sağlığı platformu, yapay zeka destekli çözümlerle diş sağlığınızı korumanıza yardımcı olur. Güvenilir analizler ve önerilerle sağlığınıza değer katıyoruz.</p>
      </div>
    </div>
    <div class="footer-bottom">
      © 2025 Aslı AYDIN tarafından geliştirildi.
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
