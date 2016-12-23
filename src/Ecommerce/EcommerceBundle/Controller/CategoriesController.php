<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/12/16
 * Time: 12:54
 */
namespace Ecommerce\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoriesController extends Controller
{
    public function menuAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('EcommerceBundle:Categories')->findBy(array(), array('nom' => 'ASC'));

        return $this->render('EcommerceBundle:Default:categories/modulesUsed/menu.html.twig', array('categories' => $categories));
    }
}