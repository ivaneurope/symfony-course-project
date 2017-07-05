<?php
/**
 * Created by PhpStorm.
 * User: ACER
 * Date: 15.6.2017 г.
 * Time: 17:55
 */

namespace SoftuniProductBundle\Services;

use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManager;
use SoftuniProductBundle\Entity\ProductCategory;
use SoftuniProductBundle\Entity\Product;


class ProductCategoryManager
{
    protected $em, $class, $container, $repository;
    protected $products;

    public function __construct(EntityManager $em, $class, $container)
    {
        $this->em = $em;
        $this->class = $class;
        $this->repository = $this->em->getRepository($class);
        $this->container = $container;
    }

    public function createCategory()
    {
        $class = $this->getClass();
        return new $class;
    }

    public function removeCategory(ProductCategory $category, $andFlush = true)
    {
        $this->em->remove($category);
        if ($andFlush) {
            $this->em->flush();
        }
    }

    public function findCategoryBy(array $criteria)
    {
        return $this->repository->findBy($criteria);
    }

    public function getClass()
    {
        return $this->class;
    }
}