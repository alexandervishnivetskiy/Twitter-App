<?php

namespace App\Controller;

use Abraham\TwitterOAuth\TwitterOAuth;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TwitterController extends Controller
{
    const CONSUMER_KEY = '4ftZZMa1WBvx4liHEBGFAVETA';
    const CONSUMER_SECRET = 'GzrFUrBpthwcVGDeL3KUIIvRSaMj3d3ar1WgGpLWpwGp4Rx6R2';
    const ACCESS_TOKEN = '984044831398858752-ep8j3tiS8igyochCIGtlhoiRbPxKwA1';
    const ACCESS_TOKEN_SECRET = 'JjsHv6JjSOAVpYBA78jXPfGKcq04mvqv2e5tbBeH7LRRk';

    /**
     * @Route("/followers")
     */
    public function showUsersFollowers(Request $request)
    {
        $connection = new TwitterOAuth(self::CONSUMER_KEY, self::CONSUMER_SECRET, self::ACCESS_TOKEN, self::ACCESS_TOKEN_SECRET);

        $content = $connection->get("account/verify_credentials");

        $form = $this->createFormBuilder()
            ->add('user', TextType::class, array('label' => 'Please, enter the correct user name', 'attr' => array('class' => 'form-control mb-3')))
            ->add('submit', SubmitType::class, array('attr' => array('class' => 'form-control mt-3 bg-success')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userName = $form->getData()['user'];
            $followersColletion = $connection->get('followers/list', ['screen_name' => $userName, 'count' => 25]);
            if (isset($followersColletion->errors)) {
                $followers_array = [];
            } else {
                $followers = $followersColletion->users;
                $followers_array = [];
                foreach ($followers as $follower) {
                    $followers_array[] = $follower->screen_name;
                }
            }
            return $this->render('followers.html.twig', array('followers' => $followers_array, 'user' => $userName));
        }
        return $this->render('index.html.twig', array('form' => $form->createView()));


    }
}