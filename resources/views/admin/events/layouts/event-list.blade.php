@if(!count($events))

Keine Events

<hr>


@else 

	@foreach($events as $event)

		<div class="event clearfix">
			<div class="event__info">
				<h3 class="event__title">{{ $event->name }}</h3>
				
				<div class="event__date">
					<time>{{ $event->start->format('d.m.Y H:i') }}</time>
					<span>&nbsp;-&nbsp;</span>
					<time>{{ $event->end->format('d.m.Y H:i') }}</time>
				</div>
			</div>

			<div class="event__tool-bar">

				<a href="/admin/events/{{ $event->id }}">
					<i class="fa fa-bar-chart"></i>
					<span>Statistik</span>
				</a>

				<a href="/admin/events/{{ $event->id }}/guests">
					<i class="fa fa-users"></i>
					<span>Gäste</span>
				</a>

				<a href="/admin/events/{{ $event->id }}/edit">
					<i class="fa fa-cog"></i>
					<span>Einstellungen</span>
				</a>

				<a href="/admin/events/{{ $event->id }}/codes">
					<i class="fa fa-qrcode"></i>
					<span>Codes</span>
				</a>

			</div>
		</div>

	@endforeach

@endif