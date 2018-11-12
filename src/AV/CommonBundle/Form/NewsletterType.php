<?php

namespace AV\CommonBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsletterType extends EntityGetterType {
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);
        $builder
            ->add('email', EmailType::class,
                [
                    'label' => $this->display('email'),
                    'attr' => [
                        'class' => 'form-control',
                        'value' => $this->get('email')
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
