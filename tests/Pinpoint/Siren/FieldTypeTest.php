<?php
namespace Pinpoint\Siren;

use UnexpectedValueException;

class FieldTypeTest extends \PHPUnit_Framework_TestCase
{
    public function testText()
    {
        $fieldType = new FieldType(FieldType::TEXT);
        $this->assertEquals('"TEXT"', json_encode($fieldType));
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
