<?php
header("Content-Type: text/html; charset=UTF-8");
include_once($_SERVER['DOCUMENT_ROOT'].'/mail_module/PHPMailer/PHPMailerAutoload.php');

function mailer($fname, $fmail, $to, $subject, $content, $type=0, $file="", $cc="", $bcc="")
{
      if ($type != 1) $content = nl2br($content);
      // type : text=0, html=1, text+html=2
      $mail = new PHPMailer(); // defaults to using php "mail()"
      $mail->IsSMTP();
         //   $mail->SMTPDebug = 2;
      $mail->SMTPSecure = "ssl";
      $mail->SMTPAuth = true;
      $mail->Host = "smtp.naver.com";
      $mail->Port = 465;
      $mail->Username = "herryssong97";
      $mail->Password = "Qpqp1356!!";
      $mail->CharSet = 'UTF-8';
      $mail->From = $fmail;
      $mail->FromName = $fname;
      $mail->Subject = $subject;
      $mail->AltBody = ""; // optional, comment out and test
      $mail->msgHTML($content);
      $mail->addAddress($to);
      if ($cc)
            $mail->addCC($cc);
      if ($bcc)
            $mail->addBCC($bcc);
      if ($file != "") {
            foreach ($file as $f) {
                  $mail->addAttachment($f['path'], $f['name']);
            }
      }
      if ( $mail->send() ) return "success";
      else return "fail";
}


$user_name   = $_POST['user_name'];
$fmail   = "herryssong97@naver.com";	//보내는사람
$to      = "herryssong97@naver.com";		//받는사람
$subject = "문의메일  : ".$_POST["user_subject"]."(보내신분 : ".$_POST['user_email'].")";
$content = $_POST['user_Message'];

$rlt = mailer($user_name, $fmail, $to, $subject, $content);

if($rlt =="success") {
	echo "<script>alert('메일을 전송했습니다.');history.go(-1);</script>";
}else{
	echo "<script>alert('메일 전송에 실패 했습니다.');history.go(-1);</script>";
}

//mailer("test","herryssong97@naver.com","matzip84@naver.com","test","test" );
?>