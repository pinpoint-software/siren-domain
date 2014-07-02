<?php
namespace Pinpoint\Siren;

class ActionTest extends \PHPUnit_Framework_TestCase
{
    public function testNameAndHref()
    {
        $action = new Action('add-item', 'http://api.x.io/orders/42/items');
        $expectedJson = json_encode(
            array(
                'name' => 'add-item',
                'href' => 'http://api.x.io/orders/42/items',
                'method' => 'GET',
            )
        );
        $this->assertJsonStringEqualsJsonString($expectedJson, json_encode($action));
    }

    public function testTitle()
    {
        $action = new Action('add-item', 'http://api.x.io/orders/42/items');
        $action->setTitle('Add Item');
        $expectedJson = json_encode(
            array(
                'name' => 'add-item',
                'href' => 'http://api.x.io/orders/42/items',
                'method' => 'GET',
                'title' => 'Add Item',
            )
        );
        $this->assertJsonStringEqualsJsonString($expectedJson, json_encode($action));
    }

    public function testSingleClass()
    {
        $action = new Action('add-item', 'http://api.x.io/orders/42/items');
        $action->addClass('hoopla');
        $expectedJson = json_encode(
            array(
                'name' => 'add-item',
                'href' => 'http://api.x.io/orders/42/items',
                'method' => 'GET',
                'class' => array('hoopla'),
            )
        );
        $this->assertJsonStringEqualsJsonString($expectedJson, json_encode($action));
    }

    public function testDoubleClass()
    {
        $action = new Action('add-item', 'http://api.x.io/orders/42/items');
        $action->addClass('hoopla');
        $action->addClass('ballyhoo');
        $expectedJson = json_encode(
            array(
                'name' => 'add-item',
                'href' => 'http://api.x.io/orders/42/items',
                'method' => 'GET',
                'class' => array('hoopla', 'ballyhoo'),
            )
        );
        $this->assertJsonStringEqualsJsonString($expectedJson, json_encode($action));
    }

    public function testSetClass()
    {
        $action = new Action('add-item', 'http://api.x.io/orders/42/items');
        $action->addClass('order');
        $action->setClass('different', 'values');
        $expectedJson = json_encode(
            array(
                'name' => 'add-item',
                'href' => 'http://api.x.io/orders/42/items',
                'method' => 'GET',
                'class' => array('different', 'values'),
            )
        );
        $this->assertJsonStringEqualsJsonString($expectedJson, json_encode($action));
    }

    public function testMethod()
    {
        $action = new Action('add-item', 'http://api.x.io/orders/42/items', new Method(Method::POST));
        $expectedJson = json_encode(
            array(
                'name' => 'add-item',
                'href' => 'http://api.x.io/orders/42/items',
                'method' => 'POST',
            )
        );
        $this->assertJsonStringEqualsJsonString($expectedJson, json_encode($action));
    }

    public function testType()
    {
        $action = new Action('add-item', 'http://api.x.io/orders/42/items');
        $action->setType('text/plain');
        $expectedJson = json_encode(
            array(
                'name' => 'add-item',
                'href' => 'http://api.x.io/orders/42/items',
                'method' => 'GET',
                'type' => 'text/plain',
            )
        );
        $this->assertJsonStringEqualsJsonString($expectedJson, json_encode($action));
    }

    public function testField()
    {
        $field = new Field('orderNumber');

        $action = new Action('add-item', 'http://api.x.io/orders/42/items');
        $action->addField($field);
        $expectedJson = json_encode(
            array(
                'name' => 'add-item',
                'href' => 'http://api.x.io/orders/42/items',
                'method' => 'GET',
                'type' => 'application/x-www-form-urlencoded',
                'fields' => array(
                    array(
                        'name' => 'orderNumber',
                        'type' => 'text',
                    ),
                ),
            )
        );
        $this->assertJsonStringEqualsJsonString($expectedJson, json_encode($action));
    }
}
