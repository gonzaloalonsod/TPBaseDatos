<?php

namespace Tp\StamparBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LineaFacturaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cantidad')
            ->add('total')
            ->add('idFactura')
            ->add('idProducto')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Tp\StamparBundle\Entity\LineaFactura'
        ));
    }

    public function getName()
    {
        return 'tp_stamparbundle_lineafacturatype';
    }
}
