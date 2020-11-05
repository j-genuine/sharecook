<?php
namespace App\Workers;

use Carbon\Carbon;
use App\Calendar\CalendarView;
use App\Calendar\CalendarWeekDay;
use App\Users\UserReservation;

/**
* 表示用
*/
class WorkerScheduleFormView extends CalendarView {

	/**
	 * 日を描画する
	 */

	protected function renderDay(CalendarWeekDay $day){

		$html = [];

		$isCheckedLunch = "";
		$comment_lunch = "";
		$lunch_disabled = "";
		$lunch_reserved_icon = "";
		$isCheckedDinner = "";
		$comment_dinner = "";
		$dinner_disabled = "";
		$dinner_reserved_icon = "";

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
					//予約があればフォーム無効化
					if(UserReservation::find($workable_time->id)){
						$lunch_disabled = "disabled";
						$lunch_reserved_icon = '<i class="fas fa-clock"></i>';
					}
				}elseif($workable_time->isDinnerOpen()){
					$isCheckedDinner = 'checked="checked"';
					$comment_dinner = $workable_time->comment;
					if(UserReservation::find($workable_time->id)){
						$dinner_disabled = "disabled";
						$dinner_reserved_icon = '<i class="fas fa-clock"></i>';
					}
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
			$html[] = '<input type="checkbox" name="'. $checkbox_lunch_name . '" value="1" '.$isCheckedLunch.' '.$lunch_disabled.'>ランチ'.$lunch_reserved_icon;
			$html[] = '<input class="form-control form-control-sm" type="text" name="'.$comment_lunch_name.'" value="'.e($comment_lunch).'" maxlength="12" '.$lunch_disabled.' />';
			$html[] = '<input type="checkbox" name="'. $checkbox_dinner_name . '" value="1" '. $isCheckedDinner. ' '.$dinner_disabled.'>ディナー'.$dinner_reserved_icon;
			$html[] = '<input class="form-control form-control-sm" type="text" name="'.$comment_dinner_name.'" value="'.e($comment_dinner).'" maxlength="12" '.$dinner_disabled.' />';
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