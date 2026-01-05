@extends('layouts.master')

@section('content')


<div class="product-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-title">	
						<h3><span class="orange-text">منتجات </span> القسم</h3>
					</div>
				</div>
			</div>

			<div class="row">

                @foreach ( $products as $item )
                
                
				<div class="col-lg-4 col-md-6 text-center">
					<div class="single-product-item">
						<div class="product-image">
							<a href="single-product.html">
                                <img style="max-height: 250px ; min-height: 255px;"  src="{{url($item-> imagepath)}}" alt=""></a>
						</div>
						<h3>{{$item-> name}}</h3>
						<p class="product-price"><span>quantity<br>{{$item-> quantity}}</span>   {{$item-> price}}$</p>
						<a href="{{ route('cart.add', $item->id) }}" class="btn btn-primary">اضف الي السلة</a>

					</div>
				</div>
                @endforeach

				
			</div>
		</div>
	</div>
@endsection

