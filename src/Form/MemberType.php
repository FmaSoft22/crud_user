<?php

namespace App\Form;

use App\Entity\Countrie;
use App\Entity\Member;
use App\Repository\CountrieRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MemberType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('title',ChoiceType::class,array(
            'choices' =>array(
                'Mr'=>'Mr',
                'Mme'=>'Mme'
            ),
            'attr'=>['class'=>' form-control'],
            'label'=>'Civilité',
            'required' => true,
            'placeholder' => 'Civilité',
            'invalid_message'=>'La civilité est obligatoire!'
        ));
        $builder->add('firstname',TextType::class,[
            'attr' =>['class'=>'form-control','placeholder'=>'Nom'],
            'label'=>'Nom',
            'required'=>true,
        ]);
        $builder->add('lastname',TextType::class,[
            'attr' =>['class'=>'form-control','placeholder'=>'Prénom(s)'],
            'label'=>'Prénom(s)',
            'required'=>true,
        ]);
        $builder->add('emailAddress',EmailType::class,[
            'attr'=>['class'=>'form-control','required' => true,]
        ]);
        $builder->add('address',TextType::class,[
            'attr'=>['class'=>'form-control','required' => true,]
        ]);
       /* $builder->add('country', EntityType::class, [
            'class' => Countrie::class,
            'query_builder' => function (CountrieRepository $er) {
                return $er->createQueryBuilder('u')
                    ->orderBy('u.labelNameFr', 'ASC');
            },
            'choice_value' => function (?Countrie $entity) {
                return null != $entity ? $entity->getId() : '';
            },
            'choice_label' => function (Countrie $entity) {
                return $entity->getLabelNameFr();
            },
            'attr'=>['class'=>'form-control'],
            'required' => true,
            'placeholder' => 'Pays',
            'label' => 'Pays',
            'error_bubbling' => true,
        ]);*/
        $builder->add('country',TextType::class,[
            'attr'=>['class'=>'form-control', 'required' => true,]
        ]);
        $builder->add('town', TextType::class, [
            'attr' => ['class' => 'form-control', 'placeholder' => 'Ville'],
            'error_bubbling' => true,
            'required' => true,
            'label' => 'Ville',
        ]);
        $builder->add('phone',TextType::class,[
            'attr'=>['class'=>'form-control','required' => true,]
        ]);
        $builder->add('dateOfBirth',DateType::class,[
            'attr'=>['class'=>'form-control'],
            'widget'=>'single_text'
        ]);
        $builder->add('postalCode',TextType::class,[
            'attr'=>['class'=>'form-control','placeholder','Code Postal']
        ]);
        $builder->add('file', FileType::class, [
            'attr' => ['placeholder' => 'Photo de profil', 'class' => 'form-control'],
            'required' => false,
            'label' => 'Photo de profil',
            'error_bubbling' => true,
            'mapped' => false,
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'=>Member::class
        ]);
    }
}