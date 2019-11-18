var new_question_title = this.document.createElement('input');
new_question_title.setAttribute('type', 'text');
new_question_title.setAttribute('id', 'question_title');
new_question_title.setAttribute('style', 'font-size: 2em;')

var new_question_content = this.document.createElement('input');
new_question_content.setAttribute('type', 'text');
new_question_content.setAttribute('id', 'question_content');
new_question_content.setAttribute('style', 'font-size: 1.17em;');

var old_question_title;
var old_question_content;

var new_comment = this.document.createElement('input');
new_comment.setAttribute('type', 'text');
new_comment.setAttribute('class', 'comment_comment');
new_comment.setAttribute('style', 'font-size: 1.17em;');

var old_comment;

window.addEventListener('load', function() {
    this.document.getElementById('q_update_btn').addEventListener('click', () => {
        old_question_title = this.document.getElementById('question_title');
        old_question_content = this.document.getElementById('question_content');
        var button_textContent = this.document.getElementById('q_update_btn').textContent;

        old_question_title.parentNode.replaceChild(new_question_title, old_question_title);
        change_element = old_question_title;
        old_question_title = new_question_title;
        new_question_title = change_element;

        old_question_content.parentNode.replaceChild(new_question_content, old_question_content);
        change_element = old_question_content;
        old_question_content = new_question_content;
        new_question_content = change_element;

        this.document.getElementById('q_update_btn').textContent = (button_textContent == '완료') ? '수정' : '완료';
        this.document.getElementById('q_update_btn').addEventListener('click', question_patch_event);
    })
    document.querySelectorAll('.c_update_btn').forEach((c_update_btn)=> {
        var comment_body = c_update_btn.parentElement;
        var comment_id = comment_body.querySelector('.comment_id').value;
        var c_delete_btn = comment_body.querySelector('.c_delete_btn');

        c_delete_btn.addEventListener('click', () => {
            c_delete_btn.addEventListener('click',comment_delete_event(comment_body, comment_id));
        });

        c_update_btn.addEventListener('click', () => {
            var button_textContent = comment_body.querySelector('.c_update_btn').textContent;
            old_comment = comment_body.querySelector('.comment_comment');
            old_comment.parentNode.replaceChild(new_comment, old_comment);
            change_element = old_comment;
            old_comment = new_comment;
            new_comment = change_element;
            document.getElementsByName
    
            comment_body.querySelector('.c_update_btn').textContent = (button_textContent == '완료') ? '수정' : '완료';
            comment_body.querySelector('.c_update_btn').addEventListener('click', comment_patch_event(comment_body, comment_id));    
        })
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
            console.log(res);
            var comment_body = document.createElement('li');
            comment_body.innerHTML = document.querySelector('#comments').querySelector('li').innerHTML;
            comment_body.removeAttribute('hidden');
            comment_body.querySelector('h4').textContent = document.getElementById('comment').value;
            comment_body.querySelector('input').value = res.id;
            comment_body.querySelector('p').textContent = res.user_email;
            var c_update_btn = comment_body.querySelector('.c_update_btn');
            var c_delete_btn= comment_body.querySelector('.c_delete_btn');
            c_delete_btn.addEventListener('click', () => {
                c_delete_btn.addEventListener('click',comment_delete_event(comment_body, res.id));
            });
            c_update_btn.addEventListener('click', () => {
                var button_textContent = comment_body.querySelector('.c_update_btn').textContent;
                old_comment = comment_body.querySelector('.comment_comment');
                old_comment.parentNode.replaceChild(new_comment, old_comment);
                change_element = old_comment;
                old_comment = new_comment;
                new_comment = change_element;
        
                comment_body.querySelector('.c_update_btn').textContent = (button_textContent == '완료') ? '수정' : '완료';
                comment_body.querySelector('.c_update_btn').addEventListener('click', comment_patch_event(comment_body, res.id));    
            })
            document.querySelector('#comments').append(comment_body);
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
        document.querySelector('#q_update_btn').removeEventListener('click',question_patch_event);
    })
}
var comment_patch_event = (comment_body, comment_id) => {
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
        comment_body.querySelector('.c_update_btn').removeEventListener('click',question_patch_event);
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
        console.log(res);
        comment_body.remove();
    })
}