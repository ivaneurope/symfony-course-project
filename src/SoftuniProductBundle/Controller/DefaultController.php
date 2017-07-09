<?php

namespace SoftuniProductBundle\Controller;

use SoftuniProductBundle\Entity\ProductCategory;
use SoftuniProductBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('SoftuniProductBundle:Default:index.html.twig');
    }

    /**
     * @Route("/about")
     */
    public function aboutAction()
    {
        return $this->render('SoftuniProductBundle:Default:about.html.twig');
    }

    /**
     * @Route("/contact")
     */
    public function contactAction()
    {
        return $this->render('SoftuniProductBundle:Default:about.html.twig');
    }

    /**
     * @Route("/category/list")
     */
    public function  listCategoriesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $productCategories = $em->getRepository('SoftuniProductBundle:ProductCategory');

        $query = $productCategories->createQueryBuilder('pc')
            ->orderBy('pc.rank', 'ASC')
            ->getQuery();

        $result = $query->getResult();

        return $this->render('SoftuniProductBundle:Default:categories.html.twig', array(
            'productCategories' => $result,));
    }

    /**
     * @Route("/category/{id}/view", name="product-category_display")
     * @Method("GET")
     */
    public function displayCategoryAction(ProductCategory $productCategory)
    {
        $em = $this->getDoctrine()->getManager();
        $parent = $productCategory->getId();
        $repo = $em->getRepository('SoftuniProductBundle:ProductCategory');

        $query = $repo->createQueryBuilder('pc')
            ->where('pc.parent = :parent')
            ->setParameter('parent', $parent)
            ->getQuery();

        $children = $query->getResult();

        return $this->render('SoftuniProductBundle:Default:category_display.html.twig', array(
                        'productCategory' => $productCategory,
                        'children' => $children,
        ));
    }

    /**
     * @Route("product/list", name="product-listing")
     */
    public function listProductsAction()
    {
      $em = $this->getDoctrine()->getManager();
      $products = $em->getRepository('SoftuniProductBundle:Product')->findAll();

      return $this->render('SoftuniProductBundle:Default:products.html.twig', array(
          'products' => $products,
      ));
    }

    /**
     * @Route("product/{id}/view", name="product_display")
     * @Method("GET")
     */
    public function displayProductAction(Product $product)
    {
      return $this->render('SoftuniProductBundle:Default:product_display.html.twig', array(
          'product' => $product,
      ));

    }

}
