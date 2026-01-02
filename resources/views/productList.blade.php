<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

	<!-- title -->
	<title>Shop Project</title>

	<!-- favicon -->
	<link rel="shortcut icon" type="image/png" href="{{asset('assets/img/favicon.png')}}">
	<!-- google font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
	<!-- fontawesome -->
	<link rel="stylesheet" href="{{asset('assets/css/all.min.css')}}">
	<!-- bootstrap -->
	<link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
	<!-- owl carousel -->
	<link rel="stylesheet" href="{{asset('assets/css/owl.carousel.css')}}">
	<!-- magnific popup -->
	<link rel="stylesheet" href="{{asset('assets/css/magnific-popup.css')}}">
	<!-- animate css -->
	<link rel="stylesheet" href="{{asset('assets/css/animate.css')}}">
	<!-- mean menu css -->
	<link rel="stylesheet" href="{{asset('assets/css/meanmenu.min.css')}}">
	<!-- main style -->
	<link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
	<!-- responsive -->
	<link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}">

</head>
<body>
    
	

        <div class="container">
                <div class="row my-5">
                        <div class="col-md-3">
                            @include('layouts.sidebar')
                        </div>
                    <div class="col-md-9">
                        @include('layouts.message')
                        <div class="card border-0 shadow">
                            <div class="card-header  text-white" style="background-color:#051922; ">
                                Products
                            </div>
                            <div class="card-body pb-0">   
                                    <div class="d-flex justify-content-end">                    
                                        {{-- <form action="" method="get">
                                            <div class="d-flex">
                                                <input type="text" class="form-control" value="{{Request::get('search')}}"  name="search" placeholder="search">
                                                <button type="submit" class="btn btn-primary ms-2">Search</button>
                                                <a href="{{route('account.reviews')}}" class="btn btn-secondary ms-2"> Clear</a>
                                            </div>
                                        </form> --}}
                                    </div>
                                <table class="table  table-striped mt-3">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Category</th>
                                            <th>product</th>
                                            <th>price</th>
                                            <th>Quantity</th>  
                                            <th width="150">Action</th>

                                            
                                            
                                            
                                        </tr>
                                        
                                            <tbody>
                                                    @foreach($products as $product)
                                                        <tr>
                                                            <td>{{ $product->category->name }}</td>
                                                            <td>{{ $product->name }}</td>
                                                            <td>{{ $product->price }}</td>
                                                            <td>{{ $product->quantity }}</td>
                                                            <td>
                                                                <a href="{{ route('editProduct',['id'=>$product->id]) }}" class="btn btn-primary">                                                               
                                                                <a href="#" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                            </tbody>
                                    </thead>
                                </table>  
                                    <div class="d-flex justify-content-center">
                                        {{ $products->links('pagination::bootstrap-5') }}
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
</body>

