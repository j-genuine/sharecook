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

				//ランチ
				if($workable_time->isLunchOpen()){
					//予約が無ければリンク作成、あれば無効化
					$reserveButton .= $workable_time->userReservation()->first() ?
						'<i class="fas fa-times text-danger"></i><span class="badge badge-secondary">ランチ　</span><br />' :
						'<i class="far fa-circle text-primary"></i><a href="'.$reserveUrl.'" class="badge badge-success">ランチ　</a><br />';
				}
				//ディナー
				if($workable_time->isDinnerOpen()){
					//予約が無ければリンク作成、あれば無効化
					$reserveButton .= $workable_time->userReservation()->first() ?
						'<i class="fas fa-times text-danger"></i><span class="badge badge-secondary">ディナー</span>' :
						'<i class="far fa-circle text-primary"></i><a href="'.$reserveUrl.'" class="badge badge-primary">ディナー</a>';
				}
				
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