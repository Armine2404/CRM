 
      <?php
      
      require '../public/librerias/PHPMailer-master/src/Exception.php';
      require '../public/librerias/PHPMailer-master/src/PHPMailer.php';
      require '../public/librerias/PHPMailer-master/src/SMTP.php'; 
            
      use PHPMailer\PHPMailer\PHPMailer;
      use PHPMailer\PHPMailer\SMTP;
      use PHPMailer\PHPMailer\Exception;
        $mensaje = "<div><h2 style='color:teal'>Se ha creado una nueva tarea en la agenda:</h2><strong style=' margin-left:5px; color:teal'>  INICIO: </strong style=' margin-left:5px; color:teal'>" . date("d-m-Y H:i:s",strtotime($datos['start'])). "<br><br><strong style=' margin-left:5px; color:teal'>FIN:</strong> ".date("d-m-Y H:i:s",strtotime($datos['end'])). 
        "<br><br><strong style='margin-left:5px;margin-bottom:10px; color:teal'>TAREA:  </strong>" .$datos['accion']."</div>"; 
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
            $mail->Username = "";
            $mail->Password = "";
            $mail->SetFrom(""); 
            $mail->Subject = utf8_decode("NUEVA TAREA");
            $mail->Body = $mensaje ;           
            $mail->AddAddress($datosUsuario->email);
           
            
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