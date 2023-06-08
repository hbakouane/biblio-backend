@extends('core::layouts.mail')

@section('body')

    <div class="row">

        <!-- Book Cover -->
        <div class="col-md-4">
            <div class="book-cover img-fluid" style="background-image: url('https://edit.org/images/cat/book-covers-big-2019101610.jpg');"></div>
        </div>
        <!-- / Book Cover -->

        <!-- Book Info -->
        <div class="col-md-8 my-auto">
            <h3 class="fw-bold">{{ $book['title'] }}</h3>
            <div class="badge badge-primary mb-2">
                {{ $book['category']['category'] }}
            </div>
            <p class="text-muted mt-0 py-0 mb-4">
                Copies left:
                <span class="text-danger">{{ (int) $book['quantity'] }}</span>
            </p>
            @include('core::_partials.mails.cta', [
                'text' => __('app.mail.update_quantity'),
                'url' => config('app.url') // TODO: Put the route of editing quantity
            ])
        </div>
        <!-- / Book Info -->
    </div>
@endsection
