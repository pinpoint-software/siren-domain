<?php
namespace Pinpoint\Siren;

class EntityLinkTest extends \PHPUnit_Framework_TestCase
{
    public function testRelAndHrefJson()
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

    public function testMissingRelJson()
    {
        $this->setExpectedException('Exception');
        $link = new EntityLink();
        $link->setHref('http://api.x.io/orders/42');
        json_encode($link);
    }

    public function testMissingHrefJson()
    {
        $this->setExpectedException('Exception');
        $link = new EntityLink();
        $link->setRel(new Rel('self'));
        json_encode($link);
    }

    public function testSingleClassJson()
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

    public function testDoubleClassJson()
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
}
