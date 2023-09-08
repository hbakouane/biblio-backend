@php
    /*
     * @var Book $book
     */
@endphp

@extends('core::layouts.mail')

@section('body')
"{{ $book['title'] }}"'s publisher has deleted their book that was in your cart, your order has been updated.
@endsection
