<?php
namespace App\Workers;

use Carbon\Carbon;

use App\Calendar\CalendarWeekDay;
use App\Calendar\HolidaySetting;
use App\Calendar\WorkerSchedule;

class WorkerScheduleWeekDayForm extends CalendarWeekDay {

	public  $workSchedule = null; 

	/**
	 * @return 
	 */
	function render(){
		//checkboxの名前
		$checkbox_lunch_name = "worker_schedule[" . $this->carbon->format("Ymd") . "][lunch_flag]";
		$checkbox_dinner_name = "worker_schedule[" . $this->carbon->format("Ymd") . "][dinner_flag]";
		//コメントのinputの名前
		$comment_form_name = "worker_schedule[" . $this->carbon->format("Ymd") . "][comment]";

		//if(isset($this->workable_times)){ print_r($this->workSchedule);
		//exit;}

		//ランチ営業が選択されているかどうか
		$isCheckedLunch = ($this->workSchedule && $this->workSchedule->isLunchOpen()) ? 'checked="checked"' : '';
		//ディナー営業が選択されているかどうか
		$isCheckedDinner = ($this->workSchedule && $this->workSchedule->isDinnerOpen()) ? 'checked="checked"' : '';
		//コメントの値
		$comment = ($this->workSchedule) ? $this->workSchedule->comment : '';
		
		//HTMLの組み立て
		$html = [];
		
		//日付
		$html[] = '<p class="day">' . $this->carbon->format("j"). '</p>';
		//ランチ営業設定
		$html[] = '<input type="checkbox" name="'. $checkbox_lunch_name . '" value="1" '. $isCheckedLunch. '>ランチ';
		$html[] = '<input type="checkbox" name="'. $checkbox_dinner_name . '" value="1" '. $isCheckedDinner. '>ディナー';
		//コメント
		if($isCheckedLunch || $isCheckedDinner){
			$html[] = '<input class="form-control" type="text" name="'.$comment_form_name.'" value="'.e($comment).'" />';
		}
		
		return implode("", $html);
	}
	
}