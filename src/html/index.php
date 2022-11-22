<?php
require('dbconnect.php');

$stmt = $db->query('SELECT * FROM records');
$records = $stmt->fetchAll();
print_r($records);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quizy仮</title>
  <link rel="stylesheet" href="reset.css">
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div>

    <script src="./quizy.js"></script>
  </div>
</body>

</html>
