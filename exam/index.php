<form method="POST" action="regok.php">
    <input type="text" name="name" placeholder="Name" /> <br />
    <input type="text" name="id" placeholder="ID" /> <br />
    <input type="password" name="password" placeholder="Password" /><br />
    <input type="password" name="repassword" placeholder="Re Password" /><br />
    <button type="submit">제출</button><br />
    <a href="select.php"><button type="button">필드 조회하러 가기</button></a> &nbsp;<br />
</form>

<?php

echo 123;
$arr_01 = array("1st" => "PHP", "2nd" => "MySQL");
$arr_02 = array("1st" => "HTML", "2nd" => "CSS", "3rd" => "JavaScript");
$result_01 = $arr_01 + $arr_02; // [PHP, MySQL, JavaScript]
$arr_03 = array();
var_dump($arr_01 instanceof ArrayObject);
$arr_03[10] = 1;
var_dump($arr_03);
var_dump(count($arr_03));

//var_dump($result_01);

$arr = array(1, 5, 7, 3, 3, 1, 2);
var_dump($arr);
$acv = array_count_values($arr);                 // 1 : 2번, 5 : 1번, 7 : 1번, 3 : 2번, 2 : 1번

foreach ($arr as $value) {
    echo $value;
}



?>