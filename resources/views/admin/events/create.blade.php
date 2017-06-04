@extends('layouts.master')


@section('content')

    <div class="col-sm-8">

        <h1>Event erstellen</h1>

        <form action="/admin/events" method="POST" accept-charset="utf-8">

            {{ csrf_field() }}

            @include('layouts.errors')

            <div class="form-group">
                <label for="name">Event-Name:</label>
                <input type="text" class="form-control" name="name" id="name" required="required">
            </div>

            <div class="form-group">
                <label for="spotify_playlist_id">Spotify-Playlist-ID:</label>

                @if(!$playlists)
                    <input type="text" class="form-control" name="spotify_playlist_id" id="spotify_playlist_id"
                           required="required">
                @else
                    <select class="form-control" name="spotify_playlist_id" id="spotify_playlist_id" required="required">
                        @foreach($playlists as $playlist)
                            <option value="{{ $playlist->id }}">{{ $playlist->name }}</option>
                        @endforeach
                    </select>
                @endif
            </div>

            <div class="form-group">
                <label for="start">Start:</label>
                <input class="form-control" type="datetime-local" id="start" name="start"
                       value="{{ Carbon\Carbon::now()->format('Y-m-d\TH:i') }}" required="required">
            </div>

            <div class="form-group">
                <label for="end">Ende:</label>
                <input class="form-control" type="datetime-local" id="end" name="end"
                       value="{{ Carbon\Carbon::now()->format('Y-m-d\TH:i') }}" required="required">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Event erstellen</button>
            </div>

        </form>

    </div>

@endsection


@section('sidebar')

    @include('admin.layouts.sidebar')

@endsection