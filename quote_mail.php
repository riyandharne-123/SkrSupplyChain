
  <?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// define variables and set to empty values
$name = $email = $subject = $message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["contact-name"];
  $email = $_POST["contact-email"];
  $subject = $_POST["contact-subject"];
  $message = $_POST["contact-message"];
}

// Instantiation and passing `true` enables exceptions

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.elasticemail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'dharne.techsolutions@gmail.com';                     // SMTP username
    $mail->Password   = 'A9C7333BECA046AFE4A657AE8C570D2BC0B4';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 2525;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('dharne.techsolutions@gmail.com', 'admin');
    $mail->setFrom($email, $name);
    $mail->addAddress('tina@skrsupplychain.com', 'Tina Dharne');     // Add a recipient

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $message;

    $mail->send();
    header("Location: index.html#section-quote");
} catch (Exception $e) {
  echo $mail->ErrorInfo;
}
