<?php

namespace AV\CommonBundle\Form;


use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class NomenclatureType extends EntityGetterType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);
        $builder
            ->add('nombre', TextType::class,
                [
                    'label' => $this->display('nombre'),
                    'attr' => [
                        'class' => 'form-control',
                        'value' => $this->get('nombre')
                    ]
                ]
            )
            ->add('descripcion', TextareaType::class,
                [
                    'label' => $this->display('descripcion'),
                    'data' => $this->get('descripcion'),
                    'required' => false,
                    'attr' => [
                        'class' => 'form-control',
                        'rows' => 4,
                    ]
                ]
            );
    }

    public function getBlockPrefix() {
        return 'av_commonbundle_nomenclature';
    }
}
