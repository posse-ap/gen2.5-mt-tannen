<?php
require('dbconnect.php');

//全部のデータを取ってくる
$stmt = $db->query('SELECT * FROM records');
$records = $stmt->fetchAll();
// print_r($records);

//今日のデータを取ってくる
$stmt = $db->query('SELECT sum(hour) FROM records where date = CURDATE() ');
$today_hour = $stmt->fetch();

// var_dump($today_hour[0]);

//月のデータを取ってくる
$stmt = $db->query("SELECT sum(hour) FROM records WHERE DATE_FORMAT(date, '%Y%m') = DATE_FORMAT(NOW(), '%Y%m')");
$month_hour = $stmt->fetch();

// var_dump($month_hour[0]);

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
$stmt = $db->query("SELECT language,sum(hour),color 
FROM records
INNER JOIN languages
ON records.language_id=languages.id
GROUP BY language, color;");
$languagepie_hour = $stmt->fetchAll();

// print_r($languagepie_hour);

//学習コンテンツのためのデータを取ってくる
$stmt = $db->query("SELECT content,sum(hour),color 
FROM records
INNER JOIN contents
ON records.content_id=contents.id
GROUP BY content, color;");
$contentpie_hour = $stmt->fetchAll();

// print_r($contentpie_hour);

print('<pre>');
var_dump($languagepie_hour);
print('</pre>');

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>webapp</title>
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="quizy.css">
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
                        <?php echo $month_hour[0]; ?>
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
                            <span class="circle" style="background-color: <?php echo $language["color"]; ?>"></span>
                            <li class="option__item">
                                <?php echo $language["language"] ?> </li>
                        <?php endforeach; ?>
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
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script>
        "use strict";

        let month = document.getElementById("monthly__statistics");
        let languages = document.getElementById("languages__statistics");
        let contents = document.getElementById("contents__statistics");

        /* =====================================
        chats.js
        ===================================== */
        var plugin1 = {
            afterDatasetsDraw: function(chart) {
                // To only draw at the end of animation, check for easing === 1
                var ctx = chart.ctx;

                chart.data.datasets.forEach(function(dataset, i) {
                    var dataSum = 0;
                    dataset.data.forEach(function(element) {
                        dataSum += element;
                    });

                    var meta = chart.getDatasetMeta(i);
                    if (!meta.hidden) {
                        meta.data.forEach(function(element, index) {
                            // Draw the text in black, with the specified font
                            ctx.fillStyle = "rgb(255, 255, 255)";

                            var fontSize = 1;
                            ctx.font = Chart.helpers.fontString(fontSize);

                            if (dataset.data[index] > 10) {
                                // Just naively convert to string for now
                                var dataString =
                                    (
                                        Math.round((dataset.data[index] / dataSum) * 1000) / 10
                                    ).toString() + "%";

                                // Make sure alignment settings are correct
                                ctx.textAlign = "center";
                                ctx.textBaseline = "middle";

                                var padding = 5;
                                var position = element.tooltipPosition();
                                ctx.fillText(
                                    dataString,
                                    position.x,
                                    position.y + fontSize / 2 - padding
                                );
                            }
                        });
                    }
                });
            },
        };
        let chart1 = new Chart(languages, {
                type: "doughnut",
                data: [
                    <?php foreach ($languagepie_hour as $language) :
                        echo $language['sum(hour)'] . ',';
                    endforeach; ?>
                ],
            },

        );

        let chart2 = new Chart(contents, {
            type: "doughnut",
            data: {
                // labels: ["ドットインストール", "N予備校", "POSSE課題"],
                datasets: [
                    <?php foreach ($contentpie_hour as $content) :
                        echo $content['sum(hour)'] . ',';
                    endforeach; ?>
                ],
            },
            options: {
                title: {
                    display: false,
                    text: "学習コンテンツ",
                },
                tooltips: {
                    enabled: false,
                },
            },
            plugins: [plugin1],
        });
    </script>
</body>

</html>