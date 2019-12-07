var file;
var new_img = this.document.createElement('input');
new_img.setAttribute('type', 'file');
new_img.setAttribute('id', 'img');
new_img.addEventListener("change", handleFiles, false);
function handleFiles() {
    file = this.files[0];
}

var new_name = this.document.createElement('input');
new_name.setAttribute('type', 'text');
new_name.setAttribute('id', 'name');
new_name.setAttribute('class', 'form-control input-lg')

var new_content = this.document.createElement('textarea');
new_content.setAttribute('id', 'content');
new_content.setAttribute('rows', '10');
new_content.setAttribute('class', 'form-control input-lg');

var old_img;
var old_name;
var old_content;
var filename;

window.addEventListener('load', function() {
    this.document.getElementById('m_update_btn').addEventListener('click', ()=>{
        old_img = this.document.getElementById('img');
        old_name = this.document.getElementById('name');
        old_content = this.document.getElementById('content');
        var button_textContent = this.document.getElementById('m_update_btn').textContent;

        old_img.parentNode.replaceChild(new_img, old_img);
        file_path = old_img.value;
        if(file) {
            var fr = new FileReader();
            fr.onload = function () {
                old_img.src = fr.result;
            }
            fr.readAsDataURL(file);
        }
        if (file_path) {
            var startIndex = (file_path.indexOf('\\') >= 0 ? file_path.lastIndexOf('\\') : file_path.lastIndexOf('/'));
            filename = file_path.substring(startIndex);
            if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                filename = filename.substring(1);
            }
            //alert(filename); // 파일이름 확인 ex) lemon.jpg
        }
        
        change_element = old_img;
        old_img = new_img;
        new_img = change_element;
        
        old_name.parentNode.replaceChild(new_name, old_name);
        change_element = old_name;
        old_name = new_name;
        new_name = change_element;

        old_content.parentNode.replaceChild(new_content, old_content);
        change_element = old_content;
        old_content = new_content;
        new_content = change_element;

        this.document.getElementById('m_update_btn').textContent = (button_textContent == '수정완료') ? '조원수정' : '수정완료';
        this.document.getElementById('m_update_btn').addEventListener('click', member_patch_event);
    })
})
    
var member_patch_event = () => {
      
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

        fetch('/members/update', {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json', 
                'X-CSRF-TOKEN': document.querySelector('#token').value,
            },
            method: "PATCH",
            body: JSON.stringify({
                member_id : document.getElementById('member_id').value,
                member_path : filename,
                member_name : new_name.value,
                member_content : new_content.value,
            })
        }).then(res => res.json())
        .then((res) => {
            console.log(res);
            old_name.textContent = res.name;
            old_content.textContent = res.content;
            document.querySelector('#m_update_btn').removeEventListener('click',member_patch_event);
        }) 
    })
}
