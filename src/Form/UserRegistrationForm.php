<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\User;

/**
 * Class UserRegistrationForm
 *
 * @author François MATHIEU <francois.mathieu@livexp.fr>
 */
class UserRegistrationForm extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, ['label' => 'label.username', 'attr' => [
                'placeholder' => 'label.username'
            ]])
            ->add('email', EmailType::class, ['label' => 'label.email', 'attr' => [
                'placeholder' => 'label.email'
            ]])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                "first_options" => ['label' => 'label.password', 'attr' => [
                    'placeholder' => 'label.password'
                ]],
                "second_options" => ['label' => 'label.confirm_password', 'attr' => [
                    'placeholder' => 'label.confirm_password'
                ]],
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'translation_domain' => 'user'
        ]);

    }

}