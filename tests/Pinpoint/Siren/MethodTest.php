<?php
namespace Pinpoint\Siren;

use UnexpectedValueException;

class MethodTest extends \PHPUnit_Framework_TestCase
{
    public function testJsonPost()
    {
        $method = new Method(Method::POST);
        $this->assertEquals('"POST"', json_encode($method));
    }

    public function testJsonPostWithHelper()
    {
        $method = Method::POST();
        $this->assertEquals('"POST"', json_encode($method));
    }

    public function testInvalidJsonPostWithHelper()
    {
        $this->setExpectedException('UnexpectedValueException');
        $method = Method::BOGUS();
    }

    public function testStringPost()
    {
        $method = new Method(Method::POST);
        $this->assertEquals('POST', $method);
    }

    public function testDefault()
    {
        $method = new Method();
        $this->assertEquals('"GET"', json_encode($method));
    }

    public function testFailure()
    {
        $this->setExpectedException('UnexpectedValueException');
        $method = new Method('BOGUS');
    }
}
