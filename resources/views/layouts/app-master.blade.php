<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
<meta name="generator" content="Hugo 0.87.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- CSRF Token -->
@stack('title')
<!-- css file -->
<link rel="stylesheet" href="{{asset('theme/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('theme/css/style.css')}}">
<link rel="stylesheet" href="{{asset('theme/css/dashbord_navitaion.css')}}">
<!-- Responsive stylesheet -->
<link rel="stylesheet" href="{{asset('theme/css/responsive.css')}}">
<link rel='stylesheet' href='https://foliotek.github.io/Croppie/croppie.css'>
<!-- Favicon -->
<link href="images/favicon.ico" sizes="128x128" rel="shortcut icon" type="image/x-icon" />
<link href="images/favicon.ico" sizes="128x128" rel="shortcut icon" />

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
<script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
</head>
<body>

  <div class="wrapper">
	<div class="preloader"></div>
  <header class="dashboard_header">
    <div class="header__container pt20 pb20 pl30 pr30">
      <div class="row justify-between items-center">
        <div class="col-sm-4 col-xl-2">
          <div class="text-center text-lg-start d-flex align-items-center mb15-520">
            <div class="fz20 me-4">
              <a href="#" class="dashboard_sidebar_toggle_icon text-thm1 vam"><i class="fa-sharp fa-solid fa-bars-staggered"></i></a>
            </div>
            <div class="dashboard_header_logo">
              <a href="/" class="logo">
                <img src="{{ asset('assets/images/instareel.png') }}" class="logo-img img-fluid" name="logo-img" width="100" /> 
              </a>
            </div>
          </div>
        </div>
        @auth
        <div class="col-sm-8 col-xl-10 d-none d-md-block">
          <div class="text-center text-lg-end header_right_widgets">
            <ul class="mb0 d-flex justify-content-center justify-content-sm-end">
              <li class=""><a class="text-center"  style="text-align: right;" href="/logout"> Logout <span class="flaticon-exit"></span></a></li>
            </ul>
          </div>
        </div>
        @endauth
        <div class="col-sm-3 col-xl-3 d-none d-md-block">
          <!-- <div class="header_search_widget mb15-520">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search" aria-label="Recipient's username">
              <div class="input-group-append">
                <button class="btn" type="button"><span class="fa fa-search"></span></button>
              </div>
            </div>
          </div> -->
        </div>
        <style>
        .top-right {
        position: absolute;
        top: 0;
        right: 0;
        }
        </style>

        @guest
          <div class="text-end">
            <a href="/login" class="btn btn-primary">Login</a>
            {{-- <a href="/login" class="btn btn-warning">Sign-up</a> --}}
          </div>
        @endguest
        
      </div>
    </div>
  </header>
    @include('layouts.partials.navbar')
    <div class="dashboard__main pl0-md">
          @yield('content')
  </div>


   
    
    @section("scripts")

    @show
    <a class="scrollToHome" href="#"><i class="fas fa-angle-up"></i></a>
</div>
<!-- Wrapper End -->
<script src="{{asset('theme/js/jquery-3.6.0.js')}}"></script>
<script src="{{asset('theme/js/jquery-migrate-3.0.0.min.js')}}"></script>
<script src='https://foliotek.github.io/Croppie/croppie.js'></script>
<script src="{{asset('theme/js/popper.min.js')}}"></script>
<script src="{{asset('theme/js/bootstrap.min.js')}}"></script> 
<script src="{{asset('theme/js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('theme/js/chart.min.js')}}"></script>
<script src="{{asset('theme/js/chart-custome.js')}}"></script>
<script src="{{asset('theme/js/jquery.mmenu.all.js')}}"></script>
<script src="{{asset('theme/js/ace-responsive-menu.js')}}"></script>
<script src="{{asset('theme/js/snackbar.min.js')}}"></script>
<script src="{{asset('theme/js/simplebar.js')}}"></script>
<script src="{{asset('theme/js/parallax.js')}}"></script>
<script src="{{asset('theme/js/scrollto.js')}}"></script>
<script src="{{asset('theme/js/jquery-scrolltofixed-min.js')}}"></script>
<script src="{{asset('theme/js/jquery.counterup.js')}}"></script>
<script src="{{asset('theme/js/wow.min.js')}}"></script>
<script src="{{asset('theme/js/progressbar.js')}}"></script>
<script src="{{asset('theme/js/slider.js')}}"></script>
<script src="{{asset('theme/js/timepicker.js')}}"></script>
<script src="{{asset('theme/js/dashboard-script.js')}}"></script>
<!-- Custom script for all pages --> 
<script src="{{asset('theme/js/script.js')}}"></script>
<script>
  
    document.addEventListener("DOMContentLoaded", function() {
      // Pie chart
      new Chart(document.getElementById("chartjs-dashboard-pie"), {
        type: "pie",
        data: {
          labels: ["Direct", "Affiliate", "E-mail", "Other"],
          datasets: [{
            data: [2602, 1253, 541, 1465],
            backgroundColor: [
              window.theme.primary,
              window.theme.warning,
              window.theme.danger,
              "#E8EAED"
            ],
            borderWidth: 5,
            borderColor: window.theme.white
          }]
        },
        options: {
          responsive: !window.MSInputMethodContext,
          maintainAspectRatio: false,
          cutoutPercentage: 70,
          legend: {
            display: false
          }
        }
      });
    });
</script>


<script>
  // Start upload preview image
$(".gambar").attr("src", "https://user.gadjian.com/static/images/personnel_boy.png");
          var $uploadCrop,
          tempFilename,
          rawImg,
          imageId;
          function readFile(input) {
             if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                $('.upload-demo').addClass('ready');
                $('#cropImagePop').modal('show');
                      rawImg = e.target.result;
                    }
                    reader.readAsDataURL(input.files[0]);
                }
                else {
                  swal("Sorry - you're browser doesn't support the FileReader API");
              }
          }

          $uploadCrop = $('#upload-demo').croppie({
            viewport: {
              width: 150,
              height: 200,
              type: 'rectangle'
            },
            enforceBoundary: false,
            enableExif: true
          });
          $('#cropImagePop').on('shown.bs.modal', function(){
            // alert('Shown pop');
            $uploadCrop.croppie('bind', {
                  url: rawImg
                }).then(function(){
                  console.log('jQuery bind complete');
                });
          });

          $('.item-img').on('change', function () { imageId = $(this).data('id'); tempFilename = $(this).val();
                                                   $('#cancelCropBtn').data('id', imageId); readFile(this); });
          $('#cropImageBtn').on('click', function (ev) {
            $uploadCrop.croppie('result', {
              type: 'base64',
              format: 'png',
              shape: 'rectangle',
              size: {width: 300, height: 300}
            }).then(function (resp) {
              $('#item-img-output').attr('src', resp);
              $('#photo-cropped').attr('value', resp);
              $('#cropImagePop').modal('hide');
            });
          });
      // End upload preview image
</script>

</body>
</html>