<?php
namespace Pinpoint\Siren;

class FieldType extends Enum
{
    const __DEFAULT = self::TEXT;

    const HIDDEN = 'HIDDEN';
    const TEXT = 'TEXT';
    const SEARCH = 'SEARCH';
    const TEL = 'TEL';
    const URL = 'URL';
    const EMAIL = 'EMAIL';
    const PASSWORD = 'PASSWORD';
    const DATETIME = 'DATETIME';
    const DATE = 'DATE';
    const MONTH = 'MONTH';
    const WEEK = 'WEEK';
    const TIME = 'TIME';
    const DATETIME_LOCAL = 'DATETIME-LOCAL';
    const NUMBER = 'NUMBER';
    const RANGE = 'RANGE';
    const COLOR = 'COLOR';
    const CHECKBOX = 'CHECKBOX';
    const RADIO = 'RADIO';
    const FILE = 'FILE';
    const IMAGE = 'IMAGE';
    const BUTTON = 'BUTTON';
}
