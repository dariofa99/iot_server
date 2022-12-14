<?php

namespace App\Facades;

use App\Models\DashboardChartTopic;
use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;

class Mqtt
{

    private $server;
    private $port;
    private $clientId;
    private $username;
    private $password;
    private $clean_session;
    private $interval;
    private $topic;
    private $connectionSettings;
    private $mqtt;
    private $message;

    public function __construct()
    {
        $this->server = '3.18.87.25';
        $this->port = 1883;
        $this->clientId = rand(5, 15);
        $this->username = 'mgtic';
        $this->password = null;
        $this->clean_session = false;
        $this->interval = 60;
        $this->topic = '/mgtic/luz';


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
         //printf("client connected\n");
        /* $this->mqtt->subscribe($this->topic, function ($topic, $message) {
            printf("Received message on topic [%s]: %s\n", $topic, $message);
            }, 0);
        $this->mqtt->loop(true); */
    }

    public function server($server)
    {
        $this->server = $server;
        $this->connection();
        return $this;
    }

    public function port($port)
    {
        $this->port = $port;
        $this->connection();
        return $this;
    }

    public function clientId($clientId)
    {
        $this->clientId = $clientId;
        $this->connection();
        return $this;
    }

    public function username($username)
    {
        $this->username = $username;
        $this->settings();
        return $this;
    }

    public function password($password)
    {
        $this->password = $password;
        $this->settings();
        return $this;
    }

    public function clean_session(Bool $clean_session)
    {
        $this->clean_session = $clean_session;
        $this->connection();
        return $this;
    }

    public function interval(Int $interval)
    {
        $this->interval = $interval;
        $this->settings();
        return $this;
    }

    public function topic($topic)
    {
        $this->topic = $topic;
        $this->settings();
        return $this;
    }

    public function message(array $message)
    {
        $this->message = $message;

        return $this;
    }
    public function connection()
    {

        $this->mqtt = new MqttClient($this->server, $this->port, $this->clientId);
        $this->mqtt->connect($this->connectionSettings, $this->clean_session);

        return $this;
    }

    public function conn()
    {

        $this->mqtt = new MqttClient($this->server, $this->port, $this->clientId);
        $this->mqtt->connect($this->connectionSettings, $this->clean_session);

        return $this->mqtt;
    }
    public function settings()
    {
        $this->connectionSettings  = new ConnectionSettings();
        $this->connectionSettings
            ->setUsername($this->username)
            ->setPassword($this->password)
            ->setKeepAliveInterval($this->interval)
            ->setLastWillTopic($this->topic)
            ->setLastWillMessage('client disconnect')
            ->setLastWillQualityOfService(1);


        return $this;
    }
    public function subscribe($fn)
    {
        $this->mqtt->subscribe($this->topic, function ($topic, $message) use ($fn){
            printf("Received message on topic [%s]: %s\n", $topic, $message);
            return $fn($message);
        }, 0);
        $this->mqtt->loop(true);
        return $this->mqtt;
    }

    public function publish()
    {
        $this->mqtt->publish($this->topic, json_encode($this->message), 0, true);
        $this->mqtt->disconnect();;
        return $this;
    }
}
