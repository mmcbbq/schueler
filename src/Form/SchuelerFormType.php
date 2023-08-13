<?php

namespace App\Form;

use App\Entity\Fachrichtung;
use App\Entity\Schueler;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
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
            ->add('Nachname' , TextType::class, [
                'attr' => array('placeholder' => 'Enter name'
                ),
                'label' => false]
            )
            ->add('TelefonNummer' )
            ->add('email', EmailType::class)
            ->add('kommentar' , TextareaType::class)
            ->add('Vorname')
            ->add('fachrichtung', EntityType::class,[
                'class'=> Fachrichtung::class,
                'choice_label' => 'bezeichnung',
                'expanded' => true
            ])
            ->add('save', SubmitType::class, ['label' => 'Create Schueler'])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Schueler::class,
        ]);
    }
}
