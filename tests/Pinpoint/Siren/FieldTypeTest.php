<?php
namespace Pinpoint\Siren;

use UnexpectedValueException;

class FieldTypeTest extends \PHPUnit_Framework_TestCase
{
    public function testJsonHidden()
    {
        $fieldType = new FieldType(FieldType::HIDDEN);
        $this->assertEquals('"hidden"', json_encode($fieldType));
    }

    public function testStringHidden()
    {
        $fieldType = new FieldType(FieldType::HIDDEN);
        $this->assertEquals('hidden', $fieldType);
    }

    public function testDefault()
    {
        $fieldType = new FieldType();
        $this->assertEquals('"text"', json_encode($fieldType));
    }

    public function testFailure()
    {
        $this->setExpectedException('UnexpectedValueException');
        $fieldType = new FieldType('BOGUS');
    }
}
