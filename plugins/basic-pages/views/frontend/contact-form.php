<?php
// Zobrazení chyb (pro ladění)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Vložení knihoven PHPMailer
require_once __DIR__ . '/../../libs/PHPMailer/src/Exception.php';
require_once __DIR__ . '/../../libs/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../../libs/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$response = ''; // Proměnná pro odpověď formuláře
$messageType = ''; // Typ zprávy (úspěch nebo chyba)

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Získání dat z formuláře
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Sestavení těla e-mailu s HTML stylem
    $body = "<strong>Jméno:</strong> $name<br>";
    $body .= "<strong>Předmět:</strong> $subject<br>";
    $body .= "<strong>E-mail:</strong> $email<br>";
    $body .= "<strong>Zpráva:</strong><div style='background-color: #f9f9f9; padding: 20px; border: 1px solid #ddd; border-radius: 5px;'>\n$message\n</div>";

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.elasticemail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'jitka.horavova01@gmail.com'; // Váš e-mail
        $mail->Password = '0DC4034B6F2989931A3BC05B033B48BB0890'; // Vaše heslo
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('jitka.horavova01@gmail.com', 'Your Name'); // Váš e-mail a jméno
        $mail->addAddress('jitka.horavova01@gmail.com', 'Recipient Name'); // Zde vložte příjemce
        $mail->Subject = $subject; // Použití předmětu z formuláře
        $mail->Body = $body; // Sestavené tělo e-mailu
        $mail->isHTML(true); // Umožnění odeslání HTML obsahu

        $mail->send();
        $response = 'Úspěch! Zpráva byla odeslána.';
        $messageType = 'success'; // Úspěšná zpráva
    } catch (Exception $e) {
        $response = "Chyba při odesílání e-mailu. Mailer Error: {$mail->ErrorInfo}";
        $messageType = 'error'; // Chyba
    }
}
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="path/to/your/assets/css/style.css"> <!-- Změňte na správnou cestu -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Kontaktní formulář</title>
</head>
<body>

<div class="contact-form col-md-12 mx-auto shadow p-5">
    <h4>Kontaktní formulář</h4>

    <form id="contact_form" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="contact_name" class="form-label">Jméno</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Vaše jméno" required>
        </div>
        <div class="mb-3">
            <label for="contact_subject" class="form-label">Předmět</label>
            <input type="text" class="form-control" id="subject" name="subject" placeholder="Předmět zprávy" required>
        </div>
        <div class="mb-3">
            <label for="contact_email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Vaše emailová adresa" required>
        </div>
        <div class="mb-3">
            <label for="contact_message" class="form-label">Zpráva</label>
            <textarea class="form-control" id="message" name="message" rows="6" placeholder="Vaše zpráva" required></textarea>
        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-blue w-50 mt-3">Odeslat</button>
        </div>
    </form>
</div>

<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2576.350173645455!2d16.90785424161489!3d49.77947947159055!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4712135824595861%3A0xd471666439b4daae!2sJir%C3%A1skova%20436%2F8%2C%20789%2085%20Mohelnice!5e0!3m2!1scs!2scz!4v1728567715883!5m2!1scs!2scz" height="450" style="border:0;width:100%;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

<script>
    // Funkce pro zobrazení SweetAlert
    function showAlert(type, message) {
        Swal.fire({
            icon: type,
            title: type === 'success' ? 'Úspěch!' : 'Chyba!',
            text: message,
            confirmButtonText: 'OK'
        });
    }

    // Zobrazit upozornění na základě PHP proměnné
    <?php if ($response): ?>
        showAlert('<?= $messageType ?>', '<?= $response ?>');
    <?php endif; ?>
</script>

</body>
</html>
