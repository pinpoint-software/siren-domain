<?php
namespace Pinpoint\Siren;

class ActionTest extends \PHPUnit_Framework_TestCase
{
    public function testNameAndHref()
    {
        $action = new Action();
        $action->setName('add-item');
        $action->setHref('http://api.x.io/orders/42/items');
        $expectedJson = json_encode(
            array(
                'name' => 'add-item',
                'href' => 'http://api.x.io/orders/42/items',
            )
        );
        $this->assertJsonStringEqualsJsonString($expectedJson, json_encode($action));
    }

    public function testMissingName()
    {
        $this->setExpectedException('Exception');
        $action = new Action();
        $action->setHref('http://api.x.io/orders/42/items');
        json_encode($action);
    }

    public function testMissingHref()
    {
        $this->setExpectedException('Exception');
        $action = new Action();
        $action->setName('add-item');
        json_encode($action);
    }

    public function testTitle()
    {
        $action = new Action();
        $action->setName('add-item');
        $action->setHref('http://api.x.io/orders/42/items');
        $action->setTitle('Add Item');
        $expectedJson = json_encode(
            array(
                'name' => 'add-item',
                'href' => 'http://api.x.io/orders/42/items',
                'title' => 'Add Item',
            )
        );
        $this->assertJsonStringEqualsJsonString($expectedJson, json_encode($action));
    }

    public function testSingleClass()
    {
        $action = new Action();
        $action->setName('add-item');
        $action->setHref('http://api.x.io/orders/42/items');
        $action->addClass('hoopla');
        $expectedJson = json_encode(
            array(
                'name' => 'add-item',
                'href' => 'http://api.x.io/orders/42/items',
                'class' => array('hoopla'),
            )
        );
        $this->assertJsonStringEqualsJsonString($expectedJson, json_encode($action));
    }

    public function testDoubleClass()
    {
        $action = new Action();
        $action->setName('add-item');
        $action->setHref('http://api.x.io/orders/42/items');
        $action->addClass('hoopla');
        $action->addClass('ballyhoo');
        $expectedJson = json_encode(
            array(
                'name' => 'add-item',
                'href' => 'http://api.x.io/orders/42/items',
                'class' => array('hoopla', 'ballyhoo'),
            )
        );
        $this->assertJsonStringEqualsJsonString($expectedJson, json_encode($action));
    }

    public function testSetClass()
    {
        $action = new Action();
        $action->setName('add-item');
        $action->setHref('http://api.x.io/orders/42/items');
        $action->addClass('order');
        $action->setClass('different', 'values');
        $expectedJson = json_encode(
            array(
                'name' => 'add-item',
                'href' => 'http://api.x.io/orders/42/items',
                'class' => array('different', 'values'),
            )
        );
        $this->assertJsonStringEqualsJsonString($expectedJson, json_encode($action));
    }

    public function testMethod()
    {
        $action = new Action();
        $action->setName('add-item');
        $action->setHref('http://api.x.io/orders/42/items');
        $action->setMethod(new Method(Method::POST));
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
        $action = new Action();
        $action->setName('add-item');
        $action->setHref('http://api.x.io/orders/42/items');
        $action->setType('text/plain');
        $expectedJson = json_encode(
            array(
                'name' => 'add-item',
                'href' => 'http://api.x.io/orders/42/items',
                'type' => 'text/plain',
            )
        );
        $this->assertJsonStringEqualsJsonString($expectedJson, json_encode($action));
    }

    public function testField()
    {
        $field = new Field();
        $field->setName('orderNumber');

        $action = new Action();
        $action->setName('add-item');
        $action->setHref('http://api.x.io/orders/42/items');
        $action->addField($field);
        $expectedJson = json_encode(
            array(
                'name' => 'add-item',
                'href' => 'http://api.x.io/orders/42/items',
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
