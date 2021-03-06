<?php

namespace App\Form;

use App\Entity\Domain;
use App\Entity\Suggestion;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SuggestionCompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('number_of_students')
            ->add('number_of_groups')
            ->add('number_of_hours')
            ->add('date_start')
            ->add('date_end')
            ->add('domain', EntityType::class, ["class" => Domain::class, "choice_label" => "title"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Suggestion::class,
        ]);
    }
}
