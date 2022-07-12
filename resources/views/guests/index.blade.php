@extends('layouts.layout-guest')

@section('content')
    @include('components.carousel')
    @include('components.list-category')
    @include('components.list-equipment')
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('owl-carousel/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('owl-carousel/css/owl.theme.default.css') }}">
@endsection

@section('script')
    <script src="{{ asset('owl-carousel/owl-carousel.js') }}"></script>
    <script>
        $(document).ready(function (){
           var owl = $('#owl-demo');

           owl.owlCarousel({
                itemsCustom: [
                    [0, 2],
                    [450, 4],
                    [600, 7]
                ],
                navigation: true,
           })
        });
    </script>
@endsection
