<?php

namespace App\Controller;

use App\Service\FollowerManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TwitterController extends Controller
{
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

            $followerCollection = $followerManager->getFollowerCollection($userName);
            $followers_array = $followerManager->getFollowers($followerCollection);

            return $this->render('followers.html.twig', array('followers' => $followers_array, 'user' => $userName, 'count' => $followerManager->showedFollowerCount));
        }

        return $this->render('index.html.twig', array('form' => $form->createView()));
    }
}
