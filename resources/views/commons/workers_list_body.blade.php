<div class="row p-2" style="background-color:#FFFFDD;">
@foreach ($workers as $worker)
    <div class="col-md-6 p-2 text-center" style="background-color:#FFF; border:2px #99FF66 dotted; border-radius: 10px;">
        <div class="row">

            <table class="profile_s">
                <tr>
                    <td rowspan="4" style="width:25%; text-align:center">
                        <a href="workerinfo?wid={{ $worker->id }}">
                        @if ($work_image = $worker->workImages()->orderBy("updated_at","desc")->first())
                            {!! $work_image->workImageTag(80, 80) !!}
                        @else
                            <img src="/images/work_image_dummy.png" width="80" height='80' />
                        @endif
                        </a>
                    </td>
                    <th style="width:55%">
                        <i class="fas fa-user text-info" title="シェフ名"></i>
                        {!! link_to_route('workerinfo', $worker->nickname, ['wid' => $worker->id]) !!}
                    </th>
                    <td class="profileimg" rowspan="4">
                         {!! $worker->portraitImageTag(80, 80) !!}
                    </td>
                </tr>
                <tr>
                    <td>
                        <i class="fas fa-map-marker-alt text-danger" title="出張エリア"></i>
                        @foreach ($worker->workerAreas()->orderBy("priority_flag")->get() as $worker_area)
                            {{ $worker_area->Area()->value("name") }}
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td>
                        <i class="fas fa-globe text-primary" title="得意ジャンル"></i>
                        @foreach ($worker->workerSkills()->orderBy("priority_flag")->get() as $worker_skill)
                            {{ $worker_skill->Skill()->value("name") }}
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="badge badge-success" title="ランチ謝礼">L</span> ￥{{ $worker->price_lunch ? number_format($worker->price_lunch) : "－" }} 
                        <span class="badge badge-primary" title="ディナー謝礼">D</span> ￥{{ $worker->price_dinner ? number_format($worker->price_dinner) : "－" }}
                    </td>
                </tr>
            </table>

        </div>
    </div>
@endforeach
@if(!isset($worker))
    <div class="text-center">対象となるシェフは見つかりませんでした。</div>
@endif
</div>
