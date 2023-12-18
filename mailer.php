<?php
session_start();
include_once('db.php'); // Assuming the path to your database connection script is 'serve/db.php'


//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);


try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;               //Enable verbose debug output
    $mail->isSMTP();                                     //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                            //Enable SMTP authentication
    $mail->Username   = 'bckyrd.io@gmail.com';           //SMTP username
    $mail->Password   = 'xjtw lmvt eybc wxmi';           //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                             //TCP port to connect to; use 465 for `PHPMailer::ENCRYPTION_SMTPS`




    // Submitted Notifications
    if (isset($_POST['submit_approve'])) {
        $plot_id = $_POST['plot_id'];
        $tour_date = $_POST['tour_date'];
        $user_id = $_POST['user_id'];
        $email = $_POST['email'];
        $username = $_POST['username'];

        // Prepare the notification message based on the status
        $notificationMessage = 'Your tour has been scheduled for ' . $tour_date . '.';
        $status = 'scheduled';

        // SQL query to update property_tours and usersonplot
        $updateToursQuery = "UPDATE property_tours SET tour_date = :tour_date WHERE plot_id = :plot_id";
        $stmtTours = $conn->prepare($updateToursQuery);
        $stmtTours->bindParam(':tour_date', $tour_date);
        $stmtTours->bindParam(':plot_id', $plot_id);
        $stmtTours->execute();

        $updateUsersonplotQuery = "UPDATE usersonplot SET status = :status WHERE user_id = :user_id AND plot_id = :plot_id";
        $stmtUsersonplot = $conn->prepare($updateUsersonplotQuery);
        $stmtUsersonplot->bindParam(':status', $status);
        $stmtUsersonplot->bindParam(':user_id', $user_id);
        $stmtUsersonplot->bindParam(':plot_id', $plot_id);
        $stmtUsersonplot->execute();

        // Insert notification
        $insertNotificationQuery = "INSERT INTO notifications (user_id, message) VALUES (:user_id, :message)";
        $stmtNotification = $conn->prepare($insertNotificationQuery);
        $stmtNotification->bindParam(':user_id', $user_id);
        $stmtNotification->bindParam(':message', $notificationMessage);
        $stmtNotification->execute();


        //Recipients
        $mail->setFrom('bckyrd.io@gmail.com', 'Mailer Estate');
        $mail->addAddress($email, $username);     //Add a recipient
        $mail->addReplyTo('bckyrd.io@gmail.com', 'Information');



        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Real Estate Mail';
        $mail->Body    = $notificationMessage;
        $mail->AltBody = $notificationMessage;
        $mail->send();

        // After executing the database update and other operations
        echo "<script>alert('Schedule email Sent.'); window.location.href='property__admin__approve.php';</script>";
    }
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
