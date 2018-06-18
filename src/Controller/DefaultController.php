<?php


namespace App\Controller;


use App\Entity\Ticket;
use Maps_red\TicketingBundle\Form\CreateTicketForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{

    /**
     * @Route("/", name="default_page")
     */
    public function defaultAction()
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('ticketing_perso');
        }

        return $this->render('base.html.twig');
    }

    /**
     * @Route("/form", name="form_page")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function formPage(Request $request)
    {
        $entity = new Ticket();
        $form = $this->createForm(CreateTicketForm::class, $entity);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // todo - do some work, like saving stuff

            $this->addFlash('success', '');

            return $this->redirectToRoute('', []);
        }

        return $this->render('base.html.twig');
    }

}