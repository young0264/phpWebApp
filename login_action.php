<?php

$nickname = $_GET['nickname'];
$password = $_GET['password'];
$email = $_GET['email'];

$connect = mysqli_connect("localhost", "root", "7pifz9!!", "loginexam") or die("fail");

$signup = "insert into register (nickname, password, email) values ('$nickname', '$password', '$email') ";

if ($connect->query($signup)) {
    echo "sign up success!!</br >";
    echo "<a href=mainpage.html>로그인 페이지로 이동</a> ";
} else {
    echo "fail to insert sql";
}
?>