<?php
$status = '';
if ( isset($_POST['submit']) ) {

    if ( $_SERVER["REQUEST_METHOD"] == "POST" ) {
        if ( empty($_POST["name"]) ) {
            $nameErr = "Name is required";
        } else {
            $fullname = test_input($_POST["name"]);
        }
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $to = 'redalpha1023@gmail.com';

    $mail_subject = 'Message from Website';
    $email_body = "Message from Contact Us Page of the Website: <br>";
    $email_body .= "<b>From:</b> {$fullname} <br>";
    $email_body .= "<b>Subject:</b> {$subject} <br>";
    $email_body .= "<b>Message:</b><br>" . nl2br(strip_tags($message));

    $header = "From: {$email}\r\nContent-Type: text/html;";

    $send_mail_result = mail($to, $mail_subject, $email_body, $header);

    if ( $send_mail_result ) {
        $status = '<p class="success">Message Sent Successfully !</p>';
    } else {
        $status = '<p class="error">Message Was Not Sent.</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us</title>
    <link rel="stylesheet" href="css/stylesheet.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<div class="container-fluid">
    <div class="form-div">
        <h3 class="title-h3"> Send Mail </h3>
        <div class="div-main">
            <form action="index.php" method="post">
                <p class="label-p">
                    <label for="fullname">Full Name :</label>
                    <input type="text" name="fullname" id="fullname" required>
                </p>

                <p class="label-p">
                    <label for="email">Email :</label>
                    <input type="email" name="email" id="email" required>
                </p>

                <p class="label-p">
                    <label for="subject">Subject :</label>
                    <input type="text" name="subject" id="subject" required>
                </p>

                <p class="label-p">
                    <label for="message">Message : </label>
                    <textarea name="message" id="message" cols="30" rows="10" required></textarea>
                </p>
                <p class="label-p">
                    <button type="submit" name="submit" class="btn btn-outline-primary">Send Message</button>
                </p>
                <div class="message-alert">
                    <?php echo $status; ?>
                </div>


            </form>
        </div>
    </div>
</div>
</body>
</html>
