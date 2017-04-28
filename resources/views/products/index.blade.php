@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Manage Product</div>

               
                

                <div class="panel-body">
                 <a href="{{route ('products.create')}}" class="btn btn-success pull-right">Create Product

                </a>
                    <table class="table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                    <th> Product Name</th>
                    <th> Product Description</th>

                    <th> Price</th>
                    <th> Condition</th>
                    <th> Location</th>
                    <th> Subcategory </th>
                    <th> Brand </th>
                    <th> Seller </th>
                    </tr>
                    </thead>
                    <tbody>
                  @foreach ($products as $product)

                            <tr>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->product_discription }}</td>
                                <td>{{ $product->product_price }}</td>
                                <td>{{ $product->condition }}</td>
                                <td>
                                    {{ $product->area->area_name }}, {{ $product->area->state->state_name }}
                                </td>
                                <td>{{ $product->subcategory->subcategory_name or '' }}</td>
                                <td>{{ $product->brand->brand_name }}</td>
                                <td>{{ $product->user->name }}</td>
                            </tr>

                        @endforeach
                      
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
                          