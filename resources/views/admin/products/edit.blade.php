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

                {!! Form::open(['route' =>['admin.products.update',$product->id], 'method'=>'PUT', 'files'=> true ]) !!}

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
                        {!! Form::label('state_id', 'State', ['class' => 'control-label']); !!}
                        {!! Form::select('state_id', $states, $product->area->state_id, ['placeholder' => 'Pick an area ..', 'class' => 'form-control', 'id'=> 'state_id']); !!}
                    </div>

                    <div class="form-group {{ $errors->has('area_id') ? 'has-error' : false }}">
                        {!! Form::label('area_id', 'Area', ['class' => 'control-label']); !!}
                        {!! Form::select('area_id', $areas, $product->area_id, ['placeholder' => 'Pick an area ..', 'class' => 'form-control', 'id'=> 'area_id']); !!}
                    </div>
                    
                    <div class="form-group {{ $errors->has('brand_id') ? 'has-error' : false }}">
                        {!! Form::label('brand_id', 'Brand', ['class' => 'control-label']); !!}
                        {!! Form::select('brand_id', $brands, $product->brand_id, ['placeholder' => 'Pick a brand','class'=>'form-control']); !!}
                    </div>

                    <div class="form-group {{ $errors->has('category_id') ? 'has-error' : false }}">
                        {!! Form::label('category_id', 'Category', ['class' => 'control-label']); !!}
                        {!! Form::select('category_id', $categories, $product->subcategory->category_id, ['placeholder' => 'Pick a Category','class'=>'form-control', 'id' => 'category_id']); !!}
                    </div>

                    <div class="form-group {{ $errors->has('subcategory_id') ? 'has-error' : false }}">
                        {!! Form::label('subcategory_id', 'Subcategory', ['class' => 'control-label']); !!}
                        {!! Form::select('subcategory_id',$subcategories, $product->subcategory->category_id, ['placeholder' => 'Pick a Subcategory','class'=>'form-control' , 'id' => 'subcategory_id']); !!}
                    </div>

                    <!--

                    <div class="form-group {{ $errors->has('user_id') ? 'has-error' : false }}">
                        {!! Form::label('user_id', 'ID', ['class' => 'control-label']); !!}
                        {!! Form::text('user_id', '', ['class'=>'form-control']); !!}
                    </div>

                    -->

                    <div class="form-group">
                        {!! Form::label('product_image', 'Image', ['class' => 'control-label']); !!}
                        {!! Form::file('product_image', '', ['class'=>'form-control']); !!}
                    
                    </div>

                     <div class="form-group">

                    @if(!empty($product->product_image))
                    <img src="{{ asset('storage/uploads/'.$product->product_image) }}" class="img-responsive">
                    @endif
                    </div>

                    <div class="form-group pull-left">
                        <button type="submit" name="submit" class="btn btn-success">Submit</button>
                        <button class="btn btn-danger"><a href="{{ route('admin.products.index') }}" >Cancel</a></button>
                    </div>                          
    
                {!! Form::close() !!}
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript">
        $( document ).ready(function() {
            //console.log( "Sekarang berada di form create product!" );

            //dapatkan previous version selected state-id bila  validation error 
             var selected_state_id = '{{ old('state_id') }}';
             console.log(selected_state_id);

             //kalau ada selecteed state id kita paggil balik function ajax dapatkan area 

             if (selected_state_id.length>0){
                getStateAreas(selected_state_id);


             };

             function getStateAreas(state_id){

                var ajax_url = '/products/areas/' + state_id;
                $.get( ajax_url, function( data ) {
                    //console log nk check dy return gapo
                  //console.log(data);

                  $('#area_id').empty().append('<option value="">Select Area</option>');
                  $.each(data, function(area_id,area_name){

                    //console.log(area_id)

                    $('#area_id').append('<option value='+area_id+'>'+area_name+'</option');



                  });

                  var selected_area_id = '{{ old('area_id') }}';

                  if(selected_area_id.length>0){

                    $('#area_id').val(selected_area_id);
                }
                });
             }






             var selected_category_id = '{{ old ('category_id')}}';
             console.log (selected_category_id);


             if (selected_category_id.length>0){
                getCategorySubCategory(selected_category_id);
             }

             

             function getCategorySubCategory(category_id){

                  var ajax_url = '/products/subcategories/' + category_id;
                  $.get( ajax_url, function( data ) {
                    //console log nk check dy return gapo
                  //console.log(data);

                  $('#subcategory_id').empty().append('<option value="">Select Subcategory</option>');
                  $.each(data, function(subcategory_id,subcategory_name){

                    //console.log(area_id)

                    $('#subcategory_id').append('<option value='+subcategory_id+'>'+subcategory_name+'</option');



                  });

                   var selected_subcategory_id = '{{ old('subcategory_id') }}';

                  if(selected_subcategory_id.length>0){

                    $('#subcategory_id').val(selected_subcategory_id);
                }

                });




             }

          

            
       });
    </script>
@endsection
