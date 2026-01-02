

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
                    <div class="card-header text-white" style="background-color: #051922;">
                        Profile
                    </div>
                    <div class="card-body">
                    <form action="{{ route('updateProfile') }}" method="post" enctype="multipart/form-data">
                        @csrf 
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" value="{{old('name',$user->name)}}" class="form-control @error('name') is-invalid @enderror" placeholder="Name" name="name" id="" />
                            @error('name')
                            <p class="invalid-feedback">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Email</label>
                            <input type="text" value="{{old('name',$user->email)}}" class="form-control  @error('email') is-invalid @enderror" placeholder="Email"  name="email" id="email"/>
                            @error('email')
                            <p class="invalid-feedback">{{$message}}</p>
                            @enderror
                        </div>
                        
                        <button class="btn btn-primary mt-2">Update</button>     
                    </form>                
                    </div>
                </div>                
            </div>
        </div>       
    </div>

</body>
