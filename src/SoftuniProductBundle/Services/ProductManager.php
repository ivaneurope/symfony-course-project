<?php
/**
 * Created by PhpStorm.
 * User: ACER
 * Date: 15.6.2017 г.
 * Time: 17:52
 */

namespace SoftuniProductBundle\Services;

use Doctrine\ORM\EntityManager;
use SoftuniProductBundle\Entity\Product;


class ProductManager
{
    protected $em, $class, $container, $repository;
    public function __construct(EntityManager $em, $class, $container)
    {
        $this->em = $em;
        $this->class = $class;
        $this->repository = $this->em->getRepository($class);
        $this->container = $container;
    }
    public function createProduct()
    {
        $class = $this->getClass();
        return new $class;
    }

    public function removeProduct(Product $product, $andFlush = true)
    {
        $this->em->remove($product);
        if ($andFlush) {
            $this->em->flush();
        }

    }

    public function removeProducts($products)
    {
        foreach ($products as $product){
            $this->removeProduct($product);
        }
        return true;
    }

    public function findProductBy(array $criteria)
    {
        return $this->repository->findBy($criteria);
    }

    public function getClass()
    {
        return $this->class;
    }

}