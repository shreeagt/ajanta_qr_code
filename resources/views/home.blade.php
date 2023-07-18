
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/qrstyle.css')}}">  
    <link href="{{asset('css/video-js.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/index.css')}}" rel="stylesheet">
    <link href="{{asset('css/videoindex.css')}}" rel="stylesheet">
    <title>Qrcode</title>

    <style>
        @import  url('https://fonts.googleapis.com/css2?family=Questrial&display=swap');
        .main-container{
            background-image: url('https://edumedc.b-cdn.net/pm/brivex/background-image.png');
            background-size: cover;
            background-position: center center;
        }

        *{
            margin: 0;
            padding:0;
        }
        h4{
            font-family: 'Questrial', sans-serif;
            font-size: 20px;
            font-weight: 600;
        }
        #my-video{
            width: 800px;
            height: 450px;
        }
    </style>
</head>
    <style>
        @import  url('https://fonts.googleapis.com/css2?family=Questrial&display=swap');
        .main-container{
            /* background-image: url('https://edumedc.b-cdn.net/pm/brivex/background-image.png'); */
            background-image: url('/assets/images/qr_code_banner.jpg');
            background-size: cover;
            width:100vw;
            background-position: center center;
        }
        h4{
            font-family: 'Questrial', sans-serif;
            font-size: 20px;
            font-weight: 600;
        }

        .video-btn,
        .pdf-btn{
            max-width: 300px;
        }

        .profile-container{
            /* border: 1px solid #1d1d1b; */
            border:none;
            background: #ed3237;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            padding: 12px;
        }

        .profile-container img{
            border-radius: 50%;
            width: 100%;
            height: 100%;
            box-shadow: rgba(0, 0, 0, 0.15) 0px 5px 15px 0px;
        }

        .profile-details .profile-name{
            color: #1d1d1b;
            font-family: 'Questrial', sans-serif;
            font-size: 15px;
            font-weight: 700;
        }

        .profile-details .profile-designation {
            font-family: 'Questrial', sans-serif;
            font-size: 15px;
            color: #1d1d1b;
            font-weight: 500;
            margin-bottom: 5px;
        }

        img.logo-img.img-fluid {
            height: 100px;
        }
    </style>
    <div class=" main-container d-flex vh-100 justify-content-center align-items-center">
        <div class="row">
            <div class="col-12 col-md-10 mx-auto text-center">
                <div class="  mx-auto">
                    <img src="{{ asset('assets/images/instareel.png') }}" class="logo-img img-fluid" name="logo-img" /> 
                </div>
                <div class="profile-container  mx-auto">
                    <img src="{{ asset('logos/'.$doctor->logo) }}" class="doctor-img img-fluid" name="doctor-img" /> 
                </div>
                <div class="profile-details text-center mt-2">
                    <h4 class="profile-name">Dr. {{ $doctor->firstname }} </h4>

                    <p class="profile-designation">{{ $doctor->lastname }} </p>
                    <p class="profile-designation">{{ $doctor->contacno }} , {{ $doctor->city }} </p>
                    {{-- <p class="profile-designation">{{ $doctor->contacno }} , {{ $doctor->city }} </p> --}}
                </div>
                <h4 class="mt-2">Click below to view more information on:</h4>
                
                <div class="p-1">
                    <button class="btn video-btn">
                        <img src="{{ asset('assets/images/dos.png') }}" data-toggle="modal" data-target="#VideoLanguageModal" class="img-fluid" alt="">
                    </button>
                    <a href="https://edumedc.b-cdn.net/pm/brivex/PCS02722037_Brivex-Ajanta.pdf" class="btn pdf-btn" target="_blank">
                        <img src="{{ asset('assets/images/symtons.png') }}" class="img-fluid" alt="">
                    </a>
                </div>
                <h4 class="mt-2">From Makers of</h4>
                <img src="{{ asset('assets/images/instareel.png') }}" class="img-fluid mt-2" alt="" style="max-width:150px;">
            </div>
        </div>
    </div>
    <div class="modal fade languageModal" id="VideoLanguageModal" tabindex="-1" aria-labelledby="VideoLanguageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content border-0">
                <div class="modal-header">
                    <h5 class="modal-title">Choose Language Video</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <a href="" data-videoid="https://medupdates.s3.ap-south-1.amazonaws.com/Brivex-Smart-Rx-Standee-Personalisation-Ajanta/Assamese.mp4" class="d-block text-center btn btn-secondary rounded-pill showHideModal" data-toggle="modal" data-target="#videoModal">Assamese</a>
                    </div>
                    <div class="mb-2">
                        <a href="" data-videoid="https://medupdates.s3.ap-south-1.amazonaws.com/Brivex-Smart-Rx-Standee-Personalisation-Ajanta/Bengali.mp4" class="d-block text-center btn btn-secondary rounded-pill showHideModal" data-toggle="modal" data-target="#videoModal">Bengali</a>
                    </div>
                    <div class="mb-2">
                        <a href="" data-videoid="https://medupdates.s3.ap-south-1.amazonaws.com/Brivex-Smart-Rx-Standee-Personalisation-Ajanta/English.mp4" class="d-block text-center btn btn-secondary rounded-pill showHideModal" data-toggle="modal" data-target="#videoModal">English</a>
                    </div>
                    <div class="mb-2">
                        <a href="" data-videoid="https://medupdates.s3.ap-south-1.amazonaws.com/Brivex-Smart-Rx-Standee-Personalisation-Ajanta/Hindi.mp4" class="d-block text-center btn btn-secondary rounded-pill showHideModal" data-toggle="modal" data-target="#videoModal">Hindi</a>
                    </div>
                    <div class="mb-2">
                        <a href="" data-videoid="https://medupdates.s3.ap-south-1.amazonaws.com/Brivex-Smart-Rx-Standee-Personalisation-Ajanta/Gujarati.mp4" class="d-block text-center btn btn-secondary rounded-pill showHideModal" data-toggle="modal" data-target="#videoModal">Gujarati</a>
                    </div>
                    <div class="mb-2">
                        <a href="" data-videoid="https://medupdates.s3.ap-south-1.amazonaws.com/Brivex-Smart-Rx-Standee-Personalisation-Ajanta/Kannada.mp4" class="d-block text-center btn btn-secondary rounded-pill showHideModal" data-toggle="modal" data-target="#videoModal" data-filename="Kannada-demo.mp4">Kannada</a>
                    </div>
                    <div class="mb-2">
                        <a href="" data-videoid="https://medupdates.s3.ap-south-1.amazonaws.com/Brivex-Smart-Rx-Standee-Personalisation-Ajanta/Marathi.mp4" class="d-block text-center btn btn-secondary rounded-pill showHideModal" data-toggle="modal" data-target="#videoModal">Marathi</a>
                    </div>
                    <div class="mb-2">
                        <a href="" data-videoid="https://medupdates.s3.ap-south-1.amazonaws.com/Brivex-Smart-Rx-Standee-Personalisation-Ajanta/Malayalam.mp4" class="d-block text-center btn btn-secondary rounded-pill showHideModal" data-toggle="modal" data-target="#videoModal">Malayalam</a>
                    </div>
                    <div class="mb-2">
                        <a href="" data-videoid="https://medupdates.s3.ap-south-1.amazonaws.com/Brivex-Smart-Rx-Standee-Personalisation-Ajanta/Oriya.mp4" class="d-block text-center btn btn-secondary rounded-pill showHideModal" data-toggle="modal" data-target="#videoModal">Oriya</a>
                    </div>
                    <div class="mb-2">
                        <a href="" data-videoid="https://medupdates.s3.ap-south-1.amazonaws.com/Brivex-Smart-Rx-Standee-Personalisation-Ajanta/Punjabi.mp4" class="d-block text-center btn btn-secondary rounded-pill showHideModal" data-toggle="modal" data-target="#videoModal">Punjabi</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-body p-0">
                    <div class="text-center mb-2">
                        <button type="button" class="close float-none text-white" style="opacity: 1;" data-dismiss="modal" aria-label="Close">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"></path>
                            </svg>
                        </button>
                    </div>
                    <video id="my-video" class="video-js vjs-fluid vjs-theme-forest mx-auto" controls preload="auto" data-setup="{}">
                        <source src="" type="video/mp4" />
                    </video>
                    
                </div>
            </div>
        </div>
    </div>   
<body>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{asset('js/video.min.js')}}"></script>
<script>
$(document).ready(function(){
    jQuery(document).ready(function(){
        jQuery(".showHideModal").on( "click", function() {
            jQuery('.languageModal').modal('hide');
            videoId = jQuery(this).data("videoid");
            console.log(videoId);
            var videoTag = videojs('my-video_html5_api')
            videoTag.src([
                {type: "video/mp4", src: videoId},
            ])
        });

        jQuery('.modal').on('hidden.bs.modal', function () {
            jQuery('video').trigger('pause')
        })
    })
});
</script>

</body>

</html>
