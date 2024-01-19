@extends('products.layout')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h2 class="text-center">Product Management</h2>
        </div>
        <div class="col-lg-12 text-center" style="margin-top: 10px; margin-bottom: 10px">
            <a href="{{ route('products.create') }}" class="btn btn-success">
                Add product
            </a>
        </div>
    </div>

    @if($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    @if(sizeof($products) > 0)
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Product Name</th>
                <th>Product Description</th>
                <th>Qty</th>
                <th width="280px">More</th>
            </tr>
            @foreach ($products as $product)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{  }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @endforeach
        </table>
    @endif
