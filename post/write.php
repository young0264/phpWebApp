<?php
date_default_timezone_set('Asia/Seoul');
$connect = mysqli_connect("localhost", "root", "7pifz9!!", "loginexam") or die("fail");



$username = $_COOKIE['id'];
$title = $_POST['title'];
$content = $_POST['content'];
$date = date('Y-m-d H:i:s');

echo "<h2>$title</h2>";
echo "<h2>$content</h2>";
echo "<h2>$date</h2>";

$upload_dir = 'uploads/';
$upload_file = $upload_dir . $_FILES['SelectFile']['name'];

$file_name = iconv("utf-8","CP949",$upload_file);
//echo "<script>
//  alert('$tmpfile');
//  </script>";
//print "<pre>";
//if (move_uploaded_file($_FILES['SelectFile']['tmp_name'], $file_name)) {
//    print "[수신한 내용]<br><br>";
//    print "PATH: " .$upload_file."<br>";
//    print "제목 : ".$_POST['title']."<br>";
//    print "내용 : ".$_POST['content']."<br>";
//    print "파일 :".$_FILES['SelectFile']['type']."<br>";
//    if($_FILES['SelectFile']['type']=="image/jpeg"||$_FILES['SelectFile']['type']=="image/gif"){
//        print "<img src=$upload_file width='300'>";
//    }
//}
//else {
//    print "파일 업로드  실패 : ";
//    switch ($_FILES[SelectFile][error]) {
//        case UPLOAD_ERR_INI_SIZE:
//            print "php.ini 파일의 upload_max_filesize(".ini_get("upload_max_filesize").")보다 큽니다.<br>";
//            break;
//        case UPLOAD_ERR_FORM_SIZE:
//            print "업로드 한 파일이 Form의 MAX_FILE_SIZE 값보다 큽니다.<br>";
//            break;
//        case UPLOAD_ERR_PARTIAL:
//            print "파일의 일부분만 전송되었습니다.<br>";
//            break;
//        case UPLOAD_ERR_NO_FILE:
//            print "파일이 전송되지 않았습니다.<br>";
//            break;
//        case UPLOAD_ERR_NO_TMP_DIR:
//            print "임시 디렉토리가 없습니다.<br>";
//            break;
//    }
//    print_r($_FILES);
//}
//print "</pre>";

if($username && $title && $content){
    echo "<h2>11111111</h2>";

    $query = "insert into post (title, content, created, nickname ) values ('$title', '$content', '$date' ,'$username')";
    echo "<h2>$query</h2>";
    $result = mysqli_query($connect, $query);

    ?>
        "<script>
        alert('글쓰기 완료되었습니다.');
        location.replace("/post/list.php");
</script>";
<?php

}
else{
    echo "<script>
      alert('글쓰기에 실패했습니다.');
      history.back();</script>";
}
?>