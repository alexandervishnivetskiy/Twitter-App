<?php

namespace App\Controller;

use Abraham\TwitterOAuth\TwitterOAuth;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class TwitterController
{
    /**
     * @Route("/twitter")
     */
    public function createConnection(){

        $consumer_key = '4ftZZMa1WBvx4liHEBGFAVETA';
        $consumer_secret = 'GzrFUrBpthwcVGDeL3KUIIvRSaMj3d3ar1WgGpLWpwGp4Rx6R2';
        $access_token = '984044831398858752-ep8j3tiS8igyochCIGtlhoiRbPxKwA1';
        $access_token_secret = 'JjsHv6JjSOAVpYBA78jXPfGKcq04mvqv2e5tbBeH7LRRk';

        $connection = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);
        $content = $connection->get("account/verify_credentials");

        $new_status = $connection->post('statuses/update', ['status' => 'This tweet sent via the Twitter API!!!']);

        $statuses = $connection->get('statuses/home_timeline', ['count' => 25 , 'exclude_replies' => true]);
        $user_array = [];

        foreach ($statuses as $status){
            $user_array[]  = $status;
        }

        return new JsonResponse($user_array);
    }
}