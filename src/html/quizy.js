//棒グラフ
var monthly = document.getElementById("monthly__statistics");

var myBarChart = new Chart(monthly, {
    type: 'bar',
    data: {
        labels: ["", "2", "", "4", "", "6", "", "8", "", "10", "", "12", "", "14", "", "16", "", "18", "", "20", "", "22", "", "24", "", "26", "", "30", ""],
        datasets: [{
            label: 's',
            data: [6.2, 6.5, 0.3, 3.5, 5.1, 6.6, 4.7, 0, 1.1, 1, 1, 4, 2.4, 1, 1, 2.4, 0, 1, 1, 1, 3.1, 6.6, 7, 1, 3.2, 1, 1, 5],
            backgroundColor: "rgb(0, 190, 255)",
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        tooltips: {
            enabled: false
        },
        title: {
            display: false,
            text: '支店別 来客数'
        },
        scales: {
            xAxes: [{
                display: true,
                gridLines: {
                    display: false,
                    drawBorder: false
                },
                ticks: {
                    fontSize: 10,
                    fontColor: "rgb(0, 190, 255)",
                },
            }],
            yAxes: [{
                stacked: true,
                ticks: {
                    suggestedMax: 8,
                    suggestedMin: 0,
                    stepSize: 2,
                    fontColor: "rgb(0, 190, 255)",
                    fontSize: 10,
                    callback: function(value) {
                        return value + 'h'
                    },
                },
                gridLines: {
                    display: false,
                    drawBorder: false,
                }
            }]
        },
    },
});

//パイチャート
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
    data: {
        // labels: ["JavaScript", "CSS", "PHP", "HTML", "Lalavel", "SQL", "SHELL", "情報システム基礎知識（その他）"],
        datasets: [{
            backgroundColor: [
                "blue",
                "rgb(91, 64, 243)",
                "rgb(64, 147, 243)",
                "rgb(135, 210, 245)",
                "rgb(231, 175, 236)",
                "rgb(97, 8, 105)",
                "rgb(72, 29, 112)",
                "rgb(113, 115, 235)",
            ],
            data: [5.9, 11.8, 23.5, 14.7, 8.8, 29.4, 5.9, 0],
            borderWidth: [1],
        }, ],
    },
    options: {
        title: {
            display: false,
            text: "学習言語",
        },
        tooltips: {
            enabled: false,
        },
    },
    plugins: [plugin1],
});

let chart2 = new Chart(contents, {
    type: "doughnut",
    data: {
        // labels: ["ドットインストール", "N予備校", "POSSE課題"],
        datasets: [{
            backgroundColor: ["blue", "rgb(91, 64, 243)", "rgb(64, 147, 243)"],
            data: [94.1, 0, 5.9],
            borderWidth: [1],
        }, ],
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