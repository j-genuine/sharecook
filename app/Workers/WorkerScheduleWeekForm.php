<?php
namespace App\Workers;

use Carbon\Carbon;
use App\Calendar\CalendarWeek;
use App\Calendar\HolidaySetting;

class WorkerScheduleWeekForm extends CalendarWeek {
	/**
	 * ExtraHoliday[]
	 */
	public $holidays = [];
	
	function getDay(Carbon $date, HolidaySetting $setting){

		$day = new WorkerScheduleWeekDayForm($date);
		$day->checkHoliday($setting);
		
		if(isset($this->workable_times[$day->getDateKey()])){
			$day->workSchedule = $this->workable_times[$day->getDateKey()];
			
		}
		
		//$day->workable_times = $this->workable_times;
		print_r($this->workable_times);
		//print " ■ ".isset($this->workable_times[0][$day->getDateKey()]);

		
		return $day;
	}
}