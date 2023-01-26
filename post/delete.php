<?php
    include sprintf("%s/fragments/dbConnect.php", $_SERVER['DOCUMENT_ROOT']);
    function alert($str) {
        echo "<script>alert('".$str."'); location.href='/untitled/post/list.php'; </script>";
        exit;
    }

    $postId = $_GET['postId'];
    $postsId = $_POST['post_id'];

if ($postsId == null) {
    $query = "delete from post where id='$postId'";
    if (!mysqli_query($connect, $query)) {
        alert("값이 삭제되지 않았습니다");
    }
}else {
    foreach ($postsId as $post) {
        $query = "delete from post where id='$post'";
        if (!mysqli_query($connect, $query)) {
            alert("값이 삭제되지 않았습니다");
        }
    }
}


    alert(sprintf("%d 번째 값이 삭제되었습니다.", $postId));
?>
