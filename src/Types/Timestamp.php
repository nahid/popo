<?php declare(strict_types=1);

namespace Nahid\Popo\Types;

use DateTime;
use DateTimeZone;

class Timestamp extends Type
{
    protected $name = 'timestamp';
    protected $default = null;

    /**
     * check this given value is timestamp type
     *
     * @param $var
     * @return bool
     */
    public function is($var) : bool
    {
        return $this->isValidDateTime($var);
    }

    /**
     * check this value is a valid timestamp
     *
     * @param        $dateTime
     * @param string $format
     * @param string $timezone
     * @return bool
     */
    private function isValidDateTime(string $dateTime, string $format = 'Y-m-d h:i:s', string $timezone = 'UTC') : bool
    {
        $date = DateTime::createFromFormat($format, $dateTime, new DateTimeZone($timezone));
        return $date && DateTime::getLastErrors()["warning_count"] == 0 && DateTime::getLastErrors()["error_count"] == 0;
    }
}