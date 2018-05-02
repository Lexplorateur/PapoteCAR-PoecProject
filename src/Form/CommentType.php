<?php

namespace App\Form;

use App\Entity\Comment;
use App\Entity\Member;
use App\Entity\Run;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $member = $options['member'];
        $builder
            ->add('content', null, [
                "label" => "Your comment"
            ]);
            if($member == null){
                $builder
                    ->add('writer', null, [
                        "attr" => [
                            "placeholder" => "Taper votre email"
                        ]
                    ]);
            }
            $builder
                ->add('target', null, [
                    "label" => "Your target"
                ])
                ->add('note', null, [
                    "attr" => [
                        "placeholder" => "Noter la personnes"
                    ]
                ]);
            /*
            if($member == null){
                $message = "Vous n'êtes pas connecté !";
            }else if($member){
                $builder
                    ->add('writer');
            }
            if($target = $run){
                $target = $run;
                $builder
                    ->add('target');
            }else if($target = $member){
                $target = $run;
                $builder
                    ->add('target')
                    ->add('note');
            }*/
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'attr' => ['novalidate' => 'novalidate'],
            'data_class' => Member::class,
            'member' => null
        ]);
    }
}
