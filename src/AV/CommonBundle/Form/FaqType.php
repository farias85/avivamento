<?php

namespace AV\CommonBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class FaqType extends EntityGetterType {
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);
        $builder
            ->add('pregunta', TextType::class,
                [
                    'label' => $this->display('pregunta'),
                    'attr' => [
                        'class' => 'form-control',
                        'value' => $this->get('pregunta'),
                    ]
                ]
            )
            ->add('respuesta', TextareaType::class,
                [
                    'label' => $this->display('respuesta'),
                    'data' => $this->get('respuesta'),
                    'attr' => [
                        'class' => 'form-control',
                        'rows' => 4,
                    ]
                ]
            )
            ->add('activo', CheckboxType::class,
                [
                    'label' => $this->display('activo'),
                    'required' => false,
                    'attr' => [
                        'checked' => $this->get('activo'),
                    ]
                ]
            );
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'av_backendbundle_faq';
    }


}
