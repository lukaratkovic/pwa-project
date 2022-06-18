function deleteArticle(id){
    let article = document.getElementById(id);
    if(!confirm(`Are you sure you want to delete "${article.innerHTML}"?`))
        return;

    $.ajax({
        type: 'post',
        url: './deleteArticle.php',
        data: {
            id: id
        },
        success: ()=>{
            location.reload();
        }
    });
}

function editArticle(){
    
}