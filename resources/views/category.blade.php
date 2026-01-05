@extends('layouts.master')

@section('content')

	<div class="product-section mt-150 mb-150">
		<div class="container">
			
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-title">	
						<h3>المنتجات  </h3>
					</div>
				</div>
			</div>
			@include('layouts.message')
			<div class="row product-lists">
				
                @foreach ($products as $item )
                
				<div class="col-lg-4 col-md-6 text-center ">
					<div class="single-product-item">
						<div class="product-image">
							<a href="single-product.html"><img src="{{asset($item -> imagepath)}}" style="max-height: 250px;min-height:250px" alt=""></a>
						</div>
						<h3>{{$item-> name}}</h3>
						<p class="product-price"><span>quantity<br>{{$item-> quantity}}</span> {{$item-> price}}</p>
						<a href="{{ route('cart.add', $item->id) }}" class="btn btn-primary">اضف الي السلة</a>

						@auth
						@if(auth()->user()->isAdmin())
						<p class="mt-3">
							<a href="{{ route('deleteProduct',['id'=>$item->id] )}}" class="btn btn-danger">
								<i class="fas fa-trash"></i> 
									حذف المنتج</a>

							<a href="{{ route('editProduct',['id'=>$item->id]) }}" class="btn btn-primary">
								<i class="fas"></i> تعديل </a>
						</p>
						@endif 
						@endauth
					</div>
				</div>
                @endforeach
				</div>
					<div style="text-align: center">
						{{ $products->links() }}
					</div>
					
			</div>
		</div>
	</div>
</div>
@endsection
<style>

	svg{
		height: 50px !important;
	}
</style>