@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Product</div>

                <div class="panel-body">

                <!-- Papar validation error -->
                @if(count ($errors)>0)
                <div class="alert alert-danger" role="alert">
                <p>Validation Error. Please fix this error below :</p>
                <ul>
                @foreach ($errors->all() as $message)
                    <li>{{ $message}} </li>
                @endforeach
                </ul>

                </div>
                @endif

                {!! Form::open([]) !!}

                     <div class="form-group {{ $errors->has('product_name') ? 'has-error' : false }}">
                        {!! Form::label('product_name', 'Product Name', ['class' => 'control-label']); !!}
                        {!! Form::text('product_name', $product->product_name, ['class'=>'form-control']); !!}
                    </div>
                    
                    <div class="form-group {{ $errors->has('product_desc') ? 'has-error' : false }}">
                        {!! Form::label('product_desc', 'Description', ['class' => 'control-label']); !!}
                        {!! Form::text('product_desc', $product->product_discription, ['class'=>'form-control']); !!}
                    </div>

                    

                    <div class="form-group {{ $errors->has('price') ? 'has-error' : false }}">
                        {!! Form::label('price', 'Price', ['class' => 'control-label']); !!}
                        {!! Form::text('price', $product->product_price, ['class'=>'form-control']); !!}
                        
                    </div>

                    <div class="form-group {{ $errors->has('condition') ? 'has-error' : false }}">
                        {!! Form::label('condition', 'Condition', ['class' => 'control-label']); !!}
                        {!! Form::radio('condition', 'new', false); !!}New
                        {!! Form::radio('condition', 'used', false); !!}Used
                    </div>

                    <div class="form-group {{ $errors->has('state_id') ? 'has-error' : false }}">
                        {!! Form::label('state_name', 'State')!!}
                        {!! Form::text('state_name', $product->area->state->state_name, ['class'=>'form-control']); !!}
                    </div>

                    <div class="form-group {{ $errors->has('area_id') ? 'has-error' : false }}">
                        {!! Form::label('area_id', 'Area', ['class' => 'control-label']); !!}
                        {!! Form::text('area_id', $product->area->area_name, ['class'=>'form-control']); !!} 
                    </div>
                    
                    

                    <div class="form-group {{ $errors->has('category_id') ? 'has-error' : false }}">
                        {!! Form::label('category_id', 'Category') !!}
                        {!! Form::text('category_name', $product->subcategory->category->category_name, ['class'=>'form-control']); !!}
                    </div>

                    <div class="form-group {{ $errors->has('subcategory_id') ? 'has-error' : false }}">
                        {!! Form::label('subcategory_id', 'Subcategory', ['class' => 'control-label']); !!}
                        {!! Form::text('subcategory_id', $product->subcategory->subcategory_name, ['class'=>'form-control']); !!}
                    </div>

                  

                   

                     <div class="form-group">

                    @if(!empty($product->product_image))
                    <img src="{{ asset('storage/uploads/'.$product->product_image) }}" class="img-responsive">
                    @endif
                    </div>

                    <div class="form-group pull-left">
                        <button type="submit" name="submit" class="btn btn-success">Submit</button>
                        <button class="btn btn-danger"><a href="{{ route('products.index') }}" >Cancel</a></button>
                    </div>                          
    
                {!! Form::close() !!}
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


