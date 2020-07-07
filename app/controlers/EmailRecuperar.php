<?php
      
      require '../public/librerias/PHPMailer-master/src/Exception.php';
      require '../public/librerias/PHPMailer-master/src/PHPMailer.php';
      require '../public/librerias/PHPMailer-master/src/SMTP.php'; 
            
      use PHPMailer\PHPMailer\PHPMailer;
      use PHPMailer\PHPMailer\SMTP;
      use PHPMailer\PHPMailer\Exception;
       
      try {
            $mail = new PHPMailer;          
            $mail->IsSMTP(); // enable SMTP
          //  $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
            $mail->SMTPAuth = true; // authentication enabled
            $mail->SMTPOptions = array(
              'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
              )
            );          
            $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 465; // or 587
            $mail->IsHTML(true);
            $mail->Username = "info@dataleanmakers.es";
            $mail->Password = "Bobedano2019$";
            $mail->SetFrom("info@dataleanmakers.es","Recuperar"); 
            $mail->Subject = utf8_decode("NUEVA TAREA".$email);
            $mail->Body = "Ha solicitado cambiar su contraseña actual. Para llevar a cabo el cambio debera pinchar en el siguiente enlace e 
            introducir una nueva:
            http://localhost/dashboard/cursophp/framework/Cambiar ";           
            $mail->AddAddress($email);
            // $mail->AddAddress("armine.manukyan@dataleanmakers.es");
            
            if(!$mail->Send()) {
              echo "Mailer Error: " . $mail->ErrorInfo;
            } else {
              echo " ";
            }    
          } catch(PDOException $exception){  
            // redireccionar('/clientes');
            return $exception->getMessage();                                 
           } 

           redireccionar('/crm');
?>