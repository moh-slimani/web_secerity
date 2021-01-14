<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require APP . 'libs/PHPMailer/src/Exception.php';
require APP . 'libs/PHPMailer/src/PHPMailer.php';
require APP . 'libs/PHPMailer/src/SMTP.php';

class Helper
{
    /**
     * debugPDO
     *
     * Shows the emulated SQL query in a PDO statement. What it does is just extremely simple, but powerful:
     * It combines the raw query and the placeholders. For sure not really perfect (as PDO is more complex than just
     * combining raw query and arguments), but it does the job.
     *
     * @param string $raw_sql
     * @param array $parameters
     * @return string
     * @author Panique
     */
    static public function debugPDO(string $raw_sql, array $parameters): string
    {

        $keys = array();
        $values = $parameters;

        foreach ($parameters as $key => $value) {

            // check if named parameters (':param') or anonymous parameters ('?') are used
            if (is_string($key)) {
                $keys[] = '/' . $key . '/';
            } else {
                $keys[] = '/[?]/';
            }

            // bring parameter into human-readable format
            if (is_string($value)) {
                $values[$key] = "'" . $value . "'";
            } elseif (is_array($value)) {
                $values[$key] = implode(',', $value);
            } elseif (is_null($value)) {
                $values[$key] = 'NULL';
            }
        }

        /*
        echo "<br> [DEBUG] Keys:<pre>";
        print_r($keys);

        echo "\n[DEBUG] Values: ";
        print_r($values);
        echo "</pre>";
        */

        $raw_sql = preg_replace($keys, $values, $raw_sql, 1, $count);

        return $raw_sql;
    }

    static public function uploadFile($file): string
    {
        $target_dir = ROOT . 'public/';
        $fileType = pathinfo($file["name"], PATHINFO_EXTENSION);
        $file_name = explode('.', basename($file["name"]))[0];
        $target_relative_path = "uploads/" . uniqid() . substr($file_name, 0, 30) . '.' . $fileType;
        $target_file = $target_dir . $target_relative_path;

        $check = getimagesize($file["tmp_name"]);
        if ($check !== false) {
            // echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            // echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if (!$uploadOk == 0) {
            move_uploaded_file($file["tmp_name"], $target_file);
        }

        return $target_relative_path;
    }

    public static function encrypt($string): string
    {
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256', SECRET);
        $iv = substr(hash('sha256', IV), 0, 16);

        return base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
    }

    public static function decrypt($string)
    {
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256', SECRET);
        $iv = substr(hash('sha256', IV), 0, 16);

        return openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    public static function sendMail($email, $name, $subject, $body, $isHtml = false, $altBody = null)
    {
        $mail = new PHPMailer(true);
        try {
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = MAIL_HOST;
            $mail->SMTPAuth = true;
            $mail->Username = MAIL_USER;
            $mail->Password = MAIL_PASS;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = MAIL_PORT;

            $mail->setFrom(MAIL_USER, MAIL_NAME);
            $mail->addAddress($email, $name);

            $mail->isHTML($isHtml);
            $mail->Subject = $subject;
            $mail->Body = $body;

            if ($altBody) {
                $mail->AltBody = $altBody;
            }

            $mail->send();
            Messages::setMsg('An Email was sent to : ' . $email);
        } catch (Exception $e) {
            Messages::setMsg("Message could not be sent. Mailer Error: {$mail->ErrorInfo}", 'error');
        }
    }
}
