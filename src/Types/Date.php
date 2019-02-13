<?php declare(strict_types=1);

namespace Nahid\Popo\Types;

use DateTime;
use Exception;

class Date extends Type
{
    protected $name = 'date';
    protected $default = null;

    /**
     * check this given value is date type
     *
     * @param $var
     * @return bool
     */
    public function is($var) : bool
    {
        return $this->isDate($var);
    }

    /**
     * check this value is a valid date
     *
     * @param $date
     * @return bool
     */
    private function isDate( $date ) : bool
    {
        try {
            $dt = new DateTime( trim($date) );
        }
        catch( Exception $e ) {
            return false;
        }
        $month = (int) $dt->format('m');
        $day = (int) $dt->format('d');
        $year = (int) $dt->format('Y');

        if( checkdate($month, $day, $year) ) {
            return true;
        }
        else {
            return false;
        }
    }
}