<?php
namespace Pinpoint\Siren;

class Method extends Enum
{
    const __DEFAULT = self::GET;

    const GET = 'GET';
    const PUT = 'PUT';
    const POST = 'POST';
    const DELETE = 'DELETE';
    const PATCH = 'PATCH';
}
