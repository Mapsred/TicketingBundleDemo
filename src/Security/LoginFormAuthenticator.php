<?php


namespace App\Security;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Routing\Router;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use App\Entity\User;
use App\Form\LoginForm;

class LoginFormAuthenticator extends AbstractFormLoginAuthenticator
{
    /** @var FormFactoryInterface $formFactory */
    private $formFactory;

    /** @var EntityManager manager */
    private $manager;

    /** @var UserPasswordEncoder encoder */
    private $encoder;

    /** @var Router router */
    private $router;

    /**
     * LoginFormAuthenticator constructor.
     * @param FormFactoryInterface $formFactory
     * @param EntityManagerInterface $manager
     * @param UserPasswordEncoderInterface $encoder
     * @param RouterInterface $router
     */
    public function __construct(FormFactoryInterface $formFactory, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder, RouterInterface $router)
    {
        $this->formFactory = $formFactory;
        $this->manager = $manager;
        $this->encoder = $encoder;
        $this->router = $router;
    }

    public function getCredentials(Request $request)
    {
        $isLoginSubmited = $request->attributes->get('_route') === 'security_login' && $request->isMethod('POST');
        if (!$isLoginSubmited) {
            // skip authentication
            return null;
        }

        $form = $this->formFactory->create(LoginForm::class);
        $form->handleRequest($request);
        $data = $form->getData();

        $request->getSession()->set(Security::LAST_USERNAME, $data['_username']);

        return $data;
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $username = $credentials['_username'];

        return $this->manager->getRepository(User::class)->loadUserByUsername($username);

    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        return $this->encoder->isPasswordValid($user, $credentials['_password']);
    }

    protected function getLoginUrl()
    {
        return $this->router->generate('security_login');
    }

    /**
     * @param Request $request
     * @param TokenInterface $token
     * @param string $providerKey
     * @return RedirectResponse
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        return new RedirectResponse($this->router->generate('ticketing_perso'));
    }

    public function supports(Request $request)
    {
        return $request->attributes->get('_route') === 'security_login' && $request->isMethod('POST');
    }

}