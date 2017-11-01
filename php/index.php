<?php
header('Content-Type: application/json');

$name = $_REQUEST["name"];
$phone = $_REQUEST["phone"];
$email = $_REQUEST["email"];
$street = $_REQUEST["street"];
$home = $_REQUEST["home"];
$part = $_REQUEST["part"];
$appt = $_REQUEST["appt"];
$floor = $_REQUEST["floor"];
$comment = $_REQUEST["comment"];

$dsn = "mysql:host=localhost;dbname=burgers;charset=utf8";
$pdo = new PDO($dsn, 'mysql', 'mysql');
$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );

$exist_email=$pdo->query("SELECT COUNT(*) as count FROM users WHERE users.email = '$email'")->fetchColumn();

if ($exist_email) {
    $prepare = $pdo->prepare('UPDATE users SET tel=? WHERE email=?');
    $prepare->execute([$_REQUEST["phone"], $_REQUEST["email"]]);
} else {
    $prepare = $pdo->prepare('INSERT INTO users(email,name,tel) VALUES (?, ?, ?)');
    $prepare->execute([$_REQUEST["email"], $_REQUEST["name"], $_REQUEST["phone"]]);
}

$prepare = $pdo->prepare('INSERT INTO orders(email,street,house,block,flat,floor,comment,payment,callback) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
$prepare->execute([$_REQUEST["email"], $_REQUEST["street"], $_REQUEST["home"], $_REQUEST["part"], $_REQUEST["appt"], $_REQUEST["floor"], $_REQUEST["comment"], $_REQUEST["payment"], $_REQUEST["callback"]]);

$num_order=$pdo->query("SELECT COUNT(*) as count FROM orders WHERE users.email = '$email'")->fetchColumn();


/* тема/subject */
$subject = "Ваш заказ бургеров";

/* сообщение */
$message = "Ваш заказ будет доставлен по адресу: $street $home $part $appt $floor. Заказ: DarkBeefBurger за 500 рублей, 1 шт. “Спасибо! Это уже $num_order заказ";


$result= mail($email, $subject, $message);

