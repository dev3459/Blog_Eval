//Recovery of all the elements
let articleContent = document.getElementById("content");
let change = document.getElementById("change");
let textarea = document.createElement("textarea");
let content = articleContent.innerHTML;
let idArticle = document.getElementById("container").dataset.id;
let edit = false;

//Changing the content of the article by pressing the button called change
if(change){
    change.addEventListener("click", function(){
        if(edit){
            articleContent.innerHTML = textarea.value;
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "../../api/articles/post.php?id=" + idArticle);
            xhr.send(JSON.stringify({"content": textarea.value}));
            textarea.parentNode.replaceChild(articleContent, textarea);
            edit = false;
        }else{
            textarea.style.height = window.getComputedStyle(articleContent).getPropertyValue("height");
            textarea.style.width = window.getComputedStyle(articleContent).getPropertyValue("width");
            textarea.style.minHeight = "200px";
            textarea.style.minWidth = "200px";
            textarea.style.maxWidth = "100%";
            textarea.value = articleContent.innerHTML;

            articleContent.parentNode.replaceChild(textarea, articleContent);
            edit = true;
        }
    });
}

