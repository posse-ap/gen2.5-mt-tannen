'use strict'

//配列の箱を作る

var question_list = new Array();

//配列の中身を指定する
//pushにすることで問題を足したいときに付け足すことができる

question_list.push(['たかなわ', 'こうわ', 'たかわ']);

console.log(
    question_list
);

//quiz_id 問題番号
//selected_id 回答番号
//correct_id 正解番号

function check(quiz_id, selected_id, correct_id) {

    //回答選択後、クリックを無効化する

    const selected_num = document.getElementsByName('answerlist_' + quiz_id);
    //↑赤字はhtml要素

    console.log(selected_num);
    //何番を選択したか確認するため

    answerlists.forEach(answerlist => {
        answerlist.style.pointerEvents = 'none;'
            //answerlistは沢山あるため、forEachで一つ一つに作用するようにした
    });

    //選択した際の動きを作る
    //その１：選択された選択肢の動き

    var selectedtext = document.getElementById('answerlist_' + quiz_id + '_' + selected_id);
    //選択した選択肢を呼び出す

    var correcttext = document.getElementById('answerlist_' + quiz_id + '_' + correct_id);
    //正解の選択肢を呼び出す

    selectedtext.className = 'answer_incorrect'
    correcttext.className = 'answer_valid'
        //新しいクラスを付与する（上書き）

    //その２：正解・不正解の動き

    var answerbox = document.getElementById('answerbox_' + quiz_id);
    //回答の際に現れる（外側のハコ）
    var answertext = document.getElementById('answertext_' + quiz_id);
    //回答の際に現れる（メッセージ）
    if (selected_id == correct_id) {
        answertext.className = 'answerbox_correct';
        //クラス付与
        answertext.innerText = '正解！';
        //メッセージを直で指定している
    } else {
        answertext.className = 'answerbox_incorrect';
        //クラス付与
        answertext.innerText = '不正解！';
        //メッセージを直で指定している
    }
    answerbox.style.display = 'block';
}

//問題のhtml作成

function newquestion(quiz_id, select_list, correct_id) {
    var contents = '<section class="quizBig">' +
        '<h2>' + quiz_num + '. この地名はなんて読む？</h2>' +
        '<img src ="img/' + quiz_num + '.png">'
        //↑問題文の型

    select_list.forEach(function(selection, index)
        //forEachのコールバック関数で、 selection_listのなかの要素selectionとその番号indexを使うぜ！ってこと
        {
            contents += '<li id="answerlist_' + quiz_id + '_' + (index + 1) + '" name="answerlist_' + quiz_id + '" class="answerlist" ' +
                //ここは単純にid.name,classの付与。問題にあったselect_listを呼び出し、いい感じに並べる
                //多分↑と↓は別物だと思う
                'onclick="check(' + quiz_id + '_' + (index + 1) + '_' + correct_id + ')">' + selection + '</li>';
            //onclick→クリックしたときに、さっき指定したcheck関数が処理されるよ、その時の番号は「問題番号,選択した要素の番号（+1なのは配列が0から始まるから）,選択した要素」だよ！確認してね！選択した要素をわざわざ入れているのは、check関数で使うからだよ！

            //多分だけど、select_listで呼ばれてる選択肢配列はそのままどーんってサイトに出てくるんだと思う

            //↑選択肢の型

            contents += '<li id="answerbox_' + quiz_id + '"class="answerbox">' +
                '<span id="answertext_' + quiz_id + '"></span><br>' +
                '<span>正解は「' + select_list[correct_id - 1] + '」です！</span>' + '</li>' + '</ul>' + '</div >';
            //解答の型。選択肢の配列の中で、
            document.getElementById('main').insertAdjacentHTML('beforeend', contents);
        });
};

newquestion();
//問題を出す

function randomlist() {
    question_list.forEach(function(question, index) {
        // question_listは一番最初にやったやつ
        answer = question[0];
        //↑答えは一番前のやつだよということを確認させておく

        for (var i = question.length - 1; i > 0; i--) {
            var j = Math.floor(Math.random() * (i + 1)); //random index
            [question[i], question[j]] = [question[j], question[i]]; // 並べ替え
        }

        // 配列をシャッフル（Fisher-Yates shuffle）→調べてコピペした

        newquestion(index + 1, question, question.indexOf(answer) + 1);
        //問題番号,問題,問題の番号→指定した問題を生成
    });

}

randomlist();

//answerlistとquestionlistの関係性さえわかれば最強