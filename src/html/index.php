<?php
require('dbconnect.php');

//全部のデータを取ってくる
$stmt = $db->query('SELECT * FROM records');
$records = $stmt->fetchAll();
// print_r($records);

//今日のデータを取ってくる
$stmt = $db->query('SELECT sum(hour) FROM records where date = CURDATE() ');
$today_hour = $stmt->fetch();

// print_r($today_hour[0]);

//月のデータを取ってくる
$stmt = $db->query("SELECT sum(hour) FROM records WHERE DATE_FORMAT(date, '%Y%m') = DATE_FORMAT(NOW(), '%Y%m')");
$month_hour = $stmt->fetch();

// print_r($month_hour[0]);

//合計のデータを取ってくる
$stmt = $db->query('SELECT sum(hour) FROM records');
$total_hour = $stmt->fetch();

// print_r($total_hour[0]);

//棒グラフのためのデータを取ってくる
$stmt = $db->query("SELECT date,sum(hour) FROM records WHERE DATE_FORMAT(date, '%Y%m') = DATE_FORMAT(NOW(), '%Y%m') GROUP BY date");
$bar_hour = $stmt->fetchAll();

// print('<pre>');
// print_r($bar_hour);
// print('</pre>');

//学習言語パイチャートのための言語と学習時間を取ってくる
$stmt = $db->query("SELECT language,sum(hour) 
FROM records
INNER JOIN languages
ON records.language_id=languages.id
GROUP BY language;");
$languagepie_hour = $stmt->fetchAll();

// print_r($languagepie_hour);

//学習コンテンツのためのデータを取ってくる
$stmt = $db->query("SELECT content,sum(hour) 
FROM records
INNER JOIN contents
ON records.content_id=contents.id
GROUP BY content;");
$contentpie_hour = $stmt->fetchAll();

print_r($contentpie_hour);

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
        <header class="header">
            <div class="header__logo">
                <img src="./img/posse_logo.jpg" alt="POSSE" width="485" height="108" />
            </div>
            <div class="header__week">
                <span>7th week</span>
            </div>
            <div class="header__submit" id="pc">
                <button type="submit" class="push__button">記録・投稿</button>
            </div>
        </header>
        <main class="main">
            <div class="container">
                <div class="record today__number">
                    <div class="center">
                        <div class="record__title">Today</div>
                        <?php echo $today_hour[0]; ?>
                        <span class="record__hour">hour</span>
                    </div>
                </div>
                <div class="record month__number">
                    <div class="center">
                        <div class="record__title">Month</div>
                        <?php echo $month_number[0]; ?>
                        <span class="record__hour">hour</span>
                    </div>
                </div>
                <div class="record total__number">
                    <div class="center">
                        <div class="record__title">Total</div>
                        <?php echo $total_hour[0]; ?>
                        <span class="record__hour">hour</span>
                    </div>
                </div>
                <div class="record month__report">
                    <canvas class="bar__graph" id="monthly__statistics"></canvas>
                </div>
                <div class="record languages__report">
                    <div class="graph__title">学習言語</div>
                    <canvas class="pie__chart" id="languages__statistics" style="position: relative; height: 30rem; width: 30rem"></canvas>
                    <ul class="option__list">
                        <?php foreach ($languagepie_hour as $language) : ?>
                        <span class="circle" style="background-color: blue"></span>
                        <li class="option__item"> <?php var_dump($language); ?> </li>
                        <?php endforeach; ?>
                        <span class="circle" style="background-color: rgb(91, 64, 243)"></span>
                        <li class="option__item">CSS</li>
                        <span class="circle" style="background-color: rgb(64, 147, 243)"></span>
                        <li class="option__item">PHP</li>
                        <br />
                        <span class="circle" style="background-color: rgb(135, 210, 245)"></span>
                        <li class="option__item">HTML</li>
                        <span class="circle" style="background-color: rgb(231, 175, 236)"></span>
                        <li class="option__item">Laravel</li>
                        <span class="circle" style="background-color: rgb(97, 8, 105)"></span>
                        <li class="option__item">SQL</li>
                        <br />
                        <span class="circle" style="background-color: rgb(72, 29, 112)"></span>
                        <li class="option__item">SHELL</li>
                        <br />
                        <span class="circle" style="background-color: rgb(113, 115, 235)"></span>
                        <li class="option__item">情報システム基礎知識(その他)</li>
                    </ul>
                </div>
                <div class="record contents__report">
                    <div class="graph__title">学習コンテンツ</div>
                    <canvas class="pie__chart" id="contents__statistics" style="position: relative; height: 30rem; width: 30rem"></canvas>
                    <ul class="option__list">
                        <span class="circle" style="background-color: blue"></span>
                        <li class="option__item">ドットインストール</li>
                        <br />
                        <span class="circle" style="background-color: rgb(72, 29, 112)"></span>
                        <li class="option__item">N予備校</li>
                        <br />
                        <span class="circle" style="background-color: rgb(113, 115, 235)"></span>
                        <li class="option__item">POSSE課題</li>
                    </ul>
                </div>
                <div class="date">
                    <button class="date__back">＜</button>
                    <span class="date__appear">2022年3月</span>
                    <button class="date__front">＞</button>
                </div>
                <div class="sp__push">
                    <button type="submit" class="push__button">記録・投稿</button>
                </div>
            </div>
        </main>
        <script src="./quizy.js"></script>
    </div>
</body>

</html>