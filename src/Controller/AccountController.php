<?php

namespace App\Controller;

use App\Entity\User;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_USER")
 * @method User|null getUser()
 */
class AccountController extends AbstractController
{
    /**
     * @Route("/account", name="app_account")
     * @param LoggerInterface $logger
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(LoggerInterface $logger)
    {
        $logger->debug('Checking account page for '.$this->getUser()->getEmail());

        return $this->render('account/index.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }

    /**
     * @Route("/api/account", name="api_account")
     */
    public function accountApi()
    {
        $user = $this->getUser();

        return $this->json($user,200, [], [
            'groups' => ['main'],
        ]);
    }
}
