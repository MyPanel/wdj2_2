var question_old_page;
var old_questions;

window.addEventListener('load', function() { 
    document.getElementById('serach_button').addEventListener('click',function() {
        var menu = document.getElementById('search_menu');
        menus = menu.options;
        index = menu.selectedIndex;
        console.log(menus);
        console.log(index);
        question_title = menus[index].text;
        console.log(menus[index].text);
        if (document.getElementById('search_content').value) {
            fetch('/questions/search', {
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json', 
                    'X-CSRF-TOKEN': document.querySelector('#token').value,
                },
                method: "POST",
                body: JSON.stringify({
                    search_title: question_title,
                    search_content: document.getElementById('search_content').value
                })
            })
            .then(res => res.json())
            .then((res) => {
                if (!old_questions) {
                    old_questions = document.getElementById('questions').innerHTML;
                }
                document.getElementById('questions').innerHTML = '';
                questions = res.questions;
                console.log(questions);
                setSearchData(questions, 1);
                // questions.forEach(question => {
                //     question_form = document.createElement('li');
                //     question_link = document.createElement('a');
                //     quetsion_title = document.createElement('p');
                //     question_link_href= "questions/" + question.id;
                //     question_link.setAttribute('href', question_link_href);
                //     question_link.textContent = question.question_title;
                //     quetsion_title.textContent = question.user_email;
                //     question_form.append(question_link);
                //     question_form.append(quetsion_title);
                //     document.getElementById('questions').append(question_form);
                // });
                if(document.getElementById('question_page')){
                    question_old_page = document.getElementById('question_page');
                    document.getElementById('question_page').remove();
                }else {
                    document.getElementById('searched_question_page').remove();
                }
                question_page = document.createElement('div');
                question_page.setAttribute('id', 'searched_question_page');
                question_page.setAttribute('class', 'text-center');
                for (let index = 1; index < questions.length / 3 + 1; index++) {
                    question_page_btn = document.createElement('button');
                    question_page_btn.setAttribute('class', 'btn btn-primary')
                    question_page_btn.textContent = index;
                    question_page_btn.addEventListener('click', () => {
                        setSearchData(questions, index);
                    })
                    question_page.append(question_page_btn);
                }
                document.getElementById('token').parentElement.append(question_page);
            })
        }else {
            window.alert('내용을 입력해주세요');
        }
    })
    document.getElementById('cancel_button').addEventListener('click', () => {
        if(question_old_page){
            document.getElementById('token').parentElement.lastChild.remove();
            document.getElementById('token').parentElement.append(question_old_page);
            document.getElementById('questions').innerHTML = old_questions;
        }
        question_old_page = ''
    })
});

function setSearchData(questions, page) {
    document.getElementById('questions').innerHTML = '';
    for (let index = (page - 1) * 3; index < page * 3 ; index++) {
        if (questions[index]){
            question_form = document.createElement('li');
            question_link = document.createElement('a');
            quetsion_title = document.createElement('p');
            question_link_href= "questions/" + questions[index].id;
            question_link.setAttribute('href', question_link_href);
            question_link.textContent = questions[index].question_title;
            quetsion_title.textContent = questions[index].user_email;
            question_form.append(question_link);
            question_form.append(quetsion_title);
            document.getElementById('questions').append(question_form);
        }
    }
}