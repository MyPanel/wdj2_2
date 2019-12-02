var question_old_page;
var old_questions;

window.addEventListener('load', function() { 
    document.getElementById('serach_button').addEventListener('click',function() {
        var menu = document.getElementById('search_menu');
        menus = menu.options;
        index = menu.selectedIndex;
        question_title = menus[index].text;
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
                    question_page_btn.setAttribute('class', 'btn btn-primary search_btn')
                    if (index == 1) {
                        question_page_btn.style.color = "#FFFFFF";
                        question_page_btn.style.backgroundColor = "#3490dc";
                    }
                    else
                    {
                        question_page_btn.style.backgroundColor = "#FFFFFF";
                        question_page_btn.style.color = "#3490dc";        
                    }
                    question_page_btn.textContent = index;
                    question_page_btn.addEventListener('click', (e) => {
                        document.querySelectorAll('.search_btn').forEach((btn)=>{
                            btn.style.backgroundColor = "#FFFFFF";
                            btn.style.color = "#3490dc";       
                        })
                        e.currentTarget.style.color = "#FFFFFF";
                        e.currentTarget.style.backgroundColor = "#3490dc";

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
            question_content = document.createElement('p');
            question_content.setAttribute('class', 'question_content');
            question_link_href= "questions/" + questions[index].id;
            question_link.setAttribute('href', question_link_href);
            question_link.textContent = questions[index].question_title;
            quetsion_title.textContent = questions[index].user_email;
            question_content.innerHTML = questions[index].question_content.replace(/\n/gi,"<br>");
            question_content.style.height = "50px";
            question_content.style.width = "302px";
            question_content.style.overflow = "hidden";
            question_link.style.fontSize = "1.17em";
            question_form.append(question_link);
            question_form.append(question_content);
            question_form.append(quetsion_title);
            document.getElementById('questions').append(question_form);
        }
    }
}