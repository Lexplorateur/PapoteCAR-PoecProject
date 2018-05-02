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
        $run = $options['run'];
        $message = '';
        $builder
            ->add('content', null, [
                "label" => "Your comment"
            ]);
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
            }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
            'user' => null
        ]);
    }
}
