<?php

namespace Oro\Bundle\FlexibleEntityBundle\Form\Type;

use Oro\Bundle\FlexibleEntityBundle\Manager\FlexibleManager;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Base flexible form type
 */
class FlexibleType extends AbstractType
{
    /**
     * @var FlexibleManager
     */
    protected $flexibleManager;

    /**
     * @var string
     */
    protected $flexibleClass;

    /**
     * @var string
     */
    protected $valueFormAlias;

    /**
     * Constructor
     *
     * @param FlexibleManager $flexibleManager the manager
     * @param string          $valueFormAlias  the value form type alias
     */
    public function __construct(FlexibleManager $flexibleManager, $valueFormAlias)
    {
        $this->flexibleManager = $flexibleManager;
        $this->flexibleClass   = $flexibleManager->getFlexibleName();
        $this->valueFormAlias  = $valueFormAlias;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->addEntityFields($builder);
        $this->addDynamicAttributesFields($builder, $options);
    }

    /**
     * Add entity fieldsto form builder
     *
     * @param FormBuilderInterface $builder
     */
    public function addEntityFields(FormBuilderInterface $builder)
    {
        $builder->add('id', 'hidden');
    }

    /**
     * Add entity fieldsto form builder
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function addDynamicAttributesFields(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'values',
            'collection',
            array(
                'type'               => $this->valueFormAlias,
                'allow_add'          => true,
                'allow_delete'       => true,
                'by_reference'       => false,
                'cascade_validation' => true,
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => $this->flexibleClass,
                'cascade_validation' => true
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'oro_flexibleentity_entity';
    }
}
