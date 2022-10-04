<?php

namespace App\Facades;


use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;

class Mqtt 
{
    
       private $server;
       private $port;
       private $clientId;
       private $username ;
       private $password ;
       private $clean_session ;
       private $interval ;
       private $topic ;
       private $connectionSettings;
       private $mqtt;
       private $message;

    public function __construct(){
        $this->server = '10.20.65.135';
        $this->port = 1883;
        $this->clientId = rand(5, 15);
        $this->username = 'mgtic';
        $this->password = null;
        $this->clean_session = false;  
        $this->interval = 60; 
        $this->topic = 'mgtic/luz';    
        
       
        $this->connectionSettings  = new ConnectionSettings();
        $this->connectionSettings
        ->setUsername($this->username)
        ->setPassword($this->password)
        ->setKeepAliveInterval($this->interval)
        ->setLastWillTopic($this->topic)
        ->setLastWillMessage('client disconnect')
        ->setLastWillQualityOfService(1);
        $this->mqtt = new MqttClient($this->server, $this->port, $this->clientId);
        $this->mqtt->connect($this->connectionSettings, $this->clean_session);
        printf("client connected\n");
        /* $this->mqtt->subscribe($this->topic, function ($topic, $message) {
            printf("Received message on topic [%s]: %s\n", $topic, $message);
            }, 0);
        $this->mqtt->loop(true); */
        
    }

    public function server($server){
      $this->server = $server;
      $this->connection();
      return $this;
    }

    public function port($port){
        $this->port = $port;
        $this->connection();
        return $this; 
    }

    public function clientId($clientId){
        $this->clientId = $clientId;
        $this->connection();
        return $this; 
    }

    public function username($username){
        $this->username = $username;
        $this->connection();
        return $this; 
    }

    public function password($password){
        $this->password = $password;
        $this->connection();
        return $this; 
    }

    public function clean_session(Bool $clean_session){
        $this->clean_session = $clean_session;
        $this->connection();
        return $this; 
    }

    public function interval(Int $interval){
        $this->interval = $interval;
        $this->connection();
        return $this; 
    }

    public function topic($topic){
        $this->topic = $topic;
        $this->connection();
        return $this; 
    }

    public function message(Array $message){
        $this->message = $message;
        
        return $this; 
    }
    public function connection(){
        $this->connectionSettings  = new ConnectionSettings();
        $this->connectionSettings
        ->setUsername($this->username)
        ->setPassword($this->password)
        ->setKeepAliveInterval($this->interval)
        ->setLastWillTopic($this->topic)
        ->setLastWillMessage('client disconnect')
        ->setLastWillQualityOfService(1);
        $this->mqtt = new MqttClient($this->server, $this->port, $this->clientId);
        $this->mqtt->connect($this->connectionSettings, $this->clean_session);
        
        return $this; 
    }
    public function suscribe(){
        $this->mqtt->subscribe($this->topic, function ($topic, $message) {
            printf("Received message on topic [%s]: %s\n", $topic, $message);
            }, 0);
        $this->mqtt->loop(true);
    }

      public function publish(){
           $this->mqtt->publish($this->topic,json_encode($this->message),0,true);
           $this->mqtt->disconnect();;
            return $this;
        }
  

}

