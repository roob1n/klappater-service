@extends('layouts.master')


@section('content')

    <div class="col-sm-8">

        <h1>Location erstellen</h1>

        @if($spotify_url)
            <a class="btn btn-info" href="{{ $spotify_url }}">
                Spotify Account authentifizieren
            </a>
        @endif

        <form action="/admin/location" method="POST" accept-charset="utf-8">

            {{ csrf_field() }}

            @include('layouts.errors')

            <div class="form-group">
                <label for="name">Location-Name:</label>
                <input type="text" class="form-control" name="name" id="name" required="required">
            </div>

            <div class="form-group">
                <label for="spotify_token">Spotify Access Token:</label>
                <input type="text" class="form-control" name="spotify_token" id="spotify_token" readonly="readonly"
                       required="required" value="{{ ($access_token) ? $access_token : "" }}">

                @if($access_token)
                    <input type="hidden" name="expires_in" value="{{ $expires }}" />
                    <input type="hidden" name="refresh_token" value="{{ $refresh_token }}" />
                @endif
            </div>


            <div class="form-group">
                <button type="submit" class="btn btn-primary">Location erstellen</button>
            </div>

        </form>

    </div>

@endsection


@section('sidebar')

    @include('admin.layouts.sidebar')

@endsection
