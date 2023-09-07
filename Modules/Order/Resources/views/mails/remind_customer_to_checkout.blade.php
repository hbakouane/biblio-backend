@php
    /*
     * @var Order $order
     * @var Profile $customer
     */
@endphp

@extends('core::layouts.mail')

@section('body')
    <div>
        <p>{{ __('app.mails.reminder_body') }}</p>

        <div class="bg-gray border radius p-3">
            <p>{{ __('app.order.quantity') }}: {{ $order->items->sum('quantity') }}</p>
            <p>{{ __('app.order.total') }}: ${{ $order->total }}</p>
        </div>

        @include('core::_partials.mails.cta', [
            'text' => __('app.mail.checkout_now'),
            'url' => config('app.url') // TODO: Put the route of editing quantity
        ])
    </div>
@endsection
