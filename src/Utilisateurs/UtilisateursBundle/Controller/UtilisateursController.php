<?php

namespace Utilisateurs\UtilisateursBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class UtilisateursController extends Controller
{
    public function facturesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $factures = $em->getRepository('EcommerceBundle:Commandes')->byFacture($this->getUser());

        return $this->render('UtilisateursBundle:Default:layout/facture.html.twig', array('factures' => $factures));
    }

    public function facturePDFAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $facture = $em->getRepository('EcommerceBundle:Commandes')->findOneBy(array('utilisateur' => $this->getUser(),
                                                                                     'valider' => 1,
                                                                                     'id' => $id));

        if (!$facture)
        {
            $this->get('session')->getFlashBag()->add('error', 'Une erreur est survenue');
            return $this->redirect($this->generateUrl('factures'));
        }

        $html = $this->renderView('UtilisateursBundle:Default:layout/facturePDF.html.twig', array('facture' => $facture));
        $html2pdf = $this->get('html2pdf_factory')->create('P', 'A4', 'fr', true, 'UTF-8', array(10, 15, 10, 15));
        $html2pdf->pdf->SetAuthor('Canturla');
        $html2pdf->pdf->SetTitle('Canturla - Facture '.$facture->getReference());
        $html2pdf->pdf->SetSubject('Facture Canturla');
        $html2pdf->pdf->SetKeywords('facture,canturla');
        $html2pdf->pdf->SetDisplayMode('real');
        $html2pdf->writeHTML($html);

        return new Response($html2pdf->Output('facture.pdf'), 200, array('Content-Type' => 'application/pdf'));;
    }

}
