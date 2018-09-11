<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Service\FollowerManager;

class TwitterController extends Controller
{
    const CONSUMER_KEY = '4ftZZMa1WBvx4liHEBGFAVETA';
    const CONSUMER_SECRET = 'GzrFUrBpthwcVGDeL3KUIIvRSaMj3d3ar1WgGpLWpwGp4Rx6R2';
    const ACCESS_TOKEN = '984044831398858752-ep8j3tiS8igyochCIGtlhoiRbPxKwA1';
    const ACCESS_TOKEN_SECRET = 'JjsHv6JjSOAVpYBA78jXPfGKcq04mvqv2e5tbBeH7LRRk';

    /**
     * @Route("/followers")
     */
    public function showUsersFollowers(Request $request, FollowerManager $followerManager)
    {
        $followerManager->createConnection();

        $form = $this->createFormBuilder()
            ->add('user', TextType::class, array('label' => 'Please, enter the correct user name', 'attr' => array('class' => 'form-control mb-3')))
            ->add('submit', SubmitType::class, array('attr' => array('class' => 'form-control mt-3 bg-success')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userName = $form->getData()['user'];
            $followers_array = $followerManager->getFollowers($userName);

            return $this->render('followers.html.twig', array('followers' => $followers_array, 'user' => $userName, 'count' => $followerManager->showedFollowerCount));
        }

        return $this->render('index.html.twig', array('form' => $form->createView()));
    }
}