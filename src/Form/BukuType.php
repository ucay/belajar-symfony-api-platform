<?php

namespace App\Form;

use App\Entity\Buku;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class BukuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('judul', TextType::class , [
                'label' => 'Isi Judul',
                'attr' => [
                    'class' => 'asdf'
                ]
            ])
            ->add('halaman')
            ->add('kategori')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Buku::class,
        ]);
    }
}
