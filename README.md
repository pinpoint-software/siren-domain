Siren Domain
============
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/pinpoint-software/siren-domain/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/pinpoint-software/siren-domain/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/pinpoint-software/siren-domain/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/pinpoint-software/siren-domain/?branch=master)
[![Build Status](https://travis-ci.org/pinpoint-software/siren-domain.svg?branch=master)](https://travis-ci.org/pinpoint-software/siren-domain)

*Siren Domain* is a library that can be used to easily build and render siren entities.

See: [Siren: a hypermedia specification for representing entities](https://github.com/kevinswiber/siren)

Requirements
------------

- PHP 5.4 or above, and is also tested to work with HHVM.

Usage
-----

```php
<?php
require __DIR__ . '/vendor/autoload.php';

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
```

will generate:

```json
{
    "class": [
        "order"
    ],
    "properties": {
        "orderNumber": 42,
        "itemCount": 3,
        "status": "pending"
    },
    "entities": [
        {
            "href": "http:\/\/api.x.io\/orders\/42\/items",
            "class": [
                "items",
                "collection"
            ],
            "rel": [
                "http:\/\/x.io\/rels\/order-items"
            ]
        },
        {
            "class": [
                "info",
                "customer"
            ],
            "properties": {
                "customerId": "pj123",
                "name": "Peter Joseph"
            },
            "links": [
                {
                    "rel": [
                        "self"
                    ],
                    "href": "http:\/\/api.x.io\/customers\/pj123"
                }
            ],
            "rel": [
                "http:\/\/x.io\/rels\/customer"
            ]
        }
    ],
    "actions": [
        {
            "name": "add-item",
            "href": "http:\/\/api.x.io\/orders\/42\/items",
            "method": "POST",
            "title": "Add Item",
            "type": "application\/x-www-form-urlencoded",
            "fields": [
                {
                    "name": "orderNumber",
                    "type": "hidden",
                    "value": "42"
                },
                {
                    "name": "productCode",
                    "type": "text"
                },
                {
                    "name": "quantity",
                    "type": "number"
                }
            ]
        }
    ],
    "links": [
        {
            "rel": [
                "self"
            ],
            "href": "http:\/\/api.x.io\/orders\/42"
        },
        {
            "rel": [
                "previous"
            ],
            "href": "http:\/\/api.x.io\/orders\/41"
        },
        {
            "rel": [
                "next"
            ],
            "href": "http:\/\/api.x.io\/orders\/43"
        }
    ]
}
```

About
=====

Submitting bugs and feature requests
------------------------------------

Bugs and feature request are tracked on [GitHub](https://github.com/pinpoint-software/siren-domain/issues)

Author
------

Andrew Shell - <andrew@andrewshell.org> - <http://twitter.com/andrewshell>

License
-------

Siren Domain is licensed under the MIT License - see the `LICENSE` file for details.
