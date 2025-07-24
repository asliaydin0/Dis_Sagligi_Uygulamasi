<?php
ob_start();
include 'baglanti.php';
session_start();
$hata = "";
$mesaj = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, fullname, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $sonuc = $stmt->get_result();

    if ($sonuc->num_rows === 1) {
        $kullanici = $sonuc->fetch_assoc();
        if (password_verify($password, $kullanici['password'])) {
            $_SESSION['user_id'] = $kullanici['id']; // user_id yerine fullname kullanıyordu, tutarlılık için değiştirildi
            $_SESSION['user'] = $kullanici['fullname'];
            header("Location: anasayfa.php");
            exit;
        } else {
            $hata = "❌ Şifre hatalı.";
        }
    } else {
        $hata = "❌ E-posta bulunamadı.";
    }
    $stmt->close();
}

if (isset($_GET['mesaj']) && $_GET['mesaj'] === "success") {
    $mesaj = "✅ Kayıt başarılı! Giriş yapabilirsiniz.";
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Diş Sağlığı Asistanı | Giriş</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <style>
    /* Genel Sıfırlama */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    /* Arka Plan Videosu */
    #bg-video {
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      object-fit: cover;
      z-index: -1;
      filter: brightness(1.0);
    }

    /* Body */
    body {
      font-family: 'Segoe UI', sans-serif;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    /* Container */
    .container {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 20px;
      z-index: 1;
    }

    /* Başlık */
    h1 {
      text-align: center;
      color: #fff;
      margin-bottom: 30px;
      font-size: 2.5em;
      font-weight: bold;
      text-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
    }

    /* Login Kutusu */
    .login-box {
      background: rgba(255, 255, 255, 0.08);
      backdrop-filter: blur(10px);
      border-radius: 16px;
      padding: 70px 60px;
      max-width: 640px;
      width: 100%;
      color: white;
      text-align: center;
      border: 1px solid rgba(255, 255, 255, 0.2);
      box-shadow: 0 0 30px rgba(255, 255, 255, 0.15);
      transition: all 0.3s ease, transform 0.3s ease;
    }

    .login-box:hover {
      transform: scale(1.03);
      box-shadow: 0 0 60px rgba(241, 196, 15, 0.35);
    }

    .login-box h2 {
      font-size: 38px;
      margin-bottom: 35px;
      font-weight: 700;
      color: #fff;
    }

    /* Mesaj Stili */
    .success-message {
      color: lightgreen;
      margin-bottom: 20px;
      font-size: 16px;
    }

    /* Input Kutuları */
    .input-box {
      position: relative;
      margin-bottom: 22px;
    }

    .input-box input {
      width: 100%;
      padding: 16px 16px 16px 50px;
      border-radius: 40px;
      border: none;
      background: rgba(255, 255, 255, 0.1);
      color: #fff;
      font-size: 16px;
      outline: none;
      transition: 0.3s ease;
    }

    .input-box input:focus {
      background: rgba(255, 255, 255, 0.15);
      box-shadow: 0 0 10px rgba(241, 196, 15, 0.3);
    }

    .input-box input::placeholder {
      color: #fff9f9;
      opacity: 1;
    }

    .input-box i {
      position: absolute;
      top: 50%;
      left: 18px;
      transform: translateY(-50%);
      color: #ffffff;
      font-size: 15px;
    }

    /* Seçenekler */
    .options {
      display: flex;
      justify-content: space-between;
      font-size: 14px;
      margin-bottom: 22px;
      color: #ccc;
    }

    .options a {
      color: #f1c40f;
      text-decoration: none;
    }

    /* Buton */
    .login-btn {
      width: 100%;
      padding: 16px;
      border-radius: 40px;
      background: linear-gradient(90deg, #f1c40f, #e67e22);
      border: none;
      color: #111;
      font-weight: 600;
      font-size: 17px;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .login-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(241, 196, 15, 0.3);
    }

    /* Kayıt Linki */
    .register-link {
      margin-top: 25px;
      font-size: 14px;
      color: #ffffff;
    }

    .register-link a {
      color: #f1c40f;
      text-decoration: none;
    }

    /* Mobil Uyum */
    @media screen and (max-width: 480px) {
      .login-box {
        padding: 40px 25px;
        max-width: 90%;
      }

      .login-box h2 {
        font-size: 28px;
      }

      .success-message {
        font-size: 14px;
      }

      .input-box input {
        font-size: 14px;
        padding-left: 45px;
      }

      .input-box i {
        font-size: 13px;
        left: 14px;
      }

      .login-btn {
        font-size: 15px;
        padding: 14px;
      }

      .options {
        font-size: 12px;
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
      }

      .register-link {
        font-size: 12px;
        text-align: center;
      }

      h1 {
        font-size: 2em;
        margin-bottom: 20px;
      }
    }
  </style>
</head>
<body>  
  <video autoplay muted loop id="bg-video">
    <source src="img/dis.mp4" type="video/mp4">
    Tarayıcınız video etiketini desteklemiyor.
  </video>

  <div class="container">
    <h1>Diş Sağlığı Asistanı'na <br> Hoşgeldiniz</h1>
    <div class="login-box">
      <h2>Giriş Yap</h2>
      <?php if ($mesaj): ?>
        <p class="success-message"><?php echo $mesaj; ?></p>
      <?php endif; ?>
      <form action="" method="POST">
        <div class="input-box">
          <i class="fas fa-user"></i>
          <input type="email" name="email" placeholder="E-posta" required />
        </div>
        <div class="input-box">
          <i class="fas fa-lock"></i>
          <input type="password" name="password" placeholder="Şifre" required />
        </div>
        <div class="options">
          <label><input type="checkbox" /> Beni Hatırla</label>
          <a href="#">Şifremi Unuttum?</a>
        </div>
        <button type="submit" class="login-btn">Giriş Yap</button>
        <p class="register-link">Hesabınız yok mu? <a href="register.php">Kayıt Ol</a></p>
        <?php if ($hata): ?>
          <p style="color: red; margin-top: 10px;"><?php echo $hata; ?></p>
        <?php endif; ?>
      </form>
    </div>
  </div>

  <script>
    const video = document.getElementById("bg-video");
    video.playbackRate = 0.8;
  </script>
</body>
</html>
<?php ob_end_flush(); ?>