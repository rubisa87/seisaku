
<table border="1">
<tr><th>ID</th><th>名前</th><th>Eメール</th><th>住所</th><th>電話番号</th><th>操作</th></tr>
<?ph
  $pdo = new PDO("mysql:dbname=loginmanagement", "root");
  $st = $pdo->query("SELECT * FROM userdata");
  while ($row = $st->fetch()) {
    $id = htmlspecialchars($row['id']);
    $name = htmlspecialchars($row['name']);
    $mail = htmlspecialchars($row['mail']);
    $address = htmlspecialchars($row['address']);
    $phone = htmlspecialchars($row['phone']);
    echo "<tr><td>$id</td><td>$name </td><td>$mail </td><td>$address </td><td>$phone </td><td><a href='user_update.php?name=$name '>修正</a><a href='user_delete.php?name=$name' onclick=\"return confirm('Mày định xoá thật à??')\">削除</a></td></tr>";
  }
?>
</table>
