@extends('frontend.layouts.seller-layouts.seller-master')
@section('title', 'Seller Dashboard')
@section('content')
    @livewire('seller.seller-order-list')
    {{-- Hi this page is lock for you --}}
@endsection