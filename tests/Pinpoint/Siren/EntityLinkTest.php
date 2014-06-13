<?php
namespace Pinpoint\Siren;

class EntityLinkTest extends \PHPUnit_Framework_TestCase
{
    public function testRelAndHref()
    {
        $link = new EntityLink();
        $link->setRel(new Rel('self'));
        $link->setHref('http://api.x.io/orders/42');
        $expectedJson = json_encode(
            array(
                'rel' => array('self'),
                'href' => 'http://api.x.io/orders/42',
            )
        );
        $this->assertJsonStringEqualsJsonString($expectedJson, json_encode($link));
    }

    public function testMissingRel()
    {
        $this->setExpectedException('Exception');
        $link = new EntityLink();
        $link->setHref('http://api.x.io/orders/42');
        json_encode($link);
    }

    public function testMissingHref()
    {
        $this->setExpectedException('Exception');
        $link = new EntityLink();
        $link->setRel(new Rel('self'));
        json_encode($link);
    }

    public function testSingleClass()
    {
        $link = new EntityLink();
        $link->setRel(new Rel('self'));
        $link->setHref('http://api.x.io/orders/42');
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
        $link = new EntityLink();
        $link->setRel(new Rel('self'));
        $link->setHref('http://api.x.io/orders/42');
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
        $link = new EntityLink();
        $link->setRel(new Rel('self'));
        $link->setHref('http://api.x.io/orders/42');
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
