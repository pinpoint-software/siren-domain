<?php
namespace Pinpoint\Siren;

class EntityLinkTest extends \PHPUnit_Framework_TestCase
{
    public function testRelAndHref()
    {
        $link = new EntityLink('http://api.x.io/orders/42');
        $link->setRel(new Rel('self'));
        $expectedJson = json_encode(
            array(
                'rel' => array('self'),
                'href' => 'http://api.x.io/orders/42',
            )
        );
        $this->assertJsonStringEqualsJsonString($expectedJson, json_encode($link));
    }

    public function testSingleClass()
    {
        $link = new EntityLink('http://api.x.io/orders/42');
        $link->setRel(new Rel('self'));
        $link->addClass('order');
        $expectedJson = json_encode(
            array(
                'rel' => array('self'),
                'href' => 'http://api.x.io/orders/42',
                'class' => array('order'),
            )
        );
        $this->assertJsonStringEqualsJsonString($expectedJson, json_encode($link));
    }

    public function testDoubleClass()
    {
        $link = new EntityLink('http://api.x.io/orders/42');
        $link->setRel(new Rel('self'));
        $link->addClass('order');
        $link->addClass('info');
        $expectedJson = json_encode(
            array(
                'rel' => array('self'),
                'href' => 'http://api.x.io/orders/42',
                'class' => array('order', 'info'),
            )
        );
        $this->assertJsonStringEqualsJsonString($expectedJson, json_encode($link));
    }

    public function testSetClass()
    {
        $link = new EntityLink('http://api.x.io/orders/42');
        $link->setRel(new Rel('self'));
        $link->addClass('order');
        $link->setClass('different', 'values');
        $expectedJson = json_encode(
            array(
                'rel' => array('self'),
                'href' => 'http://api.x.io/orders/42',
                'class' => array('different', 'values'),
            )
        );
        $this->assertJsonStringEqualsJsonString($expectedJson, json_encode($link));
    }
}
