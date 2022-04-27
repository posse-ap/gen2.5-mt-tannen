'use strict';

document.getElementById("loader").onclick = function() {
    document.getElementById("load").classList.remove("none");
    console.log("ok");
};

function bar() {
    var ctx = document.getElementById("bar").getContext('2d');
    var myChart = new Chart(ctx, {

        type: "bar", // ★必須　グラフの種類
        data: {
            labels: ["", "2", "", "4", "", "6", "", "8", "", "10", "", "12", "", "14", "", "16", "", "18", "", "20", "", "22", "", "24", "", "26", "", "28", "", "30", "", ], // Ｘ軸のラベル
            datasets: [{
                data: [1, 2, 3, 4, 5, 6, 1, 2, 3, 4, 5, 6, 1, 2, 3, 4, 5, 6, 1, 2, 3, 4, 5, 6, 1, 2, 3, 4, 5, 8, 1, 2, 3, 4, 5, 6, ], // ★必須　系列Ａのデータ
                backgroundColor: "blue", // 棒の塗りつぶし色
            }]
        },
        options: {
            // オプション
            responsive: false, // canvasサイズ自動設定機能を使わない。HTMLで指定したサイズに固定
            title: { // タイトル
                display: false, // 表示設定
            },

            legend: { // 凡例
                display: false // 表示の有無
            },
            scales: {
                x: {
                    grid: {
                        color: 'transparent'
                    }
                },
                y: {
                    ticks: {
                        suggestionMax: 8,
                        suggestionMin: 0,
                        stepSize: 2,
                        callback: function(value, index, values) {
                            return value + 'h'
                        }
                    }
                },
            },
        },
    });
};

bar();

//学習言語

var myChart = document.getElementById("doughnut").getContext('2d');
var dataLabelPlugin = {
    afterDatasetsDraw: function(chart, easing) {
        var ctx = chart.ctx;
        chart.data.datasets.forEach(function(dataset, i) {
            var meta = chart.getDatasetMeta(i);
            if (!meta.hidden) {
                meta.data.forEach(function(element, index) {
                    ctx.fillStyle = 'rgb(255, 255, 255)';

                    var fontSize = 10;
                    var fontStyle = 'normal';
                    var fontFamily = 'Helvetica Neue';
                    ctx.font = Chart.helpers.fontString(fontSize, fontStyle, fontFamily);

                    var dataString = dataset.data[index].toString() + '%';

                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';

                    var padding = 5;
                    var position = element.tooltipPosition();
                    ctx.fillText(dataString, position.x, position.y - (fontSize / 2) - padding);
                })
            }
        })
    }
}


var chart = new Chart(myChart, {
    type: 'doughnut',
    data: {
        labels: ["JavaScript", "CSS", "PHP", "HTML", "Laravel", "SQL", "SHELL", "情報システム基礎知識（その他）"],
        datasets: [{
            backgroundColor: [
                "#4169e1",
                "#008080",
                "#58A27C",
                "#3C00FF",
                "#1e90ff",
                "#00fa9a",
                "#9932cc",
                "#f08080"
            ],
            data: [31, 16, 6, 13, 8, 9, 15, 2]
        }]
    },
    options: {
        title: {
            display: true,
            text: 'ブラウザ別シェア（日本）2018・10'
        }
    },
    plugins: [dataLabelPlugin],
});

//学習コンテンツ

var myChart = document.getElementById("nutnut").getContext('2d');
var dataLabelPlugin = {
    afterDatasetsDraw: function(chart, easing) {
        var ctx = chart.ctx;
        chart.data.datasets.forEach(function(dataset, i) {
            var meta = chart.getDatasetMeta(i);
            if (!meta.hidden) {
                meta.data.forEach(function(element, index) {
                    ctx.fillStyle = 'rgb(255, 255, 255)';

                    var fontSize = 10;
                    var fontStyle = 'normal';
                    var fontFamily = 'Helvetica Neue';
                    ctx.font = Chart.helpers.fontString(fontSize, fontStyle, fontFamily);

                    var dataString = dataset.data[index].toString() + '%';

                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';

                    var padding = 5;
                    var position = element.tooltipPosition();
                    ctx.fillText(dataString, position.x, position.y - (fontSize / 2) - padding);
                })
            }
        })
    }
}


var chart = new Chart(myChart, {
    type: 'doughnut',
    data: {
        labels: ["ドットインストール", "N予備校", "POSSE課題"],
        datasets: [{
            backgroundColor: [
                "#4169e1",
                "#008080",
                "#58A27C"
            ],
            data: [40, 25, 35]
        }]
    },
    options: {
        title: {
            display: true,
            text: 'ブラウザ別シェア（日本）2018・10'
        }
    },
    plugins: [dataLabelPlugin],
});