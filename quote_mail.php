
  <?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// define variables and set to empty values
$name = "";
$comapny_name = "";
$country_code = "";
$telephone = "";
$email = "";
$shipment_type = "";
$place_of_loading = "";
$haz_details = "";
$destination = "";
$pieces = "";
$weight = "";
$cubic_meter = "";
$container_size = "";
$number_of_containers = "";
$date_of_order = "";
$additional_information = "";
$firm_order = "";
$method_of_contact = "";
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["quote-name"];
    $comapny_name = $_POST["quote-companyname"];
    $country_code =  $_POST["quote-countrycode"];
    $telephone =  $_POST["quote-phonenumber"];
    $email =  $_POST["quote-email"];
    $shipment_type = $_POST["quote-shipmentType"];
    $place_of_loading = $_POST["quote-placeofloading"];
    $haz_details = $_POST["quote-hazdetails"];
    $destination = $_POST["quote-destination"];
    $pieces = $_POST["quote-peices"];
    $weight = $_POST["quote-weight"];
    $cubic_meter = $_POST["quote-cubicmeter"];
    $container_size = $_POST["quote-containersize"];
    $number_of_containers = $_POST["quote-numberofcontainers"];
    $date_of_order = $_POST["quote-dateofOrder"];
    $additional_information = $_POST["quote-additionalInformation"];
    $firm_order = $_POST["quote-firmorder"];
    $method_of_contact = $_POST["quote-contactmethod"];
    $message = "";
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
    $mail->addAddress('riyandharne@gmail.com', 'Riyan Dharne'); 
   // $mail->addAddress('tina@skrsupplychain.com', 'Tina Dharne');     // Add a recipient

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Quotation';
    $mail->Body    = $message;

    $mail->send();
    header("Location: index.html#section-quote");
} catch (Exception $e) {
  echo $mail->ErrorInfo;
}
