@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">
                  シェフ一覧
					</div>
               <div class="card-body">
               <table class="table table-striped">
                  @foreach ($workers as $worker)
                  <tr>
                     <td>{{ $worker->id }}</td>
                     <td>{!! link_to_route('workerinfo', $worker->nickname, ['wid' => $worker->id]) !!}
                        <ul>
                           <li>[謝礼] ランチ：￥{{ $worker->price_lunch }} ディナー：￥{{ $worker->price_dinner }}</li>
                           <li>[キャリア] アマ：{{ $worker->amature_career }}年 プロ{{ $worker->pro_career }}年</li>
                        </ul>
                     </td>
                  </tr>
                   @endforeach
               </table>
					{{ $workers->links() }}
               </div>
           </div>
       </div>
   </div>
</div>
@endsection