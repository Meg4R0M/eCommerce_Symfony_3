<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/12/16
 * Time: 21:14
 */
namespace Ecommerce\EcommerceBundle\Services;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;


class GetFacture extends Controller
{
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function facture($facture)
    {
        $html = $this->container->get('templating')->render('UtilisateursBundle:Default:layout/facturePDF.html.twig', array('facture' => $facture));

        $html2pdf = $this->get('html2pdf_factory')->create('P', 'A4', 'fr', true, 'UTF-8', array(10, 15, 10, 15));
        $html2pdf->pdf->SetAuthor('Canturla');
        $html2pdf->pdf->SetTitle('Canturla - Facture '.$facture->getReference());
        $html2pdf->pdf->SetSubject('Facture Canturla');
        $html2pdf->pdf->SetKeywords('facture,canturla');
        $html2pdf->pdf->SetDisplayMode('real');
        $html2pdf->writeHTML($html);

        return $html2pdf;
            //new Response($html2pdf->Output('facture.pdf'), 200, array('Content-Type' => 'application/pdf'));
    }
}