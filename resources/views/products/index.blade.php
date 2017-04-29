@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">





        <div class="panel panel-primary">
            <div class="panel-heading">Search Product</div>

            <div class="panel-body">

                <form>

                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                               
                                        {!! Form::label('search_state', 'State', ['class' => 'control-label']); !!}
                                        {!! Form::select('search_state', $states, null, ['placeholder' => 'Pick a states','class'=>'form-control']); !!}
                            </div>

                        </div>

                        <div class="col-md-3">

                            <div class="form-group">
                        
                                    {!! Form::label('search_category', 'Category', ['class' => 'control-label']); !!}
                                    {!! Form::select('search_category', $categories, null, ['placeholder' => 'Pick a category','class'=>'form-control']); !!}
                            
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                           
                                    {!! Form::label('brand_id', 'Brand', ['class' => 'control-label']); !!}
                                    {!! Form::select('brand_id', $brands, null, ['placeholder' => 'Pick a brand','class'=>'form-control']); !!}
                            </div>
                               
                        </div>
                        

                        <div class="col-md-2">
                            <div class="form-group">
                        
                                     {!! Form::label('search_anything', 'By Product Name/Desc', ['class' => 'control-label']); !!}
                                    {!! Form::text('search_anything', Request::get('search_anything'), ['class'=>'form-control']); !!}
                            
                            </div>
                        </div>

                        <div class="col-md-1">

                            <div class="form-group" style="padding-top: 27px;">
                                <button type="submit" class="btn btn-success"> Search </button>

                            </div>
                        </div>
                    </div>
                </form>

            </div>

            </div>





            </form>


            </div>


        </div>
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
                    <th> Action </th>
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
                                <td>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-mini">Edit</a>
                                </td>
                            </tr>

                        @endforeach
                      
                    </tbody>
                    </table>

                    {{ $products->appends(Request::except('page'))->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
                          