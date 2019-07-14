<?php
//читать json файл
$json = file_get_contents('../goods.json');
$json = json_decode($json, true);

//письмо
$messege = '';
$messege .= '<h1>Заказ в магазине</h1>';
$messege .= '<p>Телефон: '.$_POST['ephone'].'</p>';
$messege .= '<p>Почта: '.$_POST['email'].'</p>';
$messege .= '<p>Клиент: '.$_POST['ename'].'</p>';

$cart = $_POST['cart'];
$sum =0;
foreach ($cart as $id=>$count){
    $messege .=$json[$id]['name'].' --- ';
    $messege .=$count.' --- ';
    $messege .=$count+$json[$id]['cost'];
    $messege .='<br>';
    $sum = $sum + $count+$json[$id]['cost'];
}
$messege .='Всего: '.$sum;

//print_r($messege);

$to = 'ghthgf@mail.ru'.',';
$to .=$_POST['email'];
$spectext = '<!DOCTYPE HTML><html><head><title>Заказ</title></head><body>';
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

$m = mail($to, 'Заказ в магазине', $spectext.$messege.'</body></html>', $headers);

if($m) {echo  1;} else {echo  0;}