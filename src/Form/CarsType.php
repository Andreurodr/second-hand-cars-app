<?php

namespace App\Form;

use App\Entity\Cars;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('brand', null, [
                'label' => 'Marca'])
            ->add('model', null, [
                'label' => 'Modelo'])
            ->add('fuel', null, [
                'label' => 'Combustible'])
            ->add('kilometers', null, [
                'label' => 'Kilometraje'])
            ->add('year', null, [
                'label' => 'Año de matriculación'])
            ->add('horsepower', null, [
                'label' => 'Potencia'])
            ->add('type', null, [
                'label' => 'Tipo de carrocería'])
            ->add('doors', null, [
                'label' => 'Número de puertas'])
            ->add('color')
            ->add('carPhoto', FileType::class, ['mapped'=>false,
                'label' => 'Fotografía'])
            ->add('price', null, [
                'label' => 'Precio al contado'])
            ->add('Publicar_anuncio', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cars::class,
        ]);
    }
}
