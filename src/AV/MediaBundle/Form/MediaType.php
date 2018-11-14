<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 09/08/2017
 * Time: 15:15
 */

namespace AV\MediaBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;

class MediaType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        self::getFileType($builder);
    }

    public static function getFileType(FormBuilderInterface $builder, $required = true) {
        $builder->add('path', FileType::class,
            ['label' => 'Imagen', 'required' => $required, 'attr' => ['placeholder' => 'image']]);
        return $builder;
    }
}