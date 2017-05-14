@extends('layouts.master')


@section('content')
	
	<div class="col-sm-8">

		<h1>Gäste von {{ $event->name }}</h1>

			<hr>

		@if(!count($event->guests))

			<p>Es sind noch keine Gäste bei diesem Event eingecheckt.</p>

		@else

			<ul class="guests">

			@foreach($event->guests as $guest)

				<li>{{ $guest->nick_name }}</li>

			@endforeach

			</ul>
		
		@endif

	</div>

@endsection


@section('sidebar')

	@include('admin.layouts.sidebar')

@endsection