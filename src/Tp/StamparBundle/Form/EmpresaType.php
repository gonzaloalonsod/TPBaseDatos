<?php

namespace Tp\StamparBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EmpresaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('razon_social')
            ->add('CUIT')
//            ->add('idCliente')
            ->add('idCliente', new ClienteType(), array(
                'label' => 'Datos',
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Tp\StamparBundle\Entity\Empresa'
        ));
    }

    public function getName()
    {
        return 'tp_stamparbundle_empresatype';
    }
}
