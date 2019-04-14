<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/3
 * Time: 10:06
 */
$notify=$_POST;
file_put_contents('D:/log/l' . time() . '.txt', print_r($notify, true), FILE_APPEND);