<?php

$to= "support@arcnet.group";

$name = $_POST['name'];
$mail = $_POST['mail'];

$comment = $_POST['comment'];



$message = "
 <b>Name:</b> $name <br>
<b>Mail:</b> $mail<br>
<b>Massage:</b> $comment <br>
";




$headers = "Content-type: text/html; charset=UTF-8 \r\n";
$headers = "From: Форма заявок - <arcnet.group>\r\n";


$sendmail = mail($to, $name, $message, $headers);



if($sendmail = true){

echo "<center> <h2> Parabéns! Sua inscrição foi aceita! </h2> <br> <p>
Nossos gerentes entrarão em contato com você em breve! </p> </center>";
}
else
{
    echo "ERROR";
}
?>

