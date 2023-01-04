<?php

session_start();

$connect = mysqli_connect("localhost", "root", "7pifz9!!", "loginexam") or die("fail");

        //입력 받은 id와 password
        $id=$_POST['nickname'];
        $pw=$_POST['password'];
        $email=$_POST['email'];
        echo "<h2> id,pw : $pw";


//아이디가 있는지 검사
        $query = "select * from member where nickname='$id'";
        echo "<h2> login.php query : $query </h2>";
        $result = $connect->query($query);

        echo "<h2> pw : $pw";

        //db에 아이디가 있다면 비밀번호 검사
        if(mysqli_num_rows($result)==1) {
                $row=mysqli_fetch_assoc($result);
                //db에 저장된 password하고 $pw값 비교 , 비밀번호가 맞다면 세션 생성
                if($row['password']==$pw){
                        $_SESSION['userid']=$id;
                        $_SESSION['userpw']=$pw;
                        $_SESSION['useremail']=$email;
                    setcookie('id', $id);
                    setcookie('pw', $pw);
                    setcookie('email', $email);
                    echo "<h2>쿠키 아이디 : ";
                    echo $_COOKIE['id']."<br />";
                    if(isset($_SESSION['useremail'])){
                        ?>      <script>
                                        alert("로그인 되었습니다.");
                                        location.replace("./mainpage.html");
                                </script>
<?php
                        }
                        else{
                                echo "session fail";
                        }
                }

                else {
        ?>              <script>
                                alert("아이디 혹은 비밀번호가 잘못되었습니다.");
                                history.back();
                        </script>
        <?php
                }

        }

                else{
?>              <script>
                        alert("아이디 혹은 비밀번호가 잘못되었습니다.");
                        history.back();
                </script>
<?php
        }


?>
