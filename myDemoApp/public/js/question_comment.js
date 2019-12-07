var new_question_title = this.document.createElement('input');
new_question_title.setAttribute('type', 'text');
new_question_title.setAttribute('id', 'question_title');
new_question_title.setAttribute('style', 'font-size: 2em; display:block;')
// 바꿀 질문 제목

var new_question_content = this.document.createElement('textarea');
new_question_content.setAttribute('rows', '10');
new_question_content.setAttribute('id', 'question_content');
new_question_content.setAttribute('style', 'font-size: 1.17em; display:block;');
// 바꿀 질문 내용  

var old_question_title;
var old_question_content;
// 바꿔질 질문(지금 보이는 질문)

var no_data_comments_body;


window.addEventListener('load', function() {
    //화면이 다 띄어지면 뒤에 function 실행

    var question_update_btn = this.document.getElementById('q_update_btn');
    // 질문 수정 버튼

    old_question_title = this.document.getElementById('question_title');
    old_question_content = this.document.getElementById('question_content');

    if(!new_question_title.value) {
        new_question_title.value = old_question_title.textContent;
        new_question_content.value = old_question_content.textContent;
    }

    if(question_update_btn) {
        question_update_btn.addEventListener('click', () => {
            old_question_title = this.document.getElementById('question_title');
            old_question_content = this.document.getElementById('question_content');
            var button_textContent = question_update_btn.textContent;
    
            old_question_title.parentNode.replaceChild(new_question_title, old_question_title);
            change_element = old_question_title;
            old_question_title = new_question_title;
            new_question_title = change_element;
    
            old_question_content.parentNode.replaceChild(new_question_content, old_question_content);
            change_element = old_question_content;
            old_question_content = new_question_content;
            new_question_content = change_element;
    
            question_update_btn.textContent = (button_textContent == '완료') ? '수정' : '완료';
            question_update_btn.addEventListener('click', question_patch_event);
        })
    }

    document.querySelectorAll('.c_update_btn').forEach((c_update_btn)=> {
        var comment_body = c_update_btn.parentElement;
        comment_set_events(comment_body);
    })
    
    this.document.getElementById('c_create_btn').addEventListener('click', () => {
        fetch('/comments/create', {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json', 
                'X-CSRF-TOKEN': document.querySelector('#token').value,
            },
            method: "POST",
            body: JSON.stringify({
                question_id: document.getElementById('question_id').value,
                comment: document.getElementById('comment').value
            })
        })
        .then(res => res.json())
        .then((res) => {
            var comment_body = document.createElement('li');
            comment_body.innerHTML = document.querySelector('#comments').querySelector('li').innerHTML;
            comment_body.querySelector('h4').textContent = document.getElementById('comment').value;
            comment_body.querySelector('input').value = res.id;
            comment_body.querySelector('p').textContent = res.user_email;

            if(!comment_body.querySelector('.c_delete_btn')){
                var c_delete_btn = document.createElement('button');
                c_delete_btn.setAttribute('class','btn btn-primary c_delete_btn')
                c_delete_btn.textContent = '삭제';
                var c_update_btn = document.createElement('button');
                c_update_btn.setAttribute('class','btn btn-primary c_update_btn')
                c_update_btn.textContent = '수정';
                c_update_btn.style.marginRight = '4px';
                c_email = comment_body.querySelector('p');
                comment_body.append(c_delete_btn);
                comment_body.replaceChild(c_update_btn, c_email);
                comment_body.append(c_email);
            }

            comment_set_events(comment_body);

            if (document.querySelector('#comments').querySelector('li').getAttributeNames() == "hidden"){
                document.querySelector('#comments').innerHTML = '';
            }
            document.querySelector('#comments').append(comment_body);
            document.querySelector('#comment').value = '';
        })
    })
})

var question_patch_event = () => {
    fetch('/questions/update', {
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json', 
            'X-CSRF-TOKEN': document.querySelector('#token').value,
        },
        method: "PATCH",
        body: JSON.stringify({
            id: document.querySelector('#question_id').value,
            question_title: new_question_title.value,
            question_content: new_question_content.value,
        })
    })
    .then(res => res.json())
    .then((res) => {
        console.log(res);
        old_question_title.textContent = res.question_title;
        old_question_content.textContent = res.question_content;
        this.document.getElementById('q_update_btn').removeEventListener('click',question_patch_event);
    })
}

var comment_set_events = (comment_body) => {
    var comment_id = comment_body.querySelector('.comment_id').value;
    var c_delete_btn = comment_body.querySelector('.c_delete_btn');
    var c_update_btn = comment_body.querySelector('.c_update_btn');

    var new_comment = this.document.createElement('input');
    new_comment.setAttribute('type', 'text');
    new_comment.setAttribute('class', 'comment_comment');
    new_comment.setAttribute('style', 'font-size: 1.17em;');
    // 바꿀 댓글

    var old_comment;
    // 바꾸질 댓글(지금 보이는 댓글)

    c_delete_btn.addEventListener('click', () => {
        c_delete_btn.addEventListener('click',comment_delete_event(comment_body, comment_id));
    });


    c_update_btn.addEventListener('click', () => {
        var button_textContent = c_update_btn.textContent;
        old_comment = comment_body.querySelector('.comment_comment');
        if (!new_comment.value) {    
            new_comment.value = old_comment.textContent;
        }
        old_comment.parentNode.replaceChild(new_comment, old_comment);
        change_element = old_comment;
        old_comment = new_comment;
        new_comment = change_element;
        c_update_btn.textContent = (button_textContent == '완료') ? '수정' : '완료';
        if (new_comment.value) { 
            c_update_btn.addEventListener('click', comment_patch_event(c_update_btn, comment_id, new_comment, old_comment)); 
        }
    })
}

var comment_patch_event = (c_update_btn, comment_id, new_comment, old_comment) => {
    fetch('/comments/update', {
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json', 
            'X-CSRF-TOKEN': document.querySelector('#token').value,
        },
        method: "PATCH",
        body: JSON.stringify({
            id: comment_id,
            comment_comment: new_comment.value
        })
    })
    .then(res => res.json())
    .then((res) => {
        console.log(res);
        old_comment.textContent = res.comment;
        c_update_btn.removeEventListener('click', comment_patch_event);
    })
}

var comment_delete_event = (comment_body, comment_id) => {
    fetch('/comments/delete', {
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json', 
            'X-CSRF-TOKEN': document.querySelector('#token').value,
        },
        method: "DELETE",
        body: JSON.stringify({
            id: comment_id,
        })
    })
    .then(res => res.json())
    .then((res) => {
        if ( no_data_comments_body == undefined){
            no_data_comments_body = document.createElement('li');
            no_data_comments_body.setAttribute('hidden', 'true');
            no_data_comments_body.innerHTML = document.querySelector('#comments').querySelector('li').innerHTML;
        }
        comment_body.remove();
        if (document.querySelector('#comments').querySelector('li') == null) {
            document.querySelector('#comments').append(no_data_comments_body);
            document.querySelector('#comments').innerHTML += "<p>댓글이 없습니다</p>"
        }
    })
}
