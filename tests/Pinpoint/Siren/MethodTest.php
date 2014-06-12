<?php
namespace Pinpoint\Siren;

use UnexpectedValueException;

class MethodTest extends \PHPUnit_Framework_TestCase
{
    public function testJsonPost()
    {
        $Method = new Method(Method::POST);
        $this->assertEquals('"POST"', json_encode($Method));
    }

    public function testStringPost()
    {
        $Method = new Method(Method::POST);
        $this->assertEquals('POST', $Method);
    }

    public function testDefault()
    {
        $Method = new Method();
        $this->assertEquals('"GET"', json_encode($Method));
    }

    public function testFailure()
    {
        $this->setExpectedException('UnexpectedValueException');
        $Method = new Method('BOGUS');
    }
}
