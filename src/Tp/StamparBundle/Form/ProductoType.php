<?php

namespace Tp\StamparBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('imagen')
            ->add('cantidad')
            ->add('precio')
            ->add('idTipoProducto')
            ->add('idProveedor')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Tp\StamparBundle\Entity\Producto'
        ));
    }

    public function getName()
    {
        return 'tp_stamparbundle_productotype';
    }
}
