<?php
require_once __DIR__.'/vendor/autoload.php';
$faker=Faker\Factory::create();
$member_type_arr=array('guest','Silver','Gold','Platinum');
$link=new mysqli('localhost','root','mysql','open');
for($i=3;$i<53;$i++){
    $first_name=$link->real_escape_string($faker->firstName);
    $last_name=$link->real_escape_string(($faker->lastName));
    $phone=$link->real_escape_string($faker->phoneNumber);
    $member_type=$link->real_escape_string($member_type_arr[rand(0,3)]);
    $address=$link->real_escape_string($faker->address);
    $email=$link->real_escape_string($faker->email);
    $c=rand(1,30);
    $sql="INSERT INTO `members`(`id`, `first_name`, `last_name`, `phone`, `member_type`, `expiry_date`, `address`, `mail_address`)"
         ."VALUES              (NULL,'{$first_name}','{$last_name}','{$phone}','{$member_type}',NOW()+INTERVAL $c DAY,'{$address}','{$email}')"
    ;
    $res=$link->query($sql);
    if($res===false){
        echo $link->error;
    }
}

$link->close();