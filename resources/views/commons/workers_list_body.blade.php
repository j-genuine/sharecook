<div class="row p-2" style="background-color:#FFFFDD;">
@foreach ($workers as $worker)
    <div class="col-md-6 p-3 text-center" style="background-color:#FFF;border:2px #99FF66 dotted">
        <div class="row">
            <div class="col-md-3 text-md-center my-auto" style="background:#EEEEEE;">
            @if ($work_image = $worker->workImages()->orderBy("updated_at","desc")->first())
                {!! $work_image->workImageTag(80, 80) !!}
            @else
                <img src="/images/work_image_dummy.png" width="80" height='80' />
            @endif
            </div>
            <div class="col-md-9 text-md-center">
                <table class="profile_s" style="width:100%">
                    <tr>
                        <td colspan="2">
                        {!! link_to_route('workerinfo', $worker->nickname, ['wid' => $worker->id]) !!}
                        </td>
                        <td rowspan="3">
                             {!! $worker->portraitImageTag(60, 60) !!}
                        </td>
                    </tr>
                    <tr>
                        <th>エリア：</th>
                        <td>
                            @foreach ($worker->workerAreas()->orderBy("priority_flag")->get() as $worker_area)
                                {{ $worker_area->Area()->value("name") }}
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>ジャンル：</th>
                        <td>
                            @foreach ($worker->workerSkills()->orderBy("priority_flag")->get() as $worker_skill)
                                {{ $worker_skill->Skill()->value("name") }}
                            @endforeach
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endforeach
@if(!isset($worker))
    <div class="text-center">対象となるシェフは見つかりませんでした。</div>
@endif
</div>
