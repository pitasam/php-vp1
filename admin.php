<?php
$dsn = "mysql:host=localhost;dbname=burgers;charset=utf8";
$pdo = new PDO($dsn, 'mysql', 'mysql');

$stmt = $pdo->query('SELECT * FROM users');

echo "<h2>Список зарегестрированных пользователей</h2>";
echo "<ul>";
while ($row = $stmt->fetch())
{
    echo "<li>" . $row['email'].': '.$row['name'] . "</li>";
}
echo "</ul>";

$stmt = $pdo->query('SELECT * FROM orders');
echo "<h2>Список заказов</h2>";
echo "<ul>";
while ($row = $stmt->fetch())
{
    echo "<li>" . "Заказ id: ". $row['email'].'.   '."Адрес:".$row['street']." ". $row['street']." ". $row['house']." ". $row['block']." ". $row['flat']." ". $row['floor']. "</li>";
}
echo "</ul>";
?>
