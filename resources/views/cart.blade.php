@extends('layouts.master')
@section('content')
<div class="cart-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-12">
                    <form action="{{ route('order') }}" method="post" >
                        @csrf
                    
					<div class="cart-table-wrap" id="cart-products">
                    @include('cartProducts')
					</div>
                    <div class="cart-buttons">
							<a href="{{  route('products')}}" class="boxed-btn">Continue Shopping</a>
							<button class="btn btn-success" style="border-radius: 20px; padding: 11px;">Check Out</button>
						</div>
                    
				</div>
			</div>
		</div>
	</div>


@endsection
@section('scripts')
<script type="text/javascript">
    $("body").on("change",".quantity",function(e){
        var elem = $(this);
        $.ajax({
            url: "{{ route('cart.update') }}",
            method:"POST",
            data:{
                _token: "{{ csrf_token() }}",
                type: "update",
                product_id: elem.parents("tr").attr("data-id"),
                quantity: elem.val()
            },
            success: function(response){
                $("#cart-products").html(response.success);
                console.log(response);
            }
        });
    });

</script>
<script type="text/javascript">
            $("body").on("click",".remove-from-cart",function(e){
                var elem = $(this);
                $.ajax({
                    url: "{{ route('cart.update') }}",
                    method:"POST",
                    data:{
                        _token:"{{ csrf_token() }}",
                        type:"delete",
                        product_id: elem.parents("tr").attr("data-id")

                    },
                    success: function(response){
                        $("#cart-products").html(response.success);
                        console.log(response);
                    }
                });
            });
</script>

@endsection
