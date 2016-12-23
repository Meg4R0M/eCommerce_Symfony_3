<?php

namespace Pages\PagesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Pages\PagesBundle\Entity\Enquiry;
use Pages\PagesBundle\Form\EnquiryType;

class PagesController extends Controller
{
    public function menuAction()
    {
        $em = $this->getDoctrine()->getManager();
        $pages = $em->getRepository('PagesBundle:Pages')->findAll();

        return $this->render('PagesBundle:Default:pages/modulesUsed/menu.html.twig', array('pages' => $pages));
    }

    public function pageAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository('PagesBundle:Pages')->find($id);

        if (!$page) throw $this->createNotFoundException('La page n\'existe pas.');

        return $this->render('PagesBundle:Default:pages/layout/pages.html.twig', array('page' => $page));
    }

    public function contactAction(Request $request)
    {
        $enquiry = new Enquiry();
        $form = $this->createForm(EnquiryType::class, $enquiry);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($enquiry);
            $em->flush();

            $message = \Swift_Message::newInstance()
                ->setSubject('Contact via Canturla Drive')
                ->setFrom(array('psykotero@gmail.com' => "Canturla"))
                ->setTo('psykoterro@gmail.com')
                ->setCharset('utf-8')
                ->setContentType('text/html')
                ->setBody($this->renderView('PagesBundle:Default:pages/SwiftLayout/contactEmail.html.twig', array('enquiry' => $enquiry)));
            $this->get('mailer')->send($message);

            $this->get('session')->getFlashBag()->Add('success', 'Votre message viens d\'être transmis, Merci a vous !');

            return $this->redirect($this->generateUrl('contact'));
        }

        return $this->render('PagesBundle:Default:pages/layout/contact.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
