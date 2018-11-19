<?php

namespace AV\CommonBundle\Form;

use AV\CommonBundle\Util\Entity;
use AV\MediaBundle\Form\MediaType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class EventoType extends EntityGetterType {
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);
        $builder
            ->add('titulo', TextType::class,
                [
                    'label' => $this->display('titulo'),
                    'attr' => [
                        'class' => 'form-control',
                        'value' => $this->get('titulo'),
                    ]
                ]
            )
            ->add('subtitulo', TextType::class,
                [
                    'label' => $this->display('subtitulo'),
                    'attr' => [
                        'class' => 'form-control',
                        'value' => $this->get('subtitulo'),
                    ]
                ]
            )
            ->add('texto', TextareaType::class,
                [
                    'label' => $this->display('texto'),
                    'data' => $this->get('texto'),
                    'attr' => [
                        'rows' => 4,
                    ]
                ]
            )
            ->add('whenStart', DateType::class,
                [
                    'label' => $this->display('whenStart'),
                    'widget' => 'single_text',
                    'html5' => false,
                    'attr' => [
                        'class' => 'js-datepicker form-control',
                        'placeholder' => 'Fecha',
                        'value' => $this->getDateText($this->get('whenStart'))
                    ],
                ]
            )
            ->add('whenEnd', DateType::class,
                [
                    'label' => $this->display('whenEnd'),
                    'widget' => 'single_text',
                    'html5' => false,
                    'attr' => [
                        'class' => 'js-datepicker form-control',
                        'placeholder' => 'Fecha',
                        'value' => $this->getDateText($this->get('whenEnd'))
                    ],
                ]
            )
            ->add('wherePlace', TextareaType::class,
                [
                    'label' => $this->display('wherePlace'),
                    'data' => $this->get('wherePlace'),
                    'attr' => [
                        'class' => 'form-control',
                        'rows' => 4,
                    ]
                ]
            )
            ->add('youtubeUrl', TextType::class,
                [
                    'label' => $this->display('youtubeUrl'),
                    'required' => false,
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => 'Ej. https://youtu.be/w6iEQB1wIKQ',
                        'value' => $this->get('youtubeUrl'),
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
            )
            ->add('categoria', EntityType::class,
                [
                    'class' => Entity::CATEGORIA,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('t')
                            ->orderBy('t.id', 'ASC');
                    },
                    'preferred_choices' => [$this->get('categoria')],
                    'label' => $this->display('categoria'),
                    'attr' => [
                        'class' => 'form-control'
                    ],
                ]
            );

        MediaType::getFileType($builder, empty($this->entity));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'av_backendbundle_evento';
    }


}
