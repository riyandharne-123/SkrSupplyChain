
  <?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// define variables and set to empty values
$number = "";
$name= "";
$email = "";
$message = "";
$position = "";
$location = "";
$resume ="";
$fileloc="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["career-name"];
  $email = $_POST["career-email"];
  $number = $_POST["career-number"];
  $postion = $_POST["career-position"];
  $location = $_POST["career-location"];
  $message = $_POST["career-message"];


//file uploading
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$fileloc=$target_file;

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["tmp_name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
//end
}
$message = "
<table border='1'>
<tr>
  <td>name</td>
  <td>".$name."</td> 
</tr>
<tr>
  <td>email</td>
  <td>".$email."</td> 
</tr>
<tr>
  <td>number</td>
  <td>".$number."</td> 
</tr>
<tr>
  <td>Position</td>
  <td><p>".$postion."</p></td> 
</tr>
<tr>
  <td>Location</td>
  <td>".$location."</td> 
</tr>
<tr>
<td>Message</td>
<td>".$message."</td> 
</tr>
</table>
<hr>
<div>".$resume."</div>
";

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
    $mail->AddAttachment($fileloc,$_FILES["fileToUpload"]["name"]);
    //Recipients
    $mail->setFrom('dharne.techsolutions@gmail.com', 'admin');
    $mail->setFrom($email, $name);
    $mail->addAddress('tina@skrsupplychain.com', 'Tina Dharne');  
    $mail->addAddress('j.benny@skrsupplychain.com', 'Benny');   
     $mail->addAddress('rajan.sivakumar@skrsupplychain.com', 'Rajan sivakumar');   

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = 'hiring';
    $mail->Body    = $message;
        
    header("Location: Careers.html");
    $mail->send();


} catch (Exception $e) {
  echo $mail->ErrorInfo;
}
