'use strict'

function ans(quiz_num, option_num, correct_num)
// optionとcorrectを比較する
{
    // 正解の時の処理
    console.log(option_num)
    if (option_num === correct_num) {
        // console.log("正解")
        document.getElementById("table_two").style.background = "#287dff";
        document.getElementById("table_two").style.color = "white";
        document.getElementById("correct_text").classList.remove("message_delete");
        document.getElementById("table_one").style.pointerEvents = "none"
        document.getElementById("table_three").style.pointerEvents = "none"
    }
    // 不正解の時の処理
    else if (option_num == 1) {
        document.getElementById("table_two").style.background = "#287dff";
        document.getElementById("table_two").style.color = "white";
        document.getElementById("table_one").style.background = "#ff5128";
        document.getElementById("table_one").style.color = "white";
        document.getElementById("incorrect_text").classList.remove("message_delete");
        document.getElementById("table_two").style.pointerEvents = "none"
        document.getElementById("table_three").style.pointerEvents = "none"
    } else if (option_num == 3) {
        document.getElementById("table_two").style.background = "#287dff";
        document.getElementById("table_two").style.color = "white";
        document.getElementById("table_three").style.background = "#ff5128";
        document.getElementById("table_three").style.color = "white";
        document.getElementById("incorrect_text").classList.remove("message_delete");
        document.getElementById("table_one").style.pointerEvents = "none"
        document.getElementById("table_two").style.pointerEvents = "none"
    }
}


// 普段はボックスが表示されてない（デフォルト）→display:noneがついている状態corect_massageにつける
// ↓
// 選択肢を押したら表示される→display:noneがremoveされる
// →その後消えることはない（何もしなくていい）

// 1.ID（紐づけ手段）を使ってhtml要素を取得
// 2.操作が起こる条件
// 3.処理の指定

// for ([初期化式]; [条件式]; [加算式])
// for(let i=0; i<5; i++)←i<5のところを変えていく