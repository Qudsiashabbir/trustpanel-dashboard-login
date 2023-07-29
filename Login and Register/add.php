<?php
var_dump($_POST);

error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once('connection.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Encryption function
function encryptString($data, $key) {
    $iv = random_bytes(16); // Generate a random initialization vector
    $cipherText = openssl_encrypt($data, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
    return base64_encode($iv . $cipherText);
}

function decryptString($data, $key) {
    $data = base64_decode($data);
    $iv = substr($data, 0, 16);
    $cipherText = substr($data, 16);
    return openssl_decrypt($cipherText, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
}

// Mail sending function
function sendMail($email, $v_code, $encryptionKey) {
    require ('phpmailer/Exception.php');
    require ('phpmailer/PHPMailer.php');
    require ('phpmailer/SMTP.php');
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'mail.heavenlearningacademy.net';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'dev@heavenlearningacademy.net';                     //SMTP username
        $mail->Password   = 'i0GTH5Y73';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('dev@heavenlearningacademy.net', 'Mailer');
        $mail->addAddress($email);     //Add a recipient

        //Attachments
        $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML

        // Encrypt the verification code before sending it via email
        $encrypted_v_code = encryptString($v_code, $encryptionKey);

        $mail->Subject = 'Here is the subject';
        $mail->Body = "This is the HTML message body <b>in bold!
        click the link below
        <a href='https://localhost/login_and_registration/verify.php?email=$email&v_code=$encrypted_v_code'>verify</a></b>";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

// Existing code ...

// Example usage
$encryptionKey = 'your_encryption_key_here';
$originalString = 'Hello, world!';

$encryptedString = encryptString($originalString, $encryptionKey);
echo 'Encrypted: ' . $encryptedString . "\n";

$decryptedString = decryptString($encryptedString, $encryptionKey);
echo 'Decrypted: ' . $decryptedString . "\n";

// ... Rest of the existing code

if(isset($_POST['register']))
{
    $name = $_POST['name'];
    $username = $_POST['username'];
    $pass = md5($_POST['password']);
    $v_code = bin2hex(random_bytes(16));
    $sql = "INSERT INTO `tbl_user`(`name`, `username`, `password`, `is_verified`, `verification_code`) VALUES ('$name', '$username', '$pass', '0', '$v_code')";

    // $sql   ="INSERT INTO `tbl_user`(`name`, `username`, `password`,`is_verified`,`verification_code`) VALUES ('$name','$username','$pass' , '$v_code','')";
    $result = mysqli_query($conn, $sql);
    if($result) { 
        // Send the verification email
        $email = $_POST['email'];
        $emailSent = sendMail($email, $v_code, $encryptionKey);

        if ($emailSent) {
            header('location:index.php');
            echo "<script>alert('New User Register Success');</script>";
        } else {
            echo "Error sending email. Please try again later.";
        }
    } else {
        die(mysqli_error($conn));
    }
}
?>
