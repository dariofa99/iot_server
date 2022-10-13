<?php

require '../../vendor/autoload.php';

use App\Facades\Mqtt;
use \PhpMqtt\Client\MqttClient;
use \PhpMqtt\Client\ConnectionSettings;

$mqtt = new Mqtt();
$mqtt = $mqtt->conn();

/* $mqtt->subscribe(function($message){
    printf("Received message on topic [%s]: \n",$message);
}); */

 $mqtt->subscribe('mgtic/luz', function ($topic, $message) {
    printf("Received message on topic [%s]: %s\n", $topic, $message);
    $data = json_decode($message);
    $data = json_encode($data);
    printf("Received [%s]: %s\n",$data[0],$message['protocol']);
    printf("Received [%s]:\n",$message['protocol']);
    var_dump($data);
}, 0);
$mqtt->loop(true); 






