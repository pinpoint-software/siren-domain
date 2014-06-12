<?php
namespace Pinpoint\Siren;

use UnexpectedValueException;

class FieldTypeTest extends \PHPUnit_Framework_TestCase
{
    public function testJsonHidden()
    {
        $fieldType = new FieldType(FieldType::HIDDEN);
        $this->assertEquals('"HIDDEN"', json_encode($fieldType));
    }

    public function testStringHidden()
    {
        $fieldType = new FieldType(FieldType::HIDDEN);
        $this->assertEquals('HIDDEN', $fieldType);
    }

    public function testDefault()
    {
        $fieldType = new FieldType();
        $this->assertEquals('"TEXT"', json_encode($fieldType));
    }

    public function testFailure()
    {
        $this->setExpectedException('UnexpectedValueException');
        $fieldType = new FieldType('BOGUS');
    }
}
