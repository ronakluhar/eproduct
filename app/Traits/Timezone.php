<?php

namespace App\Traits;

use Carbon\Carbon;

trait Timezone {

    public $timezoneOffset = 0;

    public function convertTimeToUTC(Carbon $time, $currentTimezoneOffsetFromUTC)
    {
        if ($currentTimezoneOffsetFromUTC > 0) {
            $time = $time->addHours(ceil($currentTimezoneOffsetFromUTC / 60));
        } elseif ($currentTimezoneOffsetFromUTC < 0) {
            $time = $time->subHours(ceil(($currentTimezoneOffsetFromUTC * (-1)) / 60));
        }

        return $time;
    }

    public function adaptTimeToTimezoneOffset(Carbon $time)
    {
        if ($this->timezoneOffset > 0) {
            $time = $time->subHours(ceil($this->timezoneOffset / 60));
        } elseif ($this->timezoneOffset < 0) {
            $time = $time->addHours(ceil(($this->timezoneOffset * (-1)) / 60));
        }

        return $time;
    }

}
