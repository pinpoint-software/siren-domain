<?php
namespace Pinpoint\Siren;

class FieldType extends Enum
{
    const __DEFAULT = self::TEXT;

    const HIDDEN = 'hidden';
    const TEXT = 'text';
    const SEARCH = 'search';
    const TEL = 'tel';
    const URL = 'url';
    const EMAIL = 'email';
    const PASSWORD = 'password';
    const DATETIME = 'datetime';
    const DATE = 'date';
    const MONTH = 'month';
    const WEEK = 'week';
    const TIME = 'time';
    const DATETIME_LOCAL = 'datetime-local';
    const NUMBER = 'number';
    const RANGE = 'range';
    const COLOR = 'color';
    const CHECKBOX = 'checkbox';
    const RADIO = 'radio';
    const FILE = 'file';
    const IMAGE = 'image';
    const BUTTON = 'button';
}
