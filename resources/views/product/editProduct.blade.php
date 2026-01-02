@extends('layouts.master')

@section('content')
	<div class="product-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-title">	
						<h3><span class="orange-text"></span>  تعديل المنتج</h3>
					</div>
				</div>
			</div>
			
			<div class="row" >
                <div class="col-lg-12 mb-5 mb-lg-0">
				    <div id="form_status"></div>
					    <div class="contact-form">

		
                            <form method="post" enctype="multipart/form-data" action="{{ route('storeProduct') }}" id="fruitkha-contact" onsubmit="return valid_datas( this );">
                                @csrf()
								<p>
								<input type="hidden" style="width: 100% " placeholder="الاسم" name="id" id="id" value="{{$product-> id }}">

                                    <input type="text" style="width: 100% " required placeholder="الاسم" name="name" id="name" value="{{$product-> name }}">
												<span class="text-danger">
												@error('name')
												{{ $message }}
												@enderror
												</span>
                                </p>
                                <p style="display: flex">
                                    <input type="number" style="width: 50%" required class="mr-4" placeholder="السعر" name="price" id="price"value="{{ $product -> price}}">
												<span class="text-danger">
												@error('price')
												{{ $message }}
												@enderror
												</span>
                                    <input type="number" style="width: 50%" required  placeholder="الكمية" name="quantity" id="quantity"value="{{ $product -> quantity}}">
									
												<span class="text-danger">
												@error('quantity')
												{{ $message }}
												@enderror
												</span>
                                </p>
                                <p><textarea name="description" required id="description" cols="30" rows="10" placeholder="description" >
									{{ $product -> description }}
								</textarea>
										<span class="text-danger">
											@error('description')
											{{ $message }}
											@enderror
										</span>
								</p>
								<p>
								<select class="form-control" name="category_id" id="category_id">
									@foreach ($allCategories as $item )

									@if ($item -> id == $product -> category_id)
										<option value="{{ $item -> id }}" selected>{{ $item ->name }}</option>
									
									@else
										<option value="{{ $item -> id }}" >{{ $item ->name }}</option>

									@endif
									@endforeach
								</select>
										<span class="text-danger">
											@error('category_id')
											{{ $message }}
											@enderror
										</span>
								</p>
								    <p>
									<input type="file" class="form-control" name="photo" id="photo" >
									<span class="text-danger">
											@error('photo')
											{{ $message }}
											@enderror
										</span>
								</p>
								<img src="{{ asset($product->imagepath) }}" width="250" height="250">
                                <p><input type="submit" value="تعديل"></p>
                            </form>


					    </div>
				    </div>
			    </div>
		    </div>
	</div>



@endsection
