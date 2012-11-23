<?php

namespace Tp\StamparBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class FacturaEmpresaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('total')
//            ->add('fecha')
//            ->add('idCliente')
            ->add('idCliente', 'entity', array(
                    'label' => 'Cliente Empresa',
                    'class' => 'TpStamparBundle:Cliente',
                    'query_builder' => function(EntityRepository $er) {
                        $con = $er->createQueryBuilder('c')
                                ->join("TpStamparBundle:Empresa", 'e')
                                ->where('c.id = e.idCliente');
                        return $con->select('e');
                    }
                 ))
            ->add('idEmpleado')
            ->add('tipo', 'hidden', array(
                    'data' => 'empresa',
                    'property_path' => false,
                )
            )
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Tp\StamparBundle\Entity\Factura'
        ));
    }

    public function getName()
    {
        return 'tp_stamparbundle_facturatype';
    }
}
