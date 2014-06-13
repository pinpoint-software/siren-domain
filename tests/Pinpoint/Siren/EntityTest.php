<?php
namespace Pinpoint\Siren;

use InvalidArgumentException;

class EntityTest extends \PHPUnit_Framework_TestCase
{
    public function testAddClass()
    {
        $entity = new Entity();
        $entity->addClass('order');
        $expectedJson = json_encode(
            array(
                'class' => array('order'),
            )
        );
        $this->assertJsonStringEqualsJsonString($expectedJson, json_encode($entity));
    }

    public function testSetClass()
    {
        $entity = new Entity();
        $entity->addClass('order');
        $entity->setClass('different', 'values');
        $expectedJson = json_encode(
            array(
                'class' => array('different', 'values'),
            )
        );
        $this->assertJsonStringEqualsJsonString($expectedJson, json_encode($entity));
    }

    public function testInvalidClass()
    {
        $this->setExpectedException('InvalidArgumentException');
        $entity = new Entity();
        $entity->addClass(42);
    }

    public function testProperty()
    {
        $entity = new Entity();
        $entity->setProperty('orderNumber', 42);
        $expectedJson = json_encode(
            array(
                'properties' => array(
                    'orderNumber' => 42,
                ),
            )
        );
        $this->assertJsonStringEqualsJsonString($expectedJson, json_encode($entity));
    }

    public function testNonStringPropertyKey()
    {
        $this->setExpectedException('InvalidArgumentException');
        $entity = new Entity();
        $entity->setProperty(42, 42);
    }

    public function testNonScalarPropertyValue()
    {
        $this->setExpectedException('InvalidArgumentException');
        $entity = new Entity();
        $entity->setProperty('orderNumber', array(42));
    }

    public function testSubEntity()
    {
        $rel = new Rel('http://x.io/rels/order-items');
        $subEntity = new Entity();
        $subEntity->addClass('items');
        $subEntity->addClass('collection');

        $entity = new Entity();
        $entity->addEntity($rel, $subEntity);
        $expectedJson = json_encode(
            array(
                'entities' => array(
                    array(
                        'class' => array('items', 'collection'),
                        'rel' => array('http://x.io/rels/order-items'),
                    ),
                ),
            )
        );
        $this->assertJsonStringEqualsJsonString($expectedJson, json_encode($entity));
    }

    public function testEntityLink()
    {
        $rel = new Rel('http://x.io/rels/order-items');
        $subEntity = new EntityLink();
        $subEntity->addClass('items');
        $subEntity->addClass('collection');
        $subEntity->setHref('http://api.x.io/orders/42/items');

        $entity = new Entity();
        $entity->addEntityLink($rel, $subEntity);
        $expectedJson = json_encode(
            array(
                'entities' => array(
                    array(
                        'class' => array('items', 'collection'),
                        'rel' => array('http://x.io/rels/order-items'),
                        'href' => 'http://api.x.io/orders/42/items',
                    ),
                ),
            )
        );
        $this->assertJsonStringEqualsJsonString($expectedJson, json_encode($entity));
    }

    public function testAction()
    {
        $action = new Action();
        $action->setName('add-item');
        $action->setMethod(new Method(Method::POST));
        $action->setHref('http://api.x.io/orders/42/items');

        $entity = new Entity();
        $entity->addAction($action);
        $expectedJson = json_encode(
            array(
                'actions' => array(
                    array(
                        'name' => 'add-item',
                        'method' => 'POST',
                        'href' => 'http://api.x.io/orders/42/items',
                    ),
                ),
            )
        );
        $this->assertJsonStringEqualsJsonString($expectedJson, json_encode($entity));
    }

    public function testLink()
    {
        $rel = new Rel('self');

        $entity = new Entity();
        $entity->addLink($rel, 'http://api.x.io/orders/42', 'Self Reference');
        $expectedJson = json_encode(
            array(
                'links' => array(
                    array(
                        'rel' => array('self'),
                        'href' => 'http://api.x.io/orders/42',
                        'title' => 'Self Reference',
                    ),
                ),
            )
        );
        $this->assertJsonStringEqualsJsonString($expectedJson, json_encode($entity));
    }

    public function testTitle()
    {
        $entity = new Entity();
        $entity->setTitle('Order 42');
        $expectedJson = json_encode(
            array(
                'title' => 'Order 42',
            )
        );
        $this->assertJsonStringEqualsJsonString($expectedJson, json_encode($entity));
    }
}
