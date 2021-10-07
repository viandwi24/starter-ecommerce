@extends('layouts.app')

@php
    $products = [];
    $seeds = \App\Models\Product::with('tags', 'images')->get();
    $products = $seeds;
    // for ($i=0; $i < 10; $i++) {
    //     $products = array_merge($products, $seeds->toArray());
    // }
    // foreach ($products as $key => $product) {
    //     $products[$key] = (object) $product;
    // }

    //
    $productsGroups = [
        [ 'title' => 'Hot Products' ],
        [ 'title' => 'Promo Products' ],
    ];
@endphp

@section('content')
    <x-container>
        <div id="banner" class="owl-carousel owl-theme">
            <div class="item">
                <img src="{{ banner_image('aud87612398sza.png') }}" alt="Banner">
            </div>
            <div class="item">
                <img src="{{ banner_image('1239asdjaw.png') }}" alt="Banner">
            </div>
            <div class="item">
                <img src="{{ banner_image('1239asdjaw.png') }}" alt="Banner">
            </div>
        </div>
    </x-container>
    @foreach ($productsGroups as $group_key => $group)
        <x-container class="mt-4">
            <div class="flex items-baseline mb-2">
                <div class="text-2xl font-bold text-black">
                    {{ $group['title'] }}
                </div>
                <a href="" class="text-xs ml-2 text-red-500">
                    <span>View All</span>
                    <i class="fa fa-arrow-right"></i>
                </a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @foreach ($products as $product)
                    <div class="">
                        <a href="" class="{{ generate_class('card') }} product" title="{{ $product->name }}">
                            <img class="image" src="{{ product_images($product->images[0]['path']) }}" alt="Product Image">
                            <div class="detail">
                                <div class="title">
                                    {{ $product->name }}
                                </div>
                                <div class="price">
                                    {{ money($product->sale_price) }}
                                </div>
                                <div class="rating">
                                    @php
                                        $rate = 4.7;
                                    @endphp
                                    @for ($i = 0; $i < 5; $i++)
                                        @if ($i < floor($rate))
                                            <i class="fa fa-star icon text-yellow-500"></i>
                                        @else
                                            <i class="fa fa-star icon text-yellow-300"></i>
                                        @endif
                                    @endfor
                                    <span class="text">{{ $rate }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            @if ($group_key !== count($productsGroups) - 1)
                <div class="mt-4 h-0.5 w-full border-b border-gray-300"></div>
            @endif
        </x-container>
    @endforeach
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('packages/owl-carousel/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/owl-carousel/dist/assets/owl.theme.default.min.css') }}">
    <style>
        .owl-carousel {
            border-radius: 1rem;
            overflow: hidden;
        }
        .owl-carousel .item img {
            display: block;
            width: 100%;
            height: auto;
        }
        .owl-carousel .owl-dots {
            position: absolute;
            bottom: 0;
            margin-left: 0.5rem;
            margin-bottom: 0.2rem;
        }
    </style>
@endpush


@push('scripts:start')
    <script src="{{ asset('packages/jquery/jquery-3.6.0.min.js') }}"></script>
@endpush

@push('scripts')
    <script src="{{ asset('packages/owl-carousel/dist/owl.carousel.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            const options = {
                navigation : true,
                slideSpeed : 300,
                paginationSpeed : 400,
                singleItem: true,
                items: 1,
                autoplay: true,
                autoplayTimeout: 5000,
            };
            $("#banner").owlCarousel(options);
        });
    </script>
@endpush
