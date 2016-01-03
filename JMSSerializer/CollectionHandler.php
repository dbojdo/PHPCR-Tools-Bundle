<?php
/**
 * File CollectionHandler.php
 * Created at: 2016-01-03 04-51
 *
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */

namespace Webit\Bundle\PHPCRToolsBundle\JMSSerializer;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use JMS\Serializer\Context;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\VisitorInterface;

class CollectionHandler implements SubscribingHandlerInterface
{
    public static function getSubscribingMethods()
    {
        $methods = array();
        $formats = array('json', 'xml', 'yml');
        $collectionTypes = array(
            'Doctrine\ODM\PHPCR\PersistentCollection',
            'Doctrine\ODM\PHPCR\ChildrenCollection',
            'Doctrine\ODM\PHPCR\ReferrersCollection',
            'Doctrine\ODM\PHPCR\ReferenceManyCollection',
            'Doctrine\ODM\PHPCR\ImmutableReferrersCollection'
        );

        foreach ($collectionTypes as $type) {
            foreach ($formats as $format) {
                $methods[] = array(
                    'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
                    'type' => $type,
                    'format' => $format,
                    'method' => 'serializeCollection',
                );

                $methods[] = array(
                    'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                    'type' => $type,
                    'format' => $format,
                    'method' => 'deserializeCollection',
                );
            }
        }

        return $methods;
    }

    public function serializeCollection(VisitorInterface $visitor, Collection $collection, array $type, Context $context)
    {
        // We change the base type, and pass through possible parameters.
        $type['name'] = 'array';

        return $visitor->visitArray($collection->toArray(), $type, $context);
    }

    public function deserializeCollection(VisitorInterface $visitor, $data, array $type, Context $context)
    {
        // See above.
        $type['name'] = 'array';

        return new ArrayCollection($visitor->visitArray($data, $type, $context));
    }
}
