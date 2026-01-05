                        @if (session('cart'))
                        
						<table class="cart-table">
							<thead class="cart-table-head">
								<tr class="table-head-row">
									<th class="product-remove"></th>
									<th class="product-image">  image</th>
									<th class="product-name">name </th>
									<th class="product-price">price</th>
									<th class="product-quantity">quantity</th>
									<th class="product-total">total </th>
                                    
								</tr>
							</thead>
							<tbody>
                                @php
                                    $total = 0 ;@endphp
                                    
                                    
                                    @foreach ( session('cart') as $key=> $details )
                                @php
                                $total =$total + ( $details['price'] * $details['quantity'] )
                                @endphp
                                    <tr class="table-body-row" data-id="{{ $key }}">
                                            <td class="product-remove">
                                                <button class="btn btn-danger remove-from-cart"><i class="fa fa-trash"></i></button>
                                            </td>
                                            <td class="product-image">
                                                <img src="{{ asset($details['imagepath']) }}" alt="">
                                            </td>
                                            <td class="product-name">{{ $details['name'] }}</td>
                                            <td class="product-price" >{{ $details['price'] }}$</td>
                                            <td ><input type="number" class="quantity" value="{{ $details['quantity'] }}" min="1"></td>
                                            <td >{{ $details['price'] * $details['quantity'] }}$</td>
                                            
                                        </tr>
                                        @endforeach
                                        
                                            <td >
                                                Total : {{ $total }}
                                            </td>
                                        
                                    
                                
                                
                                    
							</tbody>
    
						</table>
                        @endif