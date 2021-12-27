'use strict'

function ans(quiz_num, option_num, correct_num)
// optionとcorrectを比較する
{
    // 正解の時の処理
    console.log(option_num)
    if (option_num === correct_num) {
        // console.log("正解")
        document.getElementById("table_two").style.background = "blue";
        document.getElementById("table_two").style.color = "white";
    }
    // 不正解の時の処理
    else {
        console.log("不正解")
    }
}