let changeComment = document.getElementById("changeComment");
let submit = document.getElementById("submit");
let id = document.getElementById("container").dataset.id;
let containerCommentary = document.getElementById("containerCommentary");
let userId = document.getElementById("user").value;

//send a comment in Ajax
submit.addEventListener("click", function(e){
    e.preventDefault();
    if(changeComment.value.length > 0){
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "../../api/comment/post.php");
        xhr.onload = () => {
            changeComment.value = "";
        }
        xhr.send(JSON.stringify({
            "user" : userId,
            "articleId" : id,
            "content" : changeComment.value,
        }));
    }
})

//Display comments in Ajax
function load(){
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "../../api/comment/get.php?id=" + id);
    xhr.send();
    xhr.onload = () => {
        containerCommentary.innerHTML = "";
        let result = JSON.parse(xhr.responseText);
        for (let comment of result) {
            let html = `
                <div data-id="${comment["id"]}" class="comment">
                    <p class="date">Publié le ${comment["publish"]}</p>
                    <div>
                        <p class="author">${comment["author"]} :</p>
                        <p class="content">${comment["content"]}</p>
                    </div>
            `
            if(comment["admin"] === 1 || comment["user"] === comment["author"]) {
                html += `<span class='close'><i class="fas fa-times"></i></span>`;
            }

            containerCommentary.innerHTML += html + `</div> <hr>`;
        }
        let closes = document.getElementsByClassName("close");
        for (let close of closes) {
            close.addEventListener("click", function () {
                let id = close.parentNode.dataset.id;
                let xhr2 = new XMLHttpRequest();
                xhr2.open("POST", "../../api/comment/post.php?delete=true")
                xhr2.send(JSON.stringify({"id":id}));
            })
        }
    }
}

function timeOut(){
    setTimeout(() => {
        load();
        timeOut();
    }, 1000);
}

load();
timeOut();
