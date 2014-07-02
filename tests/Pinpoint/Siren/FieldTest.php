<?php
namespace Pinpoint\Siren;

use RuntimeException;

class FieldTest extends \PHPUnit_Framework_TestCase
{
    public function testNameJson()
    {
        $field = new Field('orderNumber');
        $this->assertEquals('{"name":"orderNumber","type":"text"}', json_encode($field));
    }

    public function testTypeJson()
    {
        $field = new Field('orderNumber', new FieldType(FieldType::HIDDEN));
        $this->assertEquals('{"name":"orderNumber","type":"hidden"}', json_encode($field));
    }

    public function testValueJson()
    {
        $field = new Field('orderNumber');
        $field->setValue('8675309');
        $this->assertEquals('{"name":"orderNumber","type":"text","value":"8675309"}', json_encode($field));
    }

    public function testTitleJson()
    {
        $field = new Field('orderNumber');
        $field->setTitle('Order Number');
        $this->assertEquals('{"name":"orderNumber","type":"text","title":"Order Number"}', json_encode($field));
    }
}
