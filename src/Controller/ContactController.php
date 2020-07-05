<?php

namespace App\Controller;
use App\Entity\Contact;
use App\Form\ContactType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, \Swift_Mailer $mailer)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        
        $form->handleRequest($request);
        $this->addFlash('info', 'Some useful info');

        if ($form->isSubmitted()) {

            $contactFormData= $form->getData();
        $entityManager = $this->getDoctrine()->getManager();
         $entityManager->persist($contactFormData);
         $entityManager->flush();
            $message = (new \Swift_Message('You Got Mail!'))
            ->setFrom('HHH@gmail.com')
            ->setTo('our.own.real@email.address')
            ->setBody(
            'message');
            $mailer->send($message);
            $this->addFlash('success', 'It sent!');
        return $this->redirectToRoute('home');
            }
        return $this->render('contact/index.html.twig',
        array('form' => $form->createView())
        );
    }
    public function showEmail()
    {
        $contact = $this->getDoctrine()
            ->getRepository('App\Entity\Contact')
            ->findAll();

        return $this->render(
            'contact/show-email.html.twig',
            array('contact' => $contact)
        );
    }
}
