<?php 

namespace App;

use Abraham\TwitterOAuth\TwitterOAuth;


class FollowerManager
{   
    const CONSUMER_KEY = '4ftZZMa1WBvx4liHEBGFAVETA';
    const CONSUMER_SECRET = 'GzrFUrBpthwcVGDeL3KUIIvRSaMj3d3ar1WgGpLWpwGp4Rx6R2';
    const ACCESS_TOKEN = '984044831398858752-ep8j3tiS8igyochCIGtlhoiRbPxKwA1';
    const ACCESS_TOKEN_SECRET = 'JjsHv6JjSOAVpYBA78jXPfGKcq04mvqv2e5tbBeH7LRRk';

    public $connection;
    
    public function createConnection(){
        $this->connection = new TwitterOAuth(self::CONSUMER_KEY, self::CONSUMER_SECRET, self::ACCESS_TOKEN, self::ACCESS_TOKEN_SECRET);
    }

    public function getFollowers($userName){
        $followersCollection = $this->connection->get('followers/list', ['screen_name' => $userName, 'cursor' => -1, 'count' => 20]);
        if (isset($followersCollection->errors)) {
            $followers_array = [];
        } else {
            $followers = $followersCollection->users;
            $followers_array = [];
            foreach ($followers as $follower) {
                $followers_array[] = $follower->screen_name;
            }
        }
        return $followers_array;
    }
}