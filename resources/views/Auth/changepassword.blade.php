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
                    <div class="card-header  text-white" style="background-color: #051922;">
                        Change Password  
                    </div>
                    <div class="card-body pb-3">   
                    <form action="{{route('authPass')}}" method="post" >
                        @csrf 
                        <div class="mb-3">
                            <label for="name" class="form-label">Old Password</label>
                            <input type="text" class="form-control" name="oldPass" id="oldPass">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">New password</label>
                            <input type="text" class="form-control" name="newPass" id="newPass">
                        </div> 
                        <div class="mb-3">
                            <label for="name" class="form-label">Confirm New Password</label>
                            <input type="text" class="form-control" name="confirmPass" id="confirmPass">
                        </div> 
                        <button class="btn btn-primary mt-2">Save</button>     
                    </form>    

                    </div>
                    
                </div>                
            </div>
        </div>       
    </div>


</body>

