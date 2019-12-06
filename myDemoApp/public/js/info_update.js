var old_place_img;
var old_place_title;
var old_place_body;

var file;
var filename;

var new_place_title = this.document.createElement('textarea');
new_place_title.setAttribute('name', 'place_title');
new_place_title.setAttribute('id', 'place_title');
new_place_title.setAttribute('class', 'form-control input-lg')

var new_place_body = this.document.createElement('textarea');
new_place_body.setAttribute('name', 'place_body');
new_place_body.setAttribute('id', 'place_body');
new_place_body.setAttribute('class', 'form-control input-lg')
new_place_body.setAttribute('rows', '10');

var new_place_img = this.document.createElement('input');
new_place_img.setAttribute('type', 'file');
new_place_img.setAttribute('id', 'place_img');
new_place_img.addEventListener("change", handleFiles, false);
function handleFiles() {
    file = this.files[0]; /* now you can work with the file list */
}


window.addEventListener('load', function() {
    // place/show 에서 수정하기 버튼 클릭했을 때
    this.document.getElementById('p_update_btn').addEventListener('click', () => {
        old_place_img = this.document.getElementById('place_img');
        old_place_title = this.document.getElementById('place_title');
        old_place_body = this.document.getElementById('place_body');
        var btn_place = this.document.getElementById('p_update_btn').textContent;
        
        old_place_img.parentNode.replaceChild(new_place_img, old_place_img);
        file_path = old_place_img.value;
        if(file) {
            var fr = new FileReader();
            fr.onload = function () {
                old_place_img.src = fr.result;
            }
            fr.readAsDataURL(file);
            console.log(fr.result);
        }
        console.log(file_path);
        console.log(file);
        if (file_path) {
            var startIndex = (file_path.indexOf('\\') >= 0 ? file_path.lastIndexOf('\\') : file_path.lastIndexOf('/'));
            filename = file_path.substring(startIndex);
            if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                filename = filename.substring(1);
            }
            alert(filename); 
        }
        
        change_element = old_place_img;
        old_place_img = new_place_img;
        new_place_img = change_element;

        old_place_title.parentNode.replaceChild(new_place_title, old_place_title);
        change_element = old_place_title;
        old_place_title = new_place_title;
        new_place_title = change_element;

        old_place_body.parentNode.replaceChild(new_place_body, old_place_body);
        change_element = old_place_body;
        old_place_body = new_place_body;
        new_place_body = change_element;  

        this.document.getElementById('p_update_btn').textContent = (btn_place == "완료") ? "수정" : "완료";
        this.document.getElementById('p_update_btn').addEventListener('click', place_patch_event);
    })
})

var place_patch_event = () => {
    console.log(file);
    var fileData = new FormData();
    fileData.append('place_img', file);
    console.log(fileData.getAll('place_img')); 

    fetch('/places/upload', {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('#token').value,
        },
        method: "POST",
        body: fileData
    })
    .then(res => res.json())
    .then( (res) => {
        console.log(res);
        filename = res;
        
        fetch('/places/update', {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json', 
                'X-CSRF-TOKEN': document.querySelector('#token').value,
            },
            method: "PATCH",
            body: JSON.stringify({
                place_id : document.getElementById('place_id').value,
                place_img : filename,
                place_title : new_place_title.value,
                place_body : new_place_body.value,
            })
        })
        .then(res => res.json())
        .then( (res) => {
            console.log(res);
            old_place_title.textContent = res.title;
            old_place_body.textConatent = res.body;
            document.querySelector('#p_update_btn').removeEventListener('click',place_patch_event);
        })
    })
}