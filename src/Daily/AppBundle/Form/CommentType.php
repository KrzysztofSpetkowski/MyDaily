<?php


/**
 * Description of PostType
 *
 * @author krzysiek
 */
namespace Daily\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PostType extends AbstractType
{
    /**
     * @Route("/add_post", "name = add_post)
     * @param FormBuilderInterface $builder
     * @param array $options
     
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', 'choice', array(
                'label' => 'Kategoria:   ',
                'choices' => array(
                    1   => 'Sport',
                    2   => "Odżywianie",
                    3   => "Porady",
                    4   => "Podróże",
                )
            ))
            ->add('title', 'text', array(
                'label' => 'Tytuł:',
                'attr' => array(
                    'class' => 'form-control',
                )
            ))
            ->add('description', 'text', array(
                'label' => 'Streszczenie:',
                'attr' => array(
                    'class' => 'form-control',
                )
            ))
            ->add('submit', 'submit', array('label' => 'Dodaj nowy Post'));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Daily\AppBundle\Entity\Post'
        ));
    }
    
    public function getName()
    {
        return 'daily_appbundle_post';
    }

}
