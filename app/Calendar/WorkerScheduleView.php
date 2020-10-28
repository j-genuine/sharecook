<?php
namespace App\Calendar;
use Carbon\Carbon;
use App\Calendar\CalendarView;
use App\Calendar\CalendarWeekDay;
/**
* 表示用
*/
class WorkerScheduleView extends CalendarView {
	
	/**
	 * 日を描画する
	 */
	protected function renderDay(CalendarWeekDay $day){

		$html = [];
		$reserveButton = null;
		
		// 稼働可能日には、ランチ・ディナーの予約ボタン表示
		if(isset($this->workable_times[$day->getDateKey()])){
			$workable_times = $this->workable_times[$day->getDateKey()];
			
			// ランチ・ディナー両方あれば2レコードあり
			foreach($workable_times as $workable_time){
				$reserveUrl = '/users/reserve/create?wsid='.$workable_time->id;
				$reserveButton .= $workable_time->isLunchOpen() ? '<a href="'.$reserveUrl.'" class="badge badge-success">ランチ</a>' : '';
				$reserveButton .= $workable_time->isDinnerOpen() ? '<a href="'.$reserveUrl.'" class="badge badge-primary">ディナー</a>' : '';
				$reserveButton .= $workable_time->comment ? '<div class="small">' . e($workable_time->comment).'</div>' : "";
			}
		}
		

		$html[] = '<td class="'.$day->getClassName().'">';
		$html[] = $day->render();

        //予約ボタンがあればボタンとコメントを表示
		if($reserveButton){
			$html[] .= $reserveButton;
		}

		$html[] = '</td>';

		return implode("", $html);
	}
}