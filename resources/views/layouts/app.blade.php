@php
    $theme = config('app.active_theme', 'default');
@endphp

@if(View::exists('layouts.app'))
    @extends('layouts.app')
@elseif(View::exists('themes.' . $theme . '.layouts.app'))
    @extends('themes.' . $theme . '.layouts.app')
@else
    <h1>Fehler: Kein gültiges Theme gefunden!</h1>
@endif
