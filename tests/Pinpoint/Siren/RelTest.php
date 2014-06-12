<?php
namespace Pinpoint\Siren;

use InvalidArgumentException;

class RelTest extends \PHPUnit_Framework_TestCase
{
    public function testSingleRelJson()
    {
        $rel = new Rel('hoopla');
        $this->assertEquals('["hoopla"]', json_encode($rel));
    }

    public function testDoubleRelJson()
    {
        $rel = new Rel('hoopla', 'ballyhoo');
        $this->assertEquals('["hoopla","ballyhoo"]', json_encode($rel));
    }

    public function testNumericRelJson()
    {
        $this->setExpectedException('InvalidArgumentException');
        $rel = new Rel(42);
    }
}
