<?php

namespace SoftuniProductBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductCategoryType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder/*->add(array('attr' => array('class' => 'w3-margin-bottom')))*/
                ->add('slug')
                ->add('title')
                ->add('description')
                ->add('image', FileType::class, array('data_class' => null,'required' => false,'label' => 'Image (PNG, JPEG or GIF): ', 'attr' => array('class' => 'w3-btn w3-teal w3-round-large')))
                ->add('rank')
                ->add('parent', EntityType::class, array(
                                                                    'required' => false,
                                                                    'placeholder' => 'Choose an option',
                                                                    'class' => 'SoftuniProductBundle:ProductCategory',
                                                                    ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SoftuniProductBundle\Entity\ProductCategory'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'softuniproductbundle_productcategory';
    }


}
