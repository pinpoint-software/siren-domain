<?php
namespace Pinpoint\Siren;

use InvalidArgumentException;

class RelationshipTest extends \PHPUnit_Framework_TestCase
{
    public function testSingleRelJson()
    {
        $rel = new Relationship('hoopla');
        $this->assertEquals('["hoopla"]', json_encode($rel));
    }

    public function testDoubleRelJson()
    {
        $rel = new Relationship('hoopla', 'ballyhoo');
        $this->assertEquals('["hoopla","ballyhoo"]', json_encode($rel));
    }

    public function testNumericRelJson()
    {
        $this->setExpectedException('InvalidArgumentException');
        $rel = new Relationship(42);
    }
}
