<?php

namespace AV\CommonBundle\Form;

use AV\MediaBundle\Form\MediaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;

class GalleryItemType extends EntityGetterType {
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);
        $builder
            ->add('activo', CheckboxType::class,
                [
                    'label' => $this->display('activo'),
                    'required' => false,
                    'attr' => [
                        'checked' => $this->get('activo'),
                    ]
                ]
            );
        MediaType::getFileType($builder, empty($this->entity));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'av_commonbundle_gallery_item';
    }
}
