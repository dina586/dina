<?php
    $name = isset($_POST['name'])?$_POST['name']:'';
    $phone = isset($_POST['phone'])?$_POST['phone']:'';
    $email = isset($_POST['email'])?$_POST['email']:'';
    
    $address = 'svarokmaster@gmail.com';
    $sub = "Сообщение";
    $mes = "Автор назвался: $name \nУказал свой телефон: $phone \nУказал свой адрес: $email";
    $verify = mail ($address,$sub,$mes,"Content-type: text/html; charset=utf-8\r\nFrom:$email");
    if ($verify == 'true')
        {
            echo '0';
        }
    else
        {
            echo "-1";
        }
?>