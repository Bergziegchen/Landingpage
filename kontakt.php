<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $absender = $_POST['absender'] ?? '';
    $betreff  = $_POST['betreff'] ?? '';
    $inhalt   = $_POST['inhalt'] ?? '';

    if (!filter_var($absender, FILTER_VALIDATE_EMAIL)) {
        die("Ungültige E-Mail-Adresse.");
    }

    $mail = new PHPMailer(true);

    try {
        // Gmail SMTP für meine Gmail-Adresse:



        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'strussnick@gmail.com';  // meine Adresse!
        $mail->Password = 'kxihqwbszqlwwihx ';     // mein spezielles Passwort!
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Absender (hier auch unbedingt meine Gmail-Adresse verwenden, sonst kommen die Mails nicht an -> Spam)



        $mail->setFrom('strussnick@gmail.com', 'Kontaktformular');

        // Empfänger
        $mail->addAddress('strussnick@gmail.com');

        // Reply to: Benutzer
        $mail->addReplyTo($absender);

        $mail->Subject = $betreff;
        $mail->isHTML(false);

        $mail->Body =




"Neue Nachricht vom Kontaktformular:

Absender: $absender
Betreff: $betreff

Nachricht:
$inhalt
";

        $mail->send();
        echo "Nachricht erfolgreich gesendet!";
    } catch (Exception $e) {
        echo "Fehler beim Senden: " . $mail->ErrorInfo;
    }
}
?>
