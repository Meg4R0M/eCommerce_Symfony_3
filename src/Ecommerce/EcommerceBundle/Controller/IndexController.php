<?php

namespace Ecommerce\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {

        return $this->render('EcommerceBundle:Default:produits/layout/index.html.twig');
    }
}