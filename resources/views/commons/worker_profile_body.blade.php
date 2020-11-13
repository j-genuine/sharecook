<div class="row">
  <div class="col-md-3 my-auto">
      {!! $worker->portraitImageTag() !!}
  </div>
  
  <div class="col-md-9">
     <table class="profile">
          <tr>
              <th><i class="fas fa-map-marker-alt text-danger"></i> 出張エリア：</th>
              <td>
              @foreach ($worker->workerAreas()->orderBy("priority_flag")->get() as $worker_area)
                {{ $worker_area->Area()->value("name") }}&nbsp;
              @endforeach
              </td>
          </tr>
          <tr>
              <th><i class="fas fa-gift text-warning"></i> 希望謝礼額：</th>
              <td>
              [ランチ] ￥{{ $worker->price_lunch ? number_format($worker->price_lunch) : "応談" }}
              [ディナー] ￥{{ $worker->price_dinner ? number_format($worker->price_dinner) : "－" }} 
              </td>
          </tr>
          <tr>
              <th><i class="fas fa-utensils text-success"></i> 料理経験：</th>
              <td>
              [アマチュア] {{ number_format($worker->amature_career) }}年 [プロ] {{ number_format($worker->pro_career) }}年 
              </td>
          </tr>
          <tr>
              <th><i class="fas fa-globe text-primary"></i> 得意ジャンル：</th>
              <td>
                 @foreach ($worker->workerSkills()->orderBy("priority_flag")->get() as $worker_skill)
                   {{ $worker_skill->Skill()->value("name") }}&nbsp;
                 @endforeach
              </td>
          </tr>
          <tr>
              <td colspan="2">
                 <div class="font-weight-bold">【PRコメント】</div>
                 {{ $worker->comment }}
              </td>
          </tr>
     </table>
  </div>
</div>