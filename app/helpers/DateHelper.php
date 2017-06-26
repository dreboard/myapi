<?php
namespace App\Helpers;

/**
 * Trait DateHelper
 * @package App\Helpers
 */
trait DateHelper
{

    /**
     * Check if dob string is a valid date, in allowed year range
     * and is formatted with datepicker
     *
     * @param string $dob (date string)
     * @return bool
     */
    public function is_valid_dob($dob) {

        if (preg_match("#[\/]#", $dob) == 0) {
            return false;
        }

        list($month, $day, $year) = explode("/", $dob);
        if(checkdate($month, $day, $year) === false)
        {
            return false;
        }

        if($year < (date('Y') - MIN_ACCOUNT_NUM) || $year > date('Y')) {
            return false;
        }

        return true;
    }

}