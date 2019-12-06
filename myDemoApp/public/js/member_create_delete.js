var file;
var img_div = document.createElement('div');
// img_div 라는 div 영역 생성
img_div.setAttribute('class', 'imgdiv');
// img_div의 속성 class="imgdiv"
// <div class="imgdiv">
var new_img = document.createElement('input');
// new_img라는 input 태그 생성
new_img.setAttribute('type', 'file');
// new_img input 태그의 속성 type="file"
new_img.setAttribute('id', 'img');
// new_img input 태그의 속성 id="img"
// <input type="file" id="img">
new_img.addEventListener("change", handleFiles, false);
// new_img 태그의 change 리스너 추가 
// handleFiles함수==>input태그에 저장된 파일 리턴
function handleFiles(){
    file = this.files[0];
}

var name_div = document.createElement('div');
// name_div라는 변수에 div영역 생성
name_div.setAttribute('class', 'namediv');
// 속성 class="namediv" 추가
var new_name = document.createElement('input');
// new_name 변수에 input 태그 생성
new_name.setAttribute('type', 'text');
// 
new_name.setAttribute('id', 'name');
new_name.setAttribute('class', 'form-control input-lg');

var content_div = document.createElement('div');
content_div.setAttribute('class', 'contentdiv');
var new_content = this.document.createElement('textarea');
new_content.setAttribute('id', 'content');
new_content.setAttribute('rows', '10');
new_content.setAttribute('class', 'form-control input-lg');

var body_div = document.createElement('div');
body_div.setAttribute('class', 'jumbotron text-center bodydiv');

var a;
var deleteMember;

window.addEventListener('load', function() {
    deleteMember = () => {
        document.querySelectorAll('.member_body').forEach((body) => {
            // querySelectorAll() => .member_body div 영역의 하위 요소들
            // 배열 형태로 반환
            // foreach()
            body.querySelector('.m_delete_btn').addEventListener('click', () => {
                console.log(body.querySelector('#member_id').value);
                fetch('/members/delete', {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json', 
                        'X-CSRF-TOKEN': document.querySelector('#token').value,
                    },
                    method: "DELETE",
                    body: JSON.stringify({
                        member_id : body.querySelector('#member_id').value,
                    })
                }).then(res => res.json())
                .then((res) => {
                body.remove();
                })
            })
        })
    };
    deleteMember();

    this.document.getElementById('m_create_btn').addEventListener('click', ()=>{
        var button_textContent = this.document.getElementById('m_create_btn').textContent;
        if(!document.querySelector('.imgdiv')){
            a = document.querySelector('.body').innerHTML;
        }
        this.console.log(a);
        document.querySelector('.body').innerHTML="";
        img_div.append(new_img);
        name_div.append(new_name);
        content_div.append(new_content);

        body_div.append(img_div);
        body_div.append(name_div);
        body_div.append(content_div);
        

        document.querySelector('.body').append(body_div);

        file_path = new_img.value;
        if(file) {
            var fr = new FileReader();
            fr.onload = function () {
                new_img.src = fr.result;
            }
            fr.readAsDataURL(file);
        }
        if (file_path) {
            var startIndex = (file_path.indexOf('\\') >= 0 ? file_path.lastIndexOf('\\') : file_path.lastIndexOf('/'));
            filename = file_path.substring(startIndex);
            if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                filename = filename.substring(1);
            }
            alert(filename); // 파일이름 확인 ex) lemon.jpg
        }

        this.document.getElementById('m_create_btn').textContent = (button_textContent == '추가완료') ? '조원추가' : '추가완료';
        this.document.getElementById('m_create_btn').addEventListener('click', member_create_event);
    });
})

var member_create_event = () => {
    
    var fileData = new FormData();
    fileData.append('img', file);
    console.log(fileData.getAll('img')); 

    fetch('/members/upload', {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('#token').value,
        },
        method: "POST",
        body: fileData
    }).then(res => res.json())
    .then((res)=> {
        console.log(res);
        filename = res;

        fetch('/members/create', {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json', 
                'X-CSRF-TOKEN': document.querySelector('#token').value,
            },
            method: "POST",
            body: JSON.stringify({
                member_path : filename,
                member_name : new_name.value,
                member_content : new_content.value,
            })
        }).then(res => res.json()) // 응답받은 json
        .then((res) => {
            console.log(res);
            console.log(a);
            document.querySelector('.body').innerHTML = a;
            var member_div = document.createElement('div');
            member_div.setAttribute('class', 'col-lg-3 col-md-6 mb-4 member_body');

            var input = document.createElement('input');
            input.setAttribute('type', 'hidden');
            input.setAttribute('name', 'member_id');
            input.setAttribute('id', 'member_id');
            input.setAttribute('class', 'm_delete');
            input.setAttribute('value', res.id); // 수정

            var card_div = document.createElement('div');
            card_div.setAttribute('class', 'card h-100');

            var card_img = document.createElement('img');
            card_img.setAttribute('class', 'card-img-top');
            card_img.setAttribute('src', '/images/'.concat(filename));
            card_img.setAttribute('alt', '이미지 없음');

            var card_body = document.createElement('div');
            card_body.setAttribute('class', 'card-body');

            var card_title = document.createElement('h4');
            card_title.setAttribute('class', 'card-title');
            card_title.textContent = new_name.value;

            var card_text = document.createElement('p');
            card_text.setAttribute('class', 'card-text');
            card_text.textContent = new_content.value;

            var card_footer = document.createElement('div');
            card_footer.setAttribute('class', 'card-footer');

            var showUri = 'members/'.concat(res.id);
            var m_show_btn = document.createElement('a');
            m_show_btn.setAttribute('class', 'btn btn-primary m_show_btn');
            m_show_btn.setAttribute('href', showUri);
            m_show_btn.textContent = "상세보기";

            var m_delete_btn = document.createElement('button'); // 수정
            m_delete_btn.setAttribute('class', 'btn btn-danger m_delete_btn');
            m_delete_btn.textContent = "조원삭제";
            
            card_div.append(card_img);
            card_div.append(card_body);
            card_body.append(card_title);
            card_body.append(card_text);
            card_footer.append(m_show_btn);
            card_footer.append(m_delete_btn);
            card_div.append(card_footer);

            member_div.append(input);
            member_div.append(card_div);
            
            document.querySelector('.body').append(member_div);

            deleteMember();
            document.querySelector('#m_create_btn').removeEventListener('click', member_create_event);
        })
    })
}

