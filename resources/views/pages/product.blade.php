@extends('layouts.default')
@section('content')

    <h1>ID: {{ $product->id }}</h1>
    <h2>Type: {{ $product->type }}</h2>
    <p>Description: {{ $product->description }}</p>

    <p>Image: <a href="{{ $product->image_url }}">{{ $product->image_url }}</a></p>

    <h2>Variants:</h2>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Price</th>
            <th scope="col">Rate</th>
            <th scope="col">IMG URL</th>
            <th scope="col">Attribute</th>
        </tr>
        </thead>
        <tbody>
        @foreach($product->variant as $variant)
            <tr>
                <th scope="row">{{ $variant->id }}</th>
                <td>{{ $variant->price }}</td>
                <td>{{ $variant->rate }}</td>
                <td><a href="{{ $variant->image_url }}">{{ $variant->image_url }}</a></td>
                <td>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Key</th>
                            <th scope="col">Value</th>
                        </thead>
                        <tbody>
                            @foreach($variant->attribute as $attribute)
                                <tr>
                                    <th scope="row">{{ $attribute->id }}</th>
                                    <td>{{ $attribute->a_name }}</td>
                                    <td>{{ $attribute->a_value }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop
