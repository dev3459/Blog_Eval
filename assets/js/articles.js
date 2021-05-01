//Recovery of all the elements
let closes = document.getElementsByClassName("close");

//Delete article select
for(let close of closes){
    close.addEventListener("click", function(e){
        let id = close.parentNode.dataset.id;
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "../../api/articles/post.php");
        xhr.onload = () => {
            document.location.reload();
        }
        xhr.send(JSON.stringify({"id" :id}))

    })
}