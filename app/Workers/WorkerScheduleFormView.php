<?php
namespace App\Workers;

use Carbon\Carbon;
use App\Calendar\CalendarView;

//use App\Calendar\WorkerSchedule;
use App\Calendar\CalendarWeekDay;

/**
* 表示用
*/
class WorkerScheduleFormView extends CalendarView {
	/**
	 * @return CalendarWeek
	 */

/*
	protected function getWeek(Carbon $date, $index = 0){
		$week = new WorkerScheduleWeekForm($date, $index);

		//稼働可能日時を設定する
		$start = $date->copy()->startOfWeek()->format("Ymd");
		$end = $date->copy()->endOfWeek()->format("Ymd");

		$week->workable_times = $this->workable_times->filter(function($value, $key) use($start, $end){
			return $key >= $start && $key <= $end;
		})->KeyBy("date_key");

		return $week;
	}
*/

	/**
	 * 日を描画する
	 */

	protected function renderDay(CalendarWeekDay $day){

		$html = [];

		$isCheckedLunch = "";
		$comment_lunch = "";
		$isCheckedDinner = "";
		$comment_dinner = "";

		//checkboxの名前
		$checkbox_lunch_name = "worker_schedule[" . $day->getDateKey() . "][lunch_flag]";
		$checkbox_dinner_name = "worker_schedule[" . $day->getDateKey() . "][dinner_flag]";
		//コメントのinputの名前
		$comment_lunch_name = "worker_schedule[" . $day->getDateKey() . "][lunch_comment]";
		$comment_dinner_name = "worker_schedule[" . $day->getDateKey() . "][dinner_comment]";

		// 稼働可能登録済みなら、ランチ・ディナーのチェックボックスにチェックと、コメント文字列を取得
		if(isset($this->workable_times[$day->getDateKey()])){
			$workable_times = $this->workable_times[$day->getDateKey()];
			
			// ランチ・ディナー両方あれば2レコードあり
			foreach($workable_times as $workable_time){
			
				if($workable_time->isLunchOpen()){
					$isCheckedLunch = 'checked="checked"';
					$comment_lunch = $workable_time->comment;
				}elseif($workable_time->isDinnerOpen()){
					$isCheckedDinner = 'checked="checked"';
					$comment_dinner = $workable_time->comment;
				}
			}
		}

		//日付
		$td_style_class = $day->getClassName();
		$html[] = '<td class="'.$td_style_class.'">';
		$html[] = $day->render($this->workable_times);

		//チェックボックスとコメント欄
		//　※月前後の空白日は作成しない
		if($td_style_class != "day-blank"){
			$html[] = '<input type="checkbox" name="'. $checkbox_lunch_name . '" value="1" '. $isCheckedLunch. '>ランチ';
			$html[] = '<input class="form-control form-control-sm" type="text" name="'.$comment_lunch_name.'" value="'.e($comment_lunch).'" maxlength="12" />';
			$html[] = '<input type="checkbox" name="'. $checkbox_dinner_name . '" value="1" '. $isCheckedDinner. '>ディナー';
			$html[] = '<input class="form-control form-control-sm" type="text" name="'.$comment_dinner_name.'" value="'.e($comment_dinner).'" maxlength="12" />';
		}

		$html[] = '</td>';

		return implode("", $html);
	}


	
	function render(){
		return parent::render() . 
			 "<input type='hidden' name='ym' value='".$this->carbon->format("Ym")."' />" .
			 "<input type='hidden' name='date' value='".$this->carbon->format("Y-m")."' />";
	}

}