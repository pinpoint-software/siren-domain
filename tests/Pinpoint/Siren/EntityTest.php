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

    public function testScalarProperty()
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

    public function testArrayProperty()
    {
        $entity = new Entity();
        $entity->setProperty('orderNumber', array(42));
        $expectedJson = json_encode(
            array(
                'properties' => array(
                    'orderNumber' => [42],
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

    public function testObjectPropertyValue()
    {
        $this->setExpectedException('InvalidArgumentException');
        $entity = new Entity();
        $entity->setProperty('orderNumber', new \StdClass());
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

    public function testMultipleSubEntities()
    {
        $orderItemsRel = new Rel('http://x.io/rels/order-items');
        $orderItems = new EntityLink('http://api.x.io/orders/42/items');
        $orderItems->setClass('items', 'collection');

        $customerRel = new Rel('http://x.io/rels/customer');
        $customer = new Entity();
        $customer->setClass('info', 'customer');
        $customer->setProperty('customerId', 'pj123');
        $customer->setProperty('name', 'Peter Joseph');
        $customer->addLink(new Rel('self'), 'http://api.x.io/customers/pj123');

        $entity = new Entity();
        $entity->addEntityLink($orderItemsRel, $orderItems);
        $entity->addEntity($customerRel, $customer);
        $expectedJson = json_encode(
            array(
                'entities' => array(
                    array(
                        'class' => array('items', 'collection'),
                        'rel' => array('http://x.io/rels/order-items'),
                        'href' => 'http://api.x.io/orders/42/items',
                    ),
                    array(
                        'class' => array('info', 'customer'),
                        'rel' => array('http://x.io/rels/customer'),
                        'properties' => array(
                            'customerId' => 'pj123',
                            'name' => 'Peter Joseph',
                        ),
                        'links' => array(
                            array(
                                'rel' => array('self'),
                                'href' => 'http://api.x.io/customers/pj123',
                            ),
                        ),
                    ),
                ),
            )
        );
        $this->assertJsonStringEqualsJsonString($expectedJson, json_encode($entity));
    }

    public function testEntityLink()
    {
        $rel = new Rel('http://x.io/rels/order-items');
        $subEntity = new EntityLink('http://api.x.io/orders/42/items');
        $subEntity->addClass('items');
        $subEntity->addClass('collection');

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
        $action = new Action('add-item', 'http://api.x.io/orders/42/items', new Method(Method::POST));

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
        $entity = new Entity();
        $entity->addLink(new Rel('self'), 'http://api.x.io/orders/42', 'Self Reference');
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

    public function testMultipleLinks()
    {
        $entity = new Entity();
        $entity->addLink(new Rel('self'), 'http://api.x.io/orders/42', 'Self Reference');
        $entity->addLink(new Rel('next'), 'http://api.x.io/orders/43', 'Next Order');
        $expectedJson = json_encode(
            array(
                'links' => array(
                    array(
                        'rel' => array('self'),
                        'href' => 'http://api.x.io/orders/42',
                        'title' => 'Self Reference',
                    ),
                    array(
                        'rel' => array('next'),
                        'href' => 'http://api.x.io/orders/43',
                        'title' => 'Next Order',
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
