@extends('core::layouts.mail')

@section('body')
    {!! __('app.mail.welcome.content', ['name' => $user['first_name']]) !!}

    <div class="text-center mt-3">
        @include('core::_partials.mails.cta', [
            'text' => __('app.mail.discover_books'),
            'url' => config('app.url')
        ])
    </div>
@endsection
