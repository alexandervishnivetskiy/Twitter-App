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

}