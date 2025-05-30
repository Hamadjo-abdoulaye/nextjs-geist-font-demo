<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../vendor/autoload.php';

function sendConfirmationEmail($to, $patientName, $doctorName, $date, $time) {
    $mail = new PHPMailer(true);

    try {
        // Charger la configuration
        $config = require __DIR__ . '/../config/mail.php';
        
        // Configuration du serveur
        $mail->isSMTP();
        $mail->Host = $config['smtp']['host'];
        $mail->SMTPAuth = true;
        $mail->Username = $config['smtp']['username'];
        $mail->Password = $config['smtp']['password'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = $config['smtp']['port'];
        $mail->CharSet = 'UTF-8';

        // Expéditeur et destinataire
        $mail->setFrom($config['smtp']['from_email'], $config['smtp']['from_name']);
        $mail->addAddress($to, $patientName);

        // Contenu
        $mail->isHTML(true);
        $mail->Subject = 'Confirmation de votre rendez-vous médical';
        
        // Corps du message
        $messageHTML = "
            <html>
            <body style='font-family: Arial, sans-serif; line-height: 1.6; color: #333;'>
                <div style='max-width: 600px; margin: 0 auto; padding: 20px;'>
                    <h2 style='color: #2563eb;'>Confirmation de rendez-vous</h2>
                    <p>Cher(e) {$patientName},</p>
                    <p>Votre rendez-vous a été confirmé avec les détails suivants :</p>
                    
                    <div style='background-color: #f3f4f6; padding: 15px; border-radius: 5px; margin: 20px 0;'>
                        <p><strong>Médecin :</strong> {$doctorName}</p>
                        <p><strong>Date :</strong> {$date}</p>
                        <p><strong>Heure :</strong> {$time}</p>
                    </div>
                    
                    <p>Rappels importants :</p>
                    <ul>
                        <li>Veuillez arriver 15 minutes avant l'heure de votre rendez-vous</li>
                        <li>Apportez votre carte d'identité et votre carte vitale</li>
                        <li>Si vous ne pouvez pas venir, merci de nous prévenir 24h à l'avance</li>
                    </ul>
                    
                    <p>Pour toute question ou modification, n'hésitez pas à nous contacter.</p>
                    
                    <p style='margin-top: 30px;'>Cordialement,<br>L'équipe médicale</p>
                </div>
            </body>
            </html>
        ";
        
        $mail->Body = $messageHTML;
        $mail->AltBody = strip_tags(str_replace(['<br>', '</p>'], ["\n", "\n\n"], $messageHTML));

        $mail->send();
        return ['success' => true, 'message' => 'Email de confirmation envoyé avec succès'];
    } catch (Exception $e) {
        return ['success' => false, 'message' => "L'email n'a pas pu être envoyé. Erreur: {$mail->ErrorInfo}"];
    }
}
?>
