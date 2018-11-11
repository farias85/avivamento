<?php

namespace AV\CommonBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ConfiguracionType extends EntityGetterType {
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);
        $builder
            ->add('clave', TextType::class,
                [
                    'label' => $this->display('clave'),
                    'attr' => [
                        'class' => 'form-control',
                        'value' => $this->get('clave'),
                        'disabled' => !empty($this->get('requerido')),
                    ]
                ]
            )
            ->add('valor', TextType::class,
                [
                    'label' => $this->display('valor'),
                    'attr' => [
                        'class' => 'form-control',
                        'value' => $this->get('valor')

                    ]
                ]
            )
            ->add('requerido', CheckboxType::class,
                [
                    'label' => $this->display('requerido'),
                    'required' => false,
                    'attr' => [
                        'checked' => !empty($this->get('requerido')),
                        'disabled' => !empty($this->get('requerido')),
                    ]
                ]
            );
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'av_backendbundle_configuracion';
    }


}
