@extends(backpack_view('blank'))

@php
    $widgets['before_content'][] = [
        'type'    => 'div',
        'class'   => 'row',
        'content' => [
            [
                'type'        => 'progress',
                'class'       => 'card text-white bg-primary mb-2',
                'value'       => \App\Models\User::count(),
                'description' => 'Registered users.',
            ],
            [
                'type'        => 'progress',
                'class'       => 'card text-white bg-danger mb-2',
                'value'       => \App\Models\Product::count(),
                'description' => 'Published products.',
            ],
            [
                'type'        => 'progress',
                'class'       => 'card text-white bg-warning mb-2',
                'value'       => \App\Models\Category::count(),
                'description' => 'Product categories.',
            ],
            [
                'type'        => 'progress',
                'class'       => 'card text-white bg-success mb-2',
                'value'       => \App\Models\Tag::count(),
                'description' => 'Product tags.',
            ]
        ]
    ];
@endphp

@section('content')
@endsection
