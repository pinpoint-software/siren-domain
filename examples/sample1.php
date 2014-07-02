<?php
require __DIR__ . '/../vendor/autoload.php';

use Pinpoint\Siren\Action;
use Pinpoint\Siren\Entity;
use Pinpoint\Siren\EntityLink;
use Pinpoint\Siren\Field;
use Pinpoint\Siren\FieldType;
use Pinpoint\Siren\Method;
use Pinpoint\Siren\Rel;

$orderItemsRel = new Rel('http://x.io/rels/order-items');
$orderItems = new EntityLink('http://api.x.io/orders/42/items');
$orderItems->setClass('items', 'collection');

$customerRel = new Rel('http://x.io/rels/customer');
$customer = new Entity();
$customer->setClass('info', 'customer');
$customer->setProperty('customerId', 'pj123');
$customer->setProperty('name', 'Peter Joseph');
$customer->addLink(new Rel('self'), 'http://api.x.io/customers/pj123');

$orderNumberField = new Field('orderNumber', FieldType::HIDDEN());
$orderNumberField->setValue('42');

$productCodeField = new Field('productCode');

$quantityField = new Field('quantity', FieldType::NUMBER());

$addItem = new Action('add-item', 'http://api.x.io/orders/42/items', Method::POST());
$addItem->setTitle('Add Item');
$addItem->setType('application/x-www-form-urlencoded');
$addItem->addField($orderNumberField);
$addItem->addField($productCodeField);
$addItem->addField($quantityField);

$order = new Entity();
$order->setClass('order');
$order->setProperty('orderNumber', 42);
$order->setProperty('itemCount', 3);
$order->setProperty('status', 'pending');
$order->addEntityLink($orderItemsRel, $orderItems);
$order->addEntity($customerRel, $customer);
$order->addAction($addItem);
$order->addLink(new Rel('self'), 'http://api.x.io/orders/42');
$order->addLink(new Rel('previous'), 'http://api.x.io/orders/41');
$order->addLink(new Rel('next'), 'http://api.x.io/orders/43');

echo json_encode($order, JSON_PRETTY_PRINT);
