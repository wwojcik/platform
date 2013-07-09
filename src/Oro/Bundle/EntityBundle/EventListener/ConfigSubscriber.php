<?php

namespace Oro\Bundle\EntityBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use Oro\Bundle\EntityConfigBundle\Event\FieldConfigEvent;
use Oro\Bundle\EntityConfigBundle\Event\EntityConfigEvent;
use Oro\Bundle\EntityConfigBundle\Event\Events;

class ConfigSubscriber implements EventSubscriberInterface
{
    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            Events::NEW_ENTITY_CONFIG => 'newEntityConfig',
            Events::NEW_FIELD_CONFIG  => 'newFieldConfig',
        );
    }

    /**
     * @param EntityConfigEvent $event
     */
    public function newEntityConfig(EntityConfigEvent $event)
    {
        $entityProvider = $event->getConfigManager()->getProvider('entity');
        $datagridProvider = $event->getConfigManager()->getProvider('datagrid');

    }

    /**
     * @param FieldConfigEvent $event
     */
    public function newFieldConfig(FieldConfigEvent $event)
    {

    }
}