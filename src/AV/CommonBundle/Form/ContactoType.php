<?php

namespace AV\CommonBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ContactoType extends EntityGetterType {
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);
        $builder
            ->add('nombre', TextType::class,
                [
                    'label' => $this->display('nombre'),
                    'attr' => [
                        'class' => 'form-control',
                        'value' => $this->get('nombre'),
                    ]
                ]
            )
            ->add('email', EmailType::class,
                [
                    'label' => $this->display('email'),
                    'attr' => [
                        'class' => 'form-control',
                        'value' => $this->get('email')
                    ]
                ]
            )
            ->add('asunto', TextType::class,
                [
                    'label' => $this->display('asunto'),
                    'attr' => [
                        'class' => 'form-control',
                        'value' => $this->get('asunto'),
                    ]
                ]
            )
            ->add('texto', TextareaType::class,
                [
                    'label' => $this->display('texto'),
                    'data' => $this->get('texto'),
                    'attr' => [
                        'class' => 'form-control',
                        'rows' => 4,
                    ]
                ]
            );
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'av_commonbundle_newsletter';
    }
}
