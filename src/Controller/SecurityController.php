<?php


namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use App\Form\LoginForm;
use App\Form\UserRegistrationForm;
use App\Security\LoginFormAuthenticator;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class SecurityController extends Controller
{

    /**
     * @Route("/login", name="security_login")
     */
    public function loginAction()
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('ticketing_perso');
        }

        $authenticationUtils = $this->get('security.authentication_utils');

        $form = $this->createForm(LoginForm::class, [
            '_username' => $authenticationUtils->getLastUsername(),
        ]);

        return $this->render('User/Security/login.html.twig', [
            'form' => $form->createView(),
            'error' => $authenticationUtils->getLastAuthenticationError(),
        ]);
    }

    /**
     * @Route("/logout", name="security_logout")
     * @throws \Exception
     */
    public function logoutAction()
    {
        throw new \Exception('this should not be reached!');
    }

    /**
     * @Route("/register", name="user_register")
     * @param Request $request
     * @param GuardAuthenticatorHandler $guardAuthenticatorHandler
     * @param LoginFormAuthenticator $loginFormAuthenticator
     * @return Response
     */
    public function registerAction(Request $request, GuardAuthenticatorHandler $guardAuthenticatorHandler, LoginFormAuthenticator $loginFormAuthenticator)
    {
        $user = new User();
        $form = $this->createForm(UserRegistrationForm::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setRegisterDate(new \DateTime());
            $this->getDoctrine()->getManager()->persist($user);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Bienvenue ' . $user->getUsername());

            return $guardAuthenticatorHandler
                ->authenticateUserAndHandleSuccess($user, $request, $loginFormAuthenticator, 'main');
        }

        return $this->render('User/Security/register.html.twig', [
            'form' => $form->createView()
        ]);

    }

}