<?php

namespace App\Form;

use App\Entity\Schueler;
use PhpParser\Node\Stmt\Label;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\LanguageType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SchuelerFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('vorname', TextType::class, ['attr' => ['placeholder' => 'Dein Vorname']])
            ->add('nachname', TextType::class)
            ->add('telefonnummer', TextType::class)
            ->add('email', EmailType::class)
            ->add('kommentar', TextareaType::class)
            ->add('save', SubmitType::class, ['label' => 'Neuer Schüler'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Schueler::class,
        ]);
    }
}
