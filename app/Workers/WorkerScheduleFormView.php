<?php
namespace App\Workers;
use Carbon\Carbon;
use App\Calendar\CalendarView;
use App\Calendar\WorkerSchedule;
/**
* 表示用
*/
class WorkerScheduleFormView extends CalendarView {
	/**
	 * @return CalendarWeek
	 */
	protected function getWeek(Carbon $date, $index = 0){
		$week = new WorkerScheduleWeekForm($date, $index);

		//稼働可能日時を設定する
		$start = $date->copy()->startOfWeek()->format("Ymd");
		$end = $date->copy()->endOfWeek()->format("Ymd");

		$week->workable_times = $this->workable_times->filter(function($value, $key) use($start, $end){
			return $key >= $start && $key <= $end;
		})->groupBy("date_key");

		return $week;
	}
	
	function render(){
		return parent::render() . 
			 "<input type='hidden' name='ym' value='".$this->carbon->format("Ym")."' />" .
			 "<input type='hidden' name='date' value='".$this->carbon->format("Y-m")."' />";
	}
}