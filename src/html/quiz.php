<?php
require('dbconnect.php');

//タイトルを持ってくる
$stmt = $db->prepare('SELECT name FROM big_questions WHERE id = ?');
$stmt->execute(array($_GET['id']));
$big_questions = $stmt->fetchAll();

//問題を持ってくる
$stmt = $db->prepare('SELECT * FROM questions WHERE big_question_id = ?');
$stmt->execute(array($_GET['id']));
$questions = $stmt->fetchAll();

//選択肢を持ってくる
$choices_array = [];
foreach ($questions as $question) {
  $stmt = $db->prepare('SELECT * FROM choices WHERE question_id = ?');
  $stmt->execute([$question['id']]);
  $choices = $stmt->fetchAll();
  array_push($choices_array, $choices);
}

//確認用
print('<pre>');
var_dump($choices_array[0]);
print('</pre>');
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $big_questions[0]['name']; ?></title>
  <link rel="stylesheet" href="reset.css">
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <?php $question_index=0; ?>
  <?php foreach ($questions as $question) : ?>
    <div class="quiz">
      <h1><?php echo $question_index+1; ?>. この地名はなんて読む？</h1>
      <img src="/img/<?php echo $question['image']; ?>">
      <ul>
        <?php foreach ($choices_array[$question_index] as $index => $choice) : ?>
          <li id="answerlist_<?php echo $question_index . '_' . ($index + 1); ?>" name="answerlist_<?php echo $question_index; ?>" class="answerlist" onclick="check(
                <?php echo $question_index; ?>,
                <?php echo ($index + 1); ?>,
                <?php echo $answer['id'] - (($question['id'] - 1) * 3); ?>
              )">
            <?php echo $choice['name']; ?>
          </li>
        <?php endforeach; ?>
        <li id="answerbox_<?php echo $question_index; ?>" class="answerbox">
          <span id="answertext_<?php echo $question_index; ?>"></span><br>
          <span>
            正解は「
            <?php echo $answer['name']; ?>
            」です！
          </span>
        </li>
      </ul>
    </div>
  <?php $question_index++; ?>
  <?php endforeach; ?>
</body>

</html>