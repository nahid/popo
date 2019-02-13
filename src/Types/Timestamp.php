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
     * @param        $str_dt
     * @param string $str_dateformat
     * @param string $str_timezone
     * @return bool
     */
    private function isValidDateTime($str_dt, $str_dateformat = 'Y-m-d h:i:s', $str_timezone = 'UTC') : bool
    {
        $date = DateTime::createFromFormat($str_dateformat, $str_dt, new DateTimeZone($str_timezone));
        return $date && DateTime::getLastErrors()["warning_count"] == 0 && DateTime::getLastErrors()["error_count"] == 0;
    }
}