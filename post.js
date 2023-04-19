

$(document).ready(function() {
    $(".delete-comment").click(function() {
        let commentID = $(this).attr('data-id');
        if(confirm("Are you sure you want to delete this comment?")) {
            window.location.href = "delete_comment_handler.php?comment_id=" + commentID;
        }
    });
    $(".delete-post").click(function (){
        let postID = $(this).attr('data-id');
        if(confirm("Are you sure you want to delete this post?")) {
            window.location.href = "delete_post_handler.php?post_id=" + postID;
        }
    });
});