@extends('layouts.master')


@section('content')
	
	<div class="col-sm-8">

		<h1>Codes von {{ $event->name }}</h1>

			<hr>

			<div class="taskbar">

				<a href="/admin/events/{{ $event->id }}/codes/create" class="btn btn-secondary">

					<i class="fa fa-plus-square" aria-hidden="true"></i>
					<span>Erstellen</span>

				</a>

			</div>

			<div class="alert alert-info" role="alert">
				Code-Screen für die Gäste: <a href="/events/{{ $event->id }}/codes"><strong>{{ $app->make('url')->to('/events/'.$event->id.'/codes') }}</strong></a>
			</div>

		@if(!count($event->activation_codes))

			<p>Es sind noch keine Codes bei diesem Event vorhanden.</p>

		@else

			<table class="table table-responsive codes">

				<thead>

					<tr>

						<th>Code</th>

						<th>Status</th>

						<th>Gast</th>

					</tr>

				</thead>

				<tbody>

					@foreach($event->activation_codes as $code)

						<tr class="code">

							<td>{{ $code->code }}</td>

							<td>{{ $code->status }}</td>

							<td>
								@if($code->guest['nick_name'])
									<a href="/admin/guests/{{$code->guest['id'] }}">
										{{ $code->guest['nick_name'] }}
									</a>
								@else
									-
								@endif
							</td>

						</tr>

					@endforeach

				</tbody>

			</table>
		
		@endif

	</div>

@endsection


@section('sidebar')

	@include('admin.layouts.sidebar')

@endsection