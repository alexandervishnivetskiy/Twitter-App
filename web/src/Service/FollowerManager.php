<?php

namespace App\Service;

use Abraham\TwitterOAuth\TwitterOAuth;

class FollowerManager
{
    protected $consumer_key;
    protected $consumer_secret;
    protected $access_token;
    protected $access_token_secret;

    public $connection;
    public $count;
    public $showedFollowerCount;
    public $followersCollection;

    public function __construct($count, $consumer_key, $consumer_secret, $access_token, $access_token_secret)
    {
        $this->count = $count;
        $this->consumer_key = $consumer_key;
        $this->consumer_secret = $consumer_secret;
        $this->access_token = $access_token;
        $this->access_token_secret = $access_token_secret;
    }

    public function createConnection()
    {
        $this->connection = new TwitterOAuth($this->consumer_key, $this->consumer_secret, $this->access_token, $this->access_token_secret);
    }

    public function getFollowerCollection($userName, $cursor = -1)
    {
        $this->followersCollection = $this->connection->get('followers/list', ['screen_name' => $userName, 'cursor' => $cursor, 'count' => $this->count]);
        return $this->followersCollection;
    }

    public function getFollowers()
    {
        $followersCollection = $this->followersCollection;
        if (isset($followersCollection->errors)) {
            $followers_array = [];
        } else {
            $followers = $followersCollection->users;
            $followers_array = [];
            foreach ($followers as $follower) {
                $followers_array[] = $follower->screen_name;
            }
        }
        $followersCount = count($followers);
        $this->showedFollowerCount = ($followersCount < $this->count) ? $followersCount : $this->count;

        return $followers_array;
    }
}