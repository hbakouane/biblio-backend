@extends('core::layouts.mail')

@section('body')


    <div class="text-center mt-3">
        @include('core::_partials.mails.cta', [
            'text' => __('app.mail.update_quantity'),
            'url' => config('app.url') // TODO: Put the route of editing quantity
        ])
    </div>
@endsection
