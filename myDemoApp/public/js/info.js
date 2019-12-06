var old_info_outline;
var old_info_objective;

var new_info_outline = this.document.createElement('input');
new_info_outline.setAttribute('type', 'text');
new_info_outline.setAttribute('id', 'info_outline');
new_info_outline.setAttribute('rows', '10');
new_info_outline.setAttribute('class', 'form-control');

var new_info_objective = this.document.createElement('input');
new_info_objective.setAttribute('type', 'text');
new_info_objective.setAttribute('id', 'info_objective');
new_info_objective.setAttribute('rows', '10');
new_info_objective.setAttribute('class', 'form-control');


window.addEventListener('load', function() {
    // 개요 및 목표 수정 버튼 클릭시
    console.log();
    this.document.getElementById('info_update_btn').addEventListener('click', () => {
        old_info_outline = this.document.getElementById('info_outline');
        old_info_objective = this.document.getElementById('info_objective');
        var btn_info = this.document.getElementById('info_update_btn').textContent;

        old_info_outline.parentNode.replaceChild(new_info_outline, old_info_outline);
        change_element = old_info_outline;
        old_info_outline = new_info_outline;
        new_info_outline = change_element;
        console.log(old_info_outline);
        console.log(new_info_outline);

        old_info_objective.parentNode.replaceChild(new_info_objective, old_info_objective);
        change_element = old_info_objective;
        old_info_objective = new_info_objective;
        new_info_objective = change_element;
        console.log(old_info_objective);
        console.log(new_info_objective);

        this.document.getElementById('info_update_btn').textContent = (btn_info == "완료") ? "수정" : "완료";
        this.document.getElementById('info_update_btn').addEventListener('click', info_patch_event);
    });
})

var info_patch_event = () => {
    fetch('/infos/update', {
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json', 
            'X-CSRF-TOKEN': document.querySelector('#token').value,
        },
        method: "PATCH",
        body: JSON.stringify({
            id: document.querySelector('#info_id').value,
            info_outline: new_info_outline.value,
            info_objective: new_info_objective.value,
        })
    })
    .then(res => res.json())
    .then( (res) => {
        console.log(res);
        old_info_outline.textContent = res.outline;
        old_info_objective.textContent = res.objective;
        document.querySelector('#info_update_btn').removeEventListener('click', info_patch_event);
    })
}


function zoom_in(event) {
    event.target.style.transform = "scale(1.2)";
    event.target.style.zindex = 1;
    event.target.style.transition = "all 0.5s";
}

function zoom_out(event) {
    event.target.style.transform = "scale(1)";
    event.target.style.zindex = 0;
    event.target.style.transition = "all 0.5s";
}