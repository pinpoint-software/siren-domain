<?php
namespace Pinpoint\Siren;

use RuntimeException;

class FieldTest extends \PHPUnit_Framework_TestCase
{
    public function testNameJson()
    {
        $field = new Field();
        $field->setName('orderNumber');
        $this->assertEquals('{"name":"orderNumber","type":"text"}', json_encode($field));
    }

    public function testTypeJson()
    {
        $field = new Field();
        $field->setName('orderNumber');
        $field->setType(new FieldType(FieldType::HIDDEN));
        $this->assertEquals('{"name":"orderNumber","type":"hidden"}', json_encode($field));
    }

    public function testValueJson()
    {
        $field = new Field();
        $field->setName('orderNumber');
        $field->setValue('8675309');
        $this->assertEquals('{"name":"orderNumber","value":"8675309","type":"text"}', json_encode($field));
    }

    public function testTitleJson()
    {
        $field = new Field();
        $field->setName('orderNumber');
        $field->setTitle('Order Number');
        $this->assertEquals('{"name":"orderNumber","title":"Order Number","type":"text"}', json_encode($field));
    }

    public function testMissingNameJson()
    {
        $this->setExpectedException('Exception');
        $field = new Field();
        json_encode($field);
    }
}
