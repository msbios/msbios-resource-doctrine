<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Resource\Doctrine;

use MSBios\Stdlib\Enum;

/**
 * Class Operator
 * @package MSBios\Resource\Doctrine
 */
class Operator extends Enum
{
    const EQUAL = 'EQUAL';
    const NOT_EQUAL = 'NOT_EQUAL';
    const IN = 'IN';
    const NOT_IN = 'NOT_IN';
    const LESS_THAN = 'LESS_THAN';
    const LESS_THAN_OR_EQUAL = 'LESS_THAN_OR_EQUAL';
    const GREAT_THAN = 'GREAT_THAN';
    const GREAT_THAN_OR_EQUAL = 'GREAT_THAN_OR_EQUAL';
    const IS_NULL = 'IS_NULL';

    const ALL = [
        self::EQUAL,
        self::NOT_EQUAL,
        self::IN,
        self::NOT_IN,
        self::LESS_THAN,
        self::LESS_THAN_OR_EQUAL,
        self::GREAT_THAN,
        self::GREAT_THAN_OR_EQUAL,
        self::IS_NULL
    ];
}