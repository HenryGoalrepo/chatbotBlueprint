@extends('backend.admin.layouts.app')

@section('styles')
    <!-- Custom styles for this page -->
    <link href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.green.min.css" integrity="sha512-C8Movfk6DU/H5PzarG0+Dv9MA9IZzvmQpO/3cIlGIflmtY3vIud07myMu4M/NTPJl8jmZtt/4mC9bAioMZBBdA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     <link rel="stylesheet" type="text/css" href="{{asset('front/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('front/css/slick.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('front/css/slick-theme.css')}}">
    <style>
     .chat-bot-icon{
        position: relative;
        width: 100%;
    }
    .chat-bot-icon img{
        position: fixed;
        width: 150px;
        bottom: 24px;
        right: 24px;
        z-index:9999;
        cursor:pointer;
    }
    .bot-logo {
        width: 100%;
        max-width: 50PX;
        padding: 8px;
    }
    .gif_img img {
        max-width: 78px;
        height: 32px;
        border-top-right-radius: 15px;
        border-bottom-left-radius: 15px;
        border-bottom-right-radius: 15px;
    }
    .chat-bot-box .list-unstyled li a {
    color: white ;
    line-height: inherit;
}
.chat-bot-box .form-control{
    height:42px;
}
    .chat-bot-box {
        position: fixed;
        max-width: 450px;
        width:100%;
        height: 625px;
        right: 24px;
        bottom: 24px;
        box-shadow: 1px 1px 10px #dedede;
        z-index: 9999999;
        background-color: #fff;
        border-radius: 5px;
    }
    .chat-bot-box img{
        width: 100%;
    }
    .chat-bot-box .chat-box-header{
        width: 100%;
        height: 50px;
        background-color: #000000;
        border-top-right-radius: 5px;
        border-top-left-radius: 5px;
        color: #fff;
    }
    .feedback-btn {
    border: 1px solid #ffdf01;
    padding: 4px 8px;
    border-radius: 20px;
    color: #ffdf01;
    font-size: 14px;
    text-align: center;
}
.bot-box{
    position: relative;
    height: 100%;
}
.bot-box .chat-box-header {
    position: absolute;
    width: 100%;
    top: 0;
    left: 0;
}
.bot-box .chat-box-footer {
    position: absolute;
    width: 100%;
    bottom: 0;
    left: 0;
}
.chat-box-header i{
    color: #ffdf01;
}
.Input_field{
    border-radius: 20px;
}
.chat-box-footer .message-input{
    position: relative;
    padding: 12px;
}
.chat-box-footer .Input_button-send {
    position: absolute;
    right: 8%;
    bottom: 50%;
    transform: translate(50%,50%);
    width: 50px;
    border: none;
    border-top-right-radius: 20px;
    border-bottom-right-radius: 20px;
    background-color: transparent;
    display: flex;
}
.Input_field{
    padding: 24px 16px ;
}
.chat-box-footer .copyright-content{
    text-align: center;
    font-size: 11px;
}
.chat-box-footer .copyright-content a{
    color:#000000
}
.chat-box-footer .copyright-content p{
   margin-bottom: 4px;
}
.bot-box .chat-box-body{
    position: relative;
}
.box-body {
    position: absolute;
    top: 60px;
    left: 0;
    width: 100%;
    height: 450px;
    overflow-y: scroll;
    overflow-x: hidden;
    padding: 0 0 0 14px;
}
.normalp{
    padding: 3px 15px;
    border-top-right-radius: 15px;
    border-bottom-left-radius: 15px;
    border-bottom-right-radius: 15px;
    margin-left: 5px;
    background: #f5f4f4;
    color: black !important;
    font-size: 15px !important;
    animation: none !important;
    line-height: 1.7;
    float: left;
    width: 100%;
}
.replyp{
    margin-top:10px;
    padding: 3px 15px;
    border-top-right-radius: 15px;
    border-top-left-radius: 15px;
    border-bottom-left-radius: 15px;
    margin-left: 5px;
    background: #ffdf01;
    color: black !important;
    font-size: 15px !important;
    animation: none !important;
    line-height: 1.7;
    float: right;
}

.box-body::-webkit-scrollbar{
    width:5px;
}
.box-body::-webkit-scrollbar-track{
    background-color:white;
}
.box-body::-webkit-scrollbar-thumb{
   background-color: #ffdf01;
}
/*.chat-box-body .box-body ul li:nth-child(even) .row{*/
/*    display: flex;*/
/*    justify-content: end;*/
/*    width: 100%;*/
/*}*/
.human{
     display: flex;
    justify-content: end;
    width: 100%;
}
.btn-track {
    border: 1px solid #ffdf01;
    /*width: 46%;*/
    /*height: 52px;*/
    border-radius: 20px;
    font-size: 14px;
    text-align: center;
    margin: 5px;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 4px 15px;
}
.btn-track:hover{
    font-size: 14px;
    font-weight: 650;
    background-color: #ffdf01;
}
.btn-city {
      border: 1px solid #ffdf01;
    /*width: 46%;*/
    /*height: 52px;*/
    border-radius: 20px;
    font-size: 14px;
    text-align: center;
    margin: 5px;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 4px 15px;
}
.btn-city:hover{
    font-size: 14px;
    font-weight: 650;
    background-color: #ffdf01;
}
.city-list {
    box-shadow: 0px 0px 3px #000000;
    
}
.city-list li {
    background: #ffffff;
    border-bottom: 2px solid #000000;
    align-items: center;
    padding: 8px 16px;
}
.city-list li p{
    margin-top: inherit ;
    margin-bottom: inherit;
}
.city-list .select-btn.btn{
    border-radius: 0;
}
.bot-slider .carousel-indicators{
    display: none;
}
.bot-slider .card-body h2{
    font-size: 19px;
    margin-top: 4px;
    font-weight: 400;
    color: #f1c232;
}
.bot-slider .card-body p{
    font-size: 14px;
}
.bot-slider .card-body p{
    margin: 0;
}
.bot-slider .card-body {
    padding: 0.5rem 1rem;
}
.bot-slider .carousel-control-next-icon, .bot-slider .carousel-control-prev-icon {
    width: 25px;
    height: 25px;
    background-color: #f1c232;
}
 .chat-bot-box .btn-info {
    color: #000;
    background-color: #d3d0d0;
    border-color:#b9b9b9;
    border-radius:5px;
}
    .chat-bot-box .btn-info:hover {
    color: #212529;
    background-color: #30e3ca;
    border-color: #30e3ca;}
.bot-slider .btn {
  padding: .3rem .65rem;  
}
.bot-slider .carousel-control-prev {
    left: -40px;
}
.bot-slider .carousel-control-next{
    right: -40px;
}
.bot-slider .select-btn {
    background-color: #f1c232;
}
.chat-box-body .inner-message-box {
    position: absolute;
    width: 90%;
    height: 470px;
    display: none;
    background-color: #ffffff;
    left: 50%;
    transform: translate(-52%, 13%);
    z-index: 9;
    box-shadow: 0px 0px 2px 1px #b9b9b9;
}
.chat-box-body .inner-chat-box {
    position: absolute;
    width: 99%;
    height: 470px;
    display: none;
    background-color: #ffffff;
    left: 52%;
    transform: translate(-52%, 13%);
    z-index: 9;
    box-shadow: 0px 0px 2px 1px #b9b9b9;
    overflow-y:scroll;
}
.chat-box-body .inner-chat-box::-webkit-scrollbar {
    width: 5px;
    height:0px;
}
.chat-box-body .inner-chat-box::-webkit-scrollbar-track {
    background-color:white;
}
.chat-box-body .inner-chat-box::-webkit-scrollbar-thumb{
   box-shadow: inset 0 0 6px #ffdf01;
}
.chat-box-body .inner-box {
    position: absolute;
    width: 90%;
    height: 470px;
    display: none;
    background-color: #ffffff;
    left: 50%;
    transform: translate(-52%, 13%);
    z-index: 9;
    box-shadow: 0px 0px 2px 1px #b9b9b9;
}
.message-box{ 
     position: relative;
         display: flex;
    justify-content: space-between;
}
.close-btn.close-modal{
    /*position: fixed;*/
    /*top: 4px;*/
    /*left:4px;*/
    height:40px;
    width:15%;
}
.textarea{
    height:230px !important;
    text-align:center;
}
.message-text{
    /*float: right;*/
     width:85%;
    font-size: 16px;
    font-weight: 650;
    padding:0 8px;
    margin-top: 8px;
}
.chat-bot-box{
    display: none;
}
@media screen and (max-width:767px){
    .chat-bot-icon img {
    width: 100px;
    }
    
}
@media screen and (max-width:498px){
    
    .chat-bot-box {
    position: fixed;
    max-width: 100%;
    width: 95%;
    height: 625px;
     right: inherit; 
    bottom: 24px;
    }
    
    .chatbot-main{
        padding:14px;
    }
    .feedback-btn{
        font-size:8px;
    }
    .chat-bot-box .list-unstyled li a {
    
    font-size: 13px;
}
.bot-slider .btn {
    padding: 0.1rem 0.2rem;
}
.bot-slider .card-body h2 {
    font-size: 15px;
 
}
.bot-slider .card-body p {
    font-size: 14px;
    line-height: 21px;
}
.btn-city {
    
       border: 1px solid #ffdf01;
    font-size: 14px;
    margin: 5px;
    padding: 6px 10px;
   
}
.btn-track {
    border: 1px solid #ffdf01;
    font-size: 14px;
    margin: 5px;
    padding: 4px 10px;
}
}

/*card csss start */

.bussiness-card{
    box-shadow:0px 0px 4px 1px #a7a7a7;
    padding:8px 8px;
    overflow:hidden;
    position:Relative;
    width: 100%;
    max-width: 410px;
    margin: auto 0px;
} 
.bussiness-card .bussiness-card-main{
    background-color:#000000;
    border-radius:4px;
    padding:8px;
}
.bussiness-card .bussiness-card-main .bussiness-card-name h3{
    color:#daa520;
    font-size:20px;
    text-transform:uppercase;
}
.bussiness-card .bussiness-card-main .bussiness-card-name p{
    color: #ffffff;
    font-size: 13px;
    margin-top: -10px;
    position:relative;
}
.bussiness-card .bussiness-card-main .bussiness-card-name p:after{
    position:absolute;
    content:"";
    width:35px;
    height:3px;
    background-color:#daa520;
    bottom:-2px;
    left:0;
}
.bussiness-card-info{
    margin-top:-4px;
}
.bussiness-card .bussiness-card-main .bussiness-card-info .col-md-8 span {
    font-size: 12px;
    display: block;
    color: #ffffff;
    margin: -2px 0 -2px -9px;
}
.bussiness-card .bussiness-card-main .bussiness-card-info span i{
 color: #ffffff;
    background-color: #daa520;
    font-size: 14px;
    width: 28px;
    height:28px;
    border-radius: 50%;
    text-align: center;
    align-items: center;
    display: flex;
    justify-content: center;
}
.bussiness-card-social-icons ul{
    display:flex;
    list-style-type:none;
}
.bussiness-card .bussiness-card-social-icons li a {
     background-color: #daa520;
    border-radius: 50%;
    height: 24px;
    width: 24px;
    margin-right:10px;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 11px;
}
.bussiness-back-circle {
    position: absolute;
    width: 300px;
    height: 232px;
    background-color: #ffffff;
    border-top-left-radius: 150px;
    border-bottom-left-radius: 150px;
    top: 3px;
    border-radius: 50%;
    left: 67%;
    padding:4px;
}
.bussiness-back-circle .circle-color-1  {
    width: 300px;
    height: 224px;
    background-color: #000000;
    border-top-left-radius: 150px;
    border-bottom-left-radius: 150px;
    top: -7px;
    border-radius: 50%;
    left: 60%;
    padding:4px;
}
.bussiness-back-circle .circle-color-2  {
    width: 300px;
    height: 215px;
    background-color: #daa520;
    border-top-left-radius: 150px;
    border-bottom-left-radius: 150px;
    /*top: -7px;*/
    border-radius: 50%;
    /*left: 60%;*/
    position:relative;
}
.bussiness-card-img{
    position: absolute;
    top: 48%;
    left: 70%;
    transform: translate(-50%, -50%);
}
.bussiness-card-img img{
    border-radius:50%;
    background-color:#ffffff;
    padding:4px;
    width:85px;
    height:85px;
}
.bussiness-card:hover .bussiness-back-circle  .bussiness-card-layer{
    display:block;
}
.bussiness-card-layer{
    position:absolute;
    width:100%;
    height:100%;
    border-radius:50%;
    top:0;
    left:0;
    background-color:#000000ab;
    display:none;
}
.bussiness-card-layer span{
    position: absolute;
    left: 26%;
    top: 50%;
    transform: translate(-50%, -50%);
    
}
.bussiness-card-layer span i{
    font-size:24px;
       color:#ffffff;
       cursor:pointer;
}
a.url_btn{
    text-decoration:none;
    color: #858796 !important;
}

element.style {
}
.chat-bot-box .form-control {
    height: 42px;
}
.danger {
    border:1px solid #FF0000 !important;
}
.b-u-image{
    border-radius:50%;
}

</style>
@endsection

@section('content')
 <div class="row justify-content-between">
        <div class="col-9">
            <h1 class="h3 mb-2 text-gray-800">{{ __('backend.chatbot.entity.list') }}</h1>
            <p class="mb-4">{{ __('backend.chatbot.entity.list_desc') }}</p>
        </div>
        <div class="col-3 text-right">
            <a href="{{ route('admin.entity.create') }}" class="btn btn-info btn-icon-split">
                <span class="icon text-white-50">
                  <i class="fas fa-plus"></i>
                </span>
                <span class="text">{{ __('backend.chatbot.entity.create') }}</span>
            </a>
        </div>
    </div>
   <div class="chat-bot-icon">
        <a  class="open-modal-main"><img src="{{asset('laravel_project/public/frontend/images/chatbot/bot-logo.gif')}}" alt=""></a>
    </div>
    <div class="chatbot-main">
    <div class="chat-bot-box">  
        <div class="bot-box"> 
            <div class="chat-box-header px-2">
                <div class="row justify-content-between align-items-center">
                    <div class="col-md-3 col-3">
                        <div class="bot-logo">
                            <img src="{{asset('laravel_project/public/storage/setting/favicon-2023-01-18-63c7b8fcc4190.jpg')}}" alt="">
                        </div>
                    </div>
                    <div class="col-md-9 col-9">
                        <div class="row align-items-baseline">
                            <div class="col-md-6 col-6">
                                <div type="button" class="feedback-btn open-modal">Send FeedBack</div>
                            </div>
                            <div class="col-md-2 col-2">
                                <div type="button" class=""><i class="fa fa-bars"></i></div>
                            </div>
                            <div class="col-md-2 col-2">
                                <div type="button" class=""><i class="fa fa-window-minimize"></i></div>
                            </div>
                            <div class="col-md-2 col-2">
                                <div type="button" class="close-modal-main"><i class="fa fa-times"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="chat-box-body">
                <div class="box-body" id="wrapper">
                    <div class="scrollbar" id="style-15">
                        <div class="force-overflow"></div>
                      </div>
                    <ul class="list-unstyled" id="conversation_box">
                        <!--Message from bot-->
                        <!--<li>-->
                        <!--    <div class="row">-->
                        <!--        <div class="col-md-2 col-2">-->
                        <!--            <img src="{{asset('laravel_project/public/frontend/images/chatbot/wu_icon.png')}}" alt="">-->
                        <!--        </div>-->
                        <!--        <div class="col-md-8 col-8"><p class="normalp">Hi, I am Eve—your automated Western Union assistant. How can I help you today?</p></div>-->
                        <!--    </div>-->
                        <!--</li>-->
                          <!--Message from human-->
                        <!-- <li class="">-->
                        <!--    <div class="row human ">-->
                        <!--        <div class="col-md-8 col-8"><p class="replyp">Get profile help</p></div>-->
                        <!--    </div>-->
                        <!--</li>-->
                    <!--<li>-->
                    <!--        <div class="row">-->
                    <!--            <div class="col-md-2 col-2">-->
                    <!--                <img src="{{asset('laravel_project/public/frontend/images/chatbot/wu_icon.png')}}" alt="">-->
                    <!--            </div>-->
                    <!--            <div class="col-md-8 col-8"><p class="normalp">Hi, I am Eve—your automated Western Union assistant. How can I help you today?</p></div>-->
                    <!--        </div>-->
                    <!--    </li>-->
                    <!--<li>-->
                    <!--        <div class="row">-->
                    <!--            <div class="col-md-8 col-8"><p class="replyp">Hi, I am Eve—your automated Western Union assistant. How can I help you today?</p></div>-->
                    <!--        </div>-->
                    <!--    </li>-->
                    <!--<li>-->
                    <!--        <div class="row">-->
                    <!--            <div class="col-md-2 col-2">-->
                    <!--                <img src="{{asset('laravel_project/public/frontend/images/chatbot/wu_icon.png')}}" alt="">-->
                    <!--            </div>-->
                    <!--            <div class="col-md-8 col-8">-->
                    <!--                <p class="normalp">Hi, I am Eve—your automated Western Union assistant. How can I help you today?</p>-->
                    <!--                <p class="normalp">Here are the options to start:</p>-->
                    <!--                <div class="">-->
                    <!--                    <div class="row">-->
                    <!--                            <div class=" btn-track">Track Track transfer</div>-->
                    <!--                            <div class=" btn-track">Find locations</div>-->
                    <!--                            <div class=" btn-track">Find locations</div>-->
                    <!--                            <div class=" btn-track">Find locations</div>-->
                    <!--                            <div class=" btn-track">Find locations</div>                                          -->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--            </div>-->
                                
                    <!--        </div>-->
                    <!--    </li>-->
                    <!--<li>-->
                    <!--        <div class="row">-->
                    <!--            <div class="col-md-8 col-8"><p class="replyp">value of button</p></div>-->
                    <!--        </div>-->
                    <!--    </li>-->
                    <!--display template message and buttons-->
                    <!--<li>-->
                    <!--        <div class="row">-->
                    <!--            <div class="col-md-2 col-2">-->
                    <!--                <img src="{{asset('laravel_project/public/frontend/images/chatbot/wu_icon.png')}}" alt="">-->
                    <!--            </div>-->
                    <!--            <div class="col-md-8 col-8">-->
                    <!--                <p class="normalp">"Great, let me help you find a car for you."</p>-->
                    <!--                <p class="normalp">Which city you are travelling to?</p>-->
                    <!--                <div class="">-->
                    <!--                    <div class="row">-->
                                           
                    <!--                            <div class=" btn-city">France Italy Poland</div>                                       -->
                    <!--                            <div class=" btn-city">Germany</div>                                          -->
                    <!--                            <div class=" btn-city">Italy</div>                                           -->
                    <!--                            <div class=" btn-city">Poland</div>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </li>-->
                    <!--<li>-->
                    <!--        <div class="row">-->
                    <!--            <div class="col-md-8 col-8"><p class="replyp"> value of city btn</p></div>-->
                    <!--        </div>-->
                    <!--    </li> -->
                    <!--<li>-->
                    <!--        <div class="row">-->
                    <!--            <div class="col-md-2 col-2">-->
                    <!--                <img src="{{asset('laravel_project/public/frontend/images/chatbot/wu_icon.png')}}" alt="">-->
                    <!--            </div>-->
                    <!--            <div class="col-md-8 col-8">-->
                    <!--                <p class="normalp">"Great, let me help you find a car for you."</p>-->
                    <!--                <p class="normalp">Which city you are travelling to?</p>-->
                    <!--                <div class="">-->
                    <!--                    <div class="row">-->
                                           
                    <!--                            <div class=" btn-city">Find a City</div>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </li>-->
                    <!--<li>-->
                    <!--        <div class="row">-->
                    <!--            <div class="col-md-8 col-8"><p class="replyp"> value of city btn</p></div>-->
                    <!--        </div>-->
                    <!--    </li>-->
                     <!--list template-->
                    <!--<li> -->
                    <!--    <div class="row">-->
                    <!--        <div class="col-md-2 col-2">-->
                    <!--            <img src="{{asset('laravel_project/public/frontend/images/chatbot/wu_icon.png')}}" alt="">-->
                    <!--        </div>-->
                    <!--        <div class="col-md-8 col-8">-->
                    <!--            <p class="normalp">"Great, let me help you find a car for you."</p>-->
                    <!--            <p class="normalp">Which city you are travelling to?</p>-->
                    <!--            <div class="">-->
                    <!--                <div class="row">-->
                                       
                    <!--                        <div class=" btn-city">Find a City</div>-->
                    <!--                </div>-->
                    <!--                <div class="row">-->
                    <!--                    <div class="col-md-12 col-12">-->
                    <!--                        <ul class="list-unstyled city-list "> -->
                    <!--                            <li class="d-flex justify-content-between"><p>France</p> <input type="radio" name="r1" id=""></li>-->
                    <!--                            <li class="d-flex justify-content-between"><p>Germany</p> <input type="radio" name="r1" id=""></li>-->
                    <!--                            <li class="d-flex justify-content-between"><p>Italy</p> <input type="radio" name="r1" id=""></li>-->
                    <!--                            <li class="d-flex justify-content-between"><p>Poland</p> <input type="radio" name="r1" id=""></li>-->
                    <!--                            <li class="d-flex justify-content-between"><p>Rom</p> <input type="radio" name="r1" id=""></li>-->
                    <!--                            <li class="d-flex justify-content-between"><p>Gress</p> <input type="radio" name="r1" id=""></li>-->
                    <!--                            <li class="d-flex justify-content-between"><p>ETC.</p> <input type="radio" name="r1" id=""></li>-->
                    <!--                            <div class="select-btn btn btn-success text-center w-100 b-0 " type="submit">Select this City</div>-->
                    <!--                        </ul>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</li>-->
                    <!--<li>-->
                    <!--    <div class="row">-->
                    <!--        <div class="col-md-8 col-8"><p class="replyp"> Value of city btn</p></div>-->
                    <!--    </div>-->
                    <!--</li> -->
                    <!--<li>-->
                    <!--    <div class="row">-->
                    <!--        <div class="col-md-2 col-2">-->
                    <!--            <img src="{{asset('laravel_project/public/frontend/images/chatbot/wu_icon.png')}}" alt="">-->
                    <!--        </div>-->
                    <!--        <div class="col-md-8 col-8">-->
                    <!--            <p class="normalp">"Great, let me help you find a car for you."</p>-->
                    <!--            <div class="">-->
                    <!--                <div class="row">                                       -->
                    <!--                    <div class=" btn-city">Find a City</div>-->
                    <!--                    <div class="col-md-12 col-12 bot-slider">-->
                    <!--                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">-->
                    <!--                            <ol class="carousel-indicators">-->
                    <!--                              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>-->
                    <!--                              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>-->
                    <!--                              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>-->
                    <!--                            </ol>-->
                    <!--                            <div class="carousel-inner">-->
                    <!--                              <div class="carousel-item active">-->
                    <!--                                <div class="card" style="width:100%">-->
                    <!--                                    <img src="{{asset('laravel_project/public/frontend/images/chatbot/car1.jpg')}}" class="card-img-top" alt="...">-->
                    <!--                                    <div class="card-body">-->
                    <!--                                        <div class="row">-->
                    <!--                                            <div class=" m-1"><a href="" class="btn btn-info">Business</a></div>-->
                    <!--                                            <div class=" m-1"><a href="" class="btn btn-info">africen </a></div>-->
                    <!--                                            <div class=" m-1"><a href="" class="btn btn-info">africen </a></div>-->
                    <!--                                        </div>-->
                    <!--                                        <h2>Skin Care Corner</h2>-->
                    <!--                                        <p>11321 105A Avenue Grand AB, Grande Prairie, Alberta T8V4A7</p>-->
                    <!--                                        <div class="row d-block mx-2">-->
                    <!--                                            <div class="icon">-->
                    <!--                                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" width="15px" height="15px" fill="gray" style="margin-left: 2px;"><polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566 "></polygon></svg>-->
                    <!--                                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" width="15px" height="15px" fill="gray" style="margin-left: 2px;"><polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566 "></polygon></svg>-->
                    <!--                                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" width="15px" height="15px" fill="gray" style="margin-left: 2px;"><polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566 "></polygon></svg>-->
                    <!--                                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" width="15px" height="15px" fill="gray" style="margin-left: 2px;"><polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566 "></polygon></svg>-->
                    <!--                                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" width="15px" height="15px" fill="gray" style="margin-left: 2px;"><polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566 "></polygon></svg>-->
                    <!--                                            </div>-->
                    <!--                                            <p>(1 review)</p>-->
                    <!--                                        </div>-->
                    <!--                                        <div class="row align-items-center mt-2">-->
                    <!--                                            <div class="col-md-3 col-3">-->
                    <!--                                                <div>-->
                    <!--                                                    <img src="{{asset('laravel_project/public/frontend/images/chatbot/wu_icon.png')}}" alt="">-->
                    <!--                                                </div>-->
                    <!--                                            </div>-->
                    <!--                                            <div class="col-md-9 col-9">-->
                    <!--                                                <div class="icon-text">-->
                    <!--                                                    <p>Huguette2023</p>-->
                    <!--                                                    <p>3 weeks ago</p>-->
                    <!--                                                </div>-->
                    <!--                                            </div>-->
                    <!--                                        </div>-->
                    <!--                                    </div>-->
                    <!--                                    <div class="select-btn btn  text-center w-100 b-0 " type="submit">Select this car</div>-->
                    <!--                                  </div>-->
                    <!--                              </div>-->
                    <!--                              <div class="carousel-item">-->
                    <!--                                    <div class="card" style="width:100%">-->
                    <!--                                        <img src="{{asset('laravel_project/public/frontend/images/chatbot/car2.jpg')}}" class="card-img-top" alt="...">-->
                    <!--                                        <div class="card-body">-->
                    <!--                                            <div class="row">-->
                    <!--                                                <div class=" m-1"><a href="" class="btn btn-info">Business</a></div>-->
                    <!--                                                <div class=" m-1"><a href="" class="btn btn-info">africen </a></div>-->
                    <!--                                                <div class=" m-1"><a href="" class="btn btn-info">africen </a></div>-->
                    <!--                                            </div>-->
                    <!--                                            <h2>MEPS TIRE & AUTO CARE</h2>-->
                    <!--                                            <p>9818 44 Ave NW,, Edmonton, Alberta T6E5E5</p>-->
                    <!--                                            <div class="row d-block mx-2">-->
                    <!--                                                <div class="icon">-->
                    <!--                                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" width="15px" height="15px" fill="gray" style="margin-left: 2px;"><polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566 "></polygon></svg>-->
                    <!--                                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" width="15px" height="15px" fill="gray" style="margin-left: 2px;"><polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566 "></polygon></svg>-->
                    <!--                                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" width="15px" height="15px" fill="gray" style="margin-left: 2px;"><polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566 "></polygon></svg>-->
                    <!--                                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" width="15px" height="15px" fill="gray" style="margin-left: 2px;"><polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566 "></polygon></svg>-->
                    <!--                                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" width="15px" height="15px" fill="gray" style="margin-left: 2px;"><polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566 "></polygon></svg>-->
                    <!--                                                </div>-->
                    <!--                                                <p>(1 review)</p>-->
                    <!--                                            </div>-->
                    <!--                                            <div class="row align-items-center mt-2">-->
                    <!--                                                <div class="col-md-3 col-3">-->
                    <!--                                                    <div>-->
                    <!--                                                        <img src="{{asset('laravel_project/public/frontend/images/chatbot/wu_icon.png')}}" alt="">-->
                    <!--                                                    </div>-->
                    <!--                                                </div>-->
                    <!--                                                <div class="col-md-9 col-9">-->
                    <!--                                                    <div class="icon-text">-->
                    <!--                                                        <p>MEPS</p>-->
                    <!--                                                        <p>1 weeks ago</p>-->
                    <!--                                                    </div>-->
                    <!--                                                </div>-->
                    <!--                                            </div>-->
                    <!--                                        </div>-->
                    <!--                                        <div class="select-btn btn  text-center w-100 b-0 " type="submit">Select this car</div>-->
                    <!--                                      </div>-->
                    <!--                              </div>-->
                    <!--                              <div class="carousel-item">-->
                    <!--                                    <div class="card" style="width:100%">-->
                    <!--                                        <img src="{{asset('laravel_project/public/frontend/images/chatbot/car1.jpg')}}" class="card-img-top" alt="...">-->
                    <!--                                        <div class="card-body">-->
                    <!--                                            <div class="row">-->
                    <!--                                                <div class=" m-1"><a href="" class="btn btn-info">Business</a></div>-->
                    <!--                                                <div class=" m-1"><a href="" class="btn btn-info">africen </a></div>-->
                    <!--                                                <div class=" m-1"><a href="" class="btn btn-info">africen </a></div>-->
                    <!--                                            </div>-->
                    <!--                                            <h2>Skin Care Corner</h2>-->
                    <!--                                            <p>11321 105A Avenue Grand AB, Grande Prairie, Alberta T8V4A7</p>-->
                    <!--                                            <div class="row d-block mx-2">-->
                    <!--                                                <div class="icon">-->
                    <!--                                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" width="15px" height="15px" fill="gray" style="margin-left: 2px;"><polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566 "></polygon></svg>-->
                    <!--                                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" width="15px" height="15px" fill="gray" style="margin-left: 2px;"><polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566 "></polygon></svg>-->
                    <!--                                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" width="15px" height="15px" fill="gray" style="margin-left: 2px;"><polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566 "></polygon></svg>-->
                    <!--                                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" width="15px" height="15px" fill="gray" style="margin-left: 2px;"><polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566 "></polygon></svg>-->
                    <!--                                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" width="15px" height="15px" fill="gray" style="margin-left: 2px;"><polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566 "></polygon></svg>-->
                    <!--                                                </div>-->
                    <!--                                                <p>(1 review)</p>-->
                    <!--                                            </div>-->
                    <!--                                            <div class="row align-items-center mt-2">-->
                    <!--                                                <div class="col-md-3 col-3">-->
                    <!--                                                    <div>-->
                    <!--                                                        <img src="{{asset('laravel_project/public/frontend/images/chatbot/wu_icon.png')}}" alt="">-->
                    <!--                                                    </div>-->
                    <!--                                                </div>-->
                    <!--                                                <div class="col-md-9 col-9">-->
                    <!--                                                    <div class="icon-text">-->
                    <!--                                                        <p>Huguette2023</p>-->
                    <!--                                                        <p>3 weeks ago</p>-->
                    <!--                                                    </div>-->
                    <!--                                                </div>-->
                    <!--                                            </div>-->
                    <!--                                        </div>-->
                    <!--                                        <div class="select-btn btn  text-center w-100 b-0 " type="submit">Select this car</div>-->
                    <!--                                  </div>-->
                    <!--                              </div>-->
                    <!--                            </div>-->
                    <!--                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">-->
                    <!--                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>-->
                    <!--                              <span class="sr-only">Previous</span>-->
                    <!--                            </a>-->
                    <!--                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">-->
                    <!--                              <span class="carousel-control-next-icon" aria-hidden="true"></span>-->
                    <!--                              <span class="sr-only">Next</span>-->
                    <!--                            </a>-->
                    <!--                          </div>-->
                    <!--                    </div>-->
                    <!--                </div>-->

                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</li>-->
                    <!--<li>-->
                    <!--    <div class="row">-->
                    <!--        <div class="col-md-8"><p class="replyp"> Value of city btn </p></div>-->
                    <!--    </div>-->
                    <!--</li> -->
                    <!--<li>-->
                    <!--        <div class="row">-->
                    <!--            <div class="col-md-2 col-2">-->
                    <!--                <img src="{{asset('laravel_project/public/frontend/images/chatbot/wu_icon.png')}}" alt="">-->
                    <!--            </div>-->
                    <!--            <div class="col-md-8 col-8">-->
                    <!--                <div class='gif_img'><img src="{{asset('laravel_project/public/frontend/images/chatbot/loder.gif')}}" alt=""></div>    -->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </li>-->
                    <!--<li>-->
                    <!--        <div class="row">-->
                    <!--            <div class="col-md-8 col-8"><p class="replyp"> value of city btn</p></div>-->
                    <!--        </div>-->
                    <!--    </li>-->
                    </ul>
                </div>
                <!--<div class="inner-box">-->
                <!--    <div class="message-box">-->
                <!--        <div class="btn btn-dark close-btn close-modal"> Exit</div>-->
                <!--    <span class="message-text">Before chatting with a live representative, please provide the following information:-->
                <!--    </span>-->
                <!--    </div>-->
                <!--    <div class="">-->
                <!--        <form action="" method class="row w-100 m-auto pt-4"> -->
                <!--            <div class="col-md-12 my-2 inpt-icon">-->
                <!--            <input type="text" class=" fa form-control" placeholder="&#xf007; First Name" title="Please fill the First Name" required> -->
                <!--            </div>-->
                <!--            <div class="col-md-12  my-2 inpt-icon">-->
                <!--                <input type="text" class="fa form-control" placeholder="&#xf007; Last Name" title="Please fill the Last Name" required>    -->
                <!--                </div>-->
                <!--                <div class="col-md-12  my-2 inpt-icon">-->
                <!--                    <input type="text" class="fa form-control" placeholder="&#xf0e0; Email address" title="Please fill the Email address" required>    -->
                <!--                    </div>-->
                <!--                    <div class="col-md-12  my-2 inpt-icon">-->
                <!--                        <input type="text" class="fa form-control" placeholder="&#xf1c0; MTCN (Optioan)" title="This is your choice">    -->
                <!--                        </div>-->
                <!--                        <div class="col-md-12  my-2">-->
                <!--                           <select name="" id="" class="form-control" required>-->
                <!--                            <option id="" selected="true" disabled="disabled">Chat reason*</option>-->
                <!--                            <option id="1">Sending money issue</option>-->
                <!--                            <option id="2">Receiving money issue</option>-->
                <!--                            <option id="3">Transfer on hold</option>-->
                <!--                            <option id="4">Cancel or refund</option>-->
                <!--                            <option id="5">Update transfer</option>-->
                <!--                            <option id="6">Profile or verification issue</option>-->
                <!--                            <option id="7">Other</option>-->
                <!--                           </select>  -->
                <!--                           <span></span> -->
                <!--                     </div>-->
                <!--                     <div class="col-md-12  my-2">-->
                <!--                        <input type="submit" class="form-control" value="Start live chat">    -->
                <!--                    </div>-->
                <!--        </form>-->
                <!--    </div>-->
                <!--</div>-->
                <!--Message Model-->
                    <div class="inner-chat-box">
                    <div class="message-box">
                        <div class="btn btn-dark btn-circle  close-modal"> <i class="fa fa-times"></i></div>
                    <span class="message-text">
                    </span>
                    </div>
                    <div class="">
                          <ul class="list-unstyled" id="conversation_chat_box">
                              <input type="hidden" value="" id="to_id">
                        <!--Message from Business owner/Event owner/Excutive-->
                        <li>
                            <div class="row">
                                <div class="col-md-2 col-2">
                                    <img src="{{asset('laravel_project/public/frontend/images/chatbot/wu_icon.png')}}" alt="">
                                </div>
                                <div class="col-md-8 col-8"><p class="normalp">Hi, I am Eve—your automated Western Union assistant. You Can start your chat here.first ping the business user with a greeting message?.On page refresh all chat will be removed.</p></div>
                            </div>
                        </li>
                          <!--Message from human-->
                        <ul/>
                    </div>
                </div>
               <!--Message Model-->
                <div class="inner-message-box">
                    <div class="message-box">
                        <div class="btn btn-dark btn-circle  close-modal"> <i class="fa fa-times"></i></div>
                    <span class="message-text">You can Leave a message to our bussiness owner:
                    </span>
                    </div>
                    <div class="">
                        <form action="" method class="row w-100 m-auto pt-4"> 
                            <div class="col-md-12 my-2 inpt-icon">
                            <input type="text" class=" fa form-control" id="subject" placeholder="Subject" title="Please provide  subject for Message" required> 
                            </div>
                                  <div class="col-md-12  my-2 inpt-icon">
                                <textarea  class="form-control textarea" id="message" placeholder="Write your message here"   required></textarea>    
                                </div>
                                     <div class="col-md-12  my-2">
                                        <input type="button" id="send_message" class="form-control" value="Send Message">    
                                    </div>
                        </form>
                    </div>
                </div>
            </div>
            

            <div class="chat-box-footer">
                <div class="message-input">
                        <input name="msg" id="human_response" class="Input_field form-control" placeholder="Send a message...">
						<button type="button" id="trigger_reply" class="Input_button Input_button-send"><img src="{{asset('laravel_project/public/frontend/images/chatbot/send-icon.png')}}" alt=""></button>
                </div>
                <div class="copyright-content">
                    <p>© 2023 <a href="">blkzone</a></p>
                </div>
            </div>
        </div>
    </div>
    </div>
   
@endsection

@section('scripts')
  <!--<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){
//   $(".open-modal").click(function(){
//     $('.leave-message-box').show();
//   });
   $(".open-modal").click(function(){
    $('.inner-chat-box').show();
  });
   $(".close-modal").click(function(){
    $('.inner-message-box').hide();
    $('.inner-chat-box').hide();
  });

  $(".open-modal-main").click(function(){
    $('.chat-bot-box').show();
  });
   $(".close-modal-main").click(function(){
    $('.chat-bot-box').hide();
  });
});
</script>

    <!-- Page level plugins -->
<script>
       //Load Conversation Logs
       
        $(window).on('load',function(){
            $.ajax({
                method:"get",
                url:"{{route('admin.debug.chatbot.log')}}",
                success:function(response){
                    if(response.code=="200"){
                        console.log(response);
                        response.data.map((logs)=>{
                              $('#conversation_box').append(logs.template);  
                        });
                    }
                },
                error:function(error){
                    console.log(error);
                }
            })
        });
        
       //Load Welcome Message 
        $(document).ready(function(){
           $.ajax({
               method:'get',
               url:'{{route("admin.debug.conversation")}}',
               data:{'title':'welcome'},
               success:function(response){
                  console.log(response); 
                  if(response.code=="200"){
                       if($('#conversation_box').length==0){
                            $('#conversation_box').append(response.template);
                       }
                     
                  }
               },
               error:function(error){
                   console.log(error);
               }
           });
        });
        
      //Handel Every Click of Chatbot    
        $(document).ready(function(){
            $(document).on('click','.display_btn',function(){
                let loder=`<li id="loder">
                            <div class="row">
                                <div class="col-md-2 col-2">
                                    <img src="{{asset('laravel_project/public/frontend/images/chatbot/wu_icon.png')}}" alt="">
                                </div>
                                <div class="col-md-8 col-8">
                                    <div class='gif_img'><img src="{{asset('laravel_project/public/frontend/images/chatbot/loder.gif')}}" alt=""></div>    
                                </div>
                            </div>
                        </li>`;
                $('#conversation_box').append(loder);
                let references=$(this).attr('data-references');
                let type=$(this).attr('data-type');
                let user_selct=$(this).text();
                let source_values="";
                source_values=$(this).attr('data-item-slug');
                if(type=='datasource'){
                    if(references=='list_by_country'){
                       source_values=$('.countries:checked').val(); 
                    }
                }
                if(references=='leave_message'){
                     $('#loder').remove();
                    sendMessage(source_values);
                    return false;
                }
                if(references=='start_chat'){
                     $('#loder').remove();
                        let user_selction=`<li class="">
                            <div class="row human">
                                <div class="col-md-8 col-8"><p class="replyp">${user_selct}</p></div>
                            </div>
                        </li>`;
                        $('#conversation_box').append(user_selction);
                   $('.inner-chat-box').show();
                   
                    return false;
                }
                console.log('source_value'+source_values);
                 $.ajax({
                  method:"get",
                  url:"{{route('admin.debug.display.conversation')}}",
                  data:{ref:references,type:type,source:source_values,btn_text:user_selct},
                  success:function(response){
                       console.log(response);
                      if(response.code==200){
                         $('#loder').remove();
                         if(response.res.session_slug){
                           $('#to_id').val(response.res.session_slug.source);     
                         }
                          
                          $('#conversation_box').append(response.template);
                      }
                  },
                  error:function(error){
                      
                  },
                 });
                
            });
    //Trigger/Question/Chat handle by this block   
    
            $(document).on('click','#trigger_reply',function(){
                 let loder=`<li id="loder">
                            <div class="row">
                                <div class="col-md-2 col-2">
                                    <img src="{{asset('laravel_project/public/frontend/images/chatbot/wu_icon.png')}}" alt="">
                                </div>
                                <div class="col-md-8 col-8">
                                    <div class='gif_img'><img src="{{asset('laravel_project/public/frontend/images/chatbot/loder.gif')}}" alt=""></div>    
                                </div>
                            </div>
                        </li>`;
                $('#conversation_box').append(loder);
                let trigger_text=$('#human_response').val();
                console.log(trigger_text);
                let error=false;
                if(trigger_text==""){
                    $('#human_response').addClass('danger');
                    error=true;
                }
                if(error==true){
                    return false;
                }
                let chat_active=$('.inner-chat-box').css('display');
                console.log(chat_active);
                if(chat_active=='block'){
                      $('#loder').remove();
                     sendChat(trigger_text);
                       return false;
                }
                $.ajax({
                    method:"get",
                    url:"{{route('admin.debug.trigger.conversation')}}",
                    data:{trigger:trigger_text},
                    success:function(response){
                        if(trigger_text=="refresh"){
                            $('#conversation_box').empty().append(response.template); 
                        }
                        console.log(response);
                    },
                    error:function(error){
                        console.log(error);
                    }
                    
                })
                
            });
            
        });
        
     //Send Message To Business Owner
     function sendMessage(r_id){
         $('.inner-message-box').show();
          $(document).on('click','#send_message',function(){
              console.log(r_id);
           let subject=$('#subject').val();
           let message=$('#message').val();
           let recipient_id=r_id;
           let error=false;
           if(subject==""){
               $('#subject').addClass('danger');
               error=true;
           }
           if(message==""){
               $('#message').addClass('danger');
               error=true;
           }
           console.log(error);
           if(error==false){
             $.ajax({
               method:"get",
               url:"{{route('admin.debug.chatbot.message')}}",
               data:{subject:subject,message:message,recipient_id:recipient_id,btn_text:"Leave Message"},
               success:function(response){
                  console.log(response);
                  if(response.code==200){
                      $('#subject').val("");
                      $('#message').val("");
                         $('.inner-message-box').hide();
                      $('#conversation_box').append(response.template);
                  }
               },
               error:function(error){
                   console.log(error);
               }
           });  
           }
           
        });
        
          $(document).on('keyup','input,textarea',function(){
              $(this).removeClass('danger');
          });
     }
     
     //Store chat and fire an event
     
     function sendChat(message_text){
         console.log(message_text);
       
       let to_id=$('#to_id').val();
       let token="{{csrf_token()}}";
         let vistor_message=`<li class="">
                            <div class="row human">
                                <div class="col-md-8 col-8"><p class="replyp">${message_text}</p></div>
                            </div>
                        </li>`;
     
        $('#conversation_chat_box').append(vistor_message);
         
      $.ajax({
          method:'post',
          url:'{{route("store.chat")}}',
          data:{to_id:to_id,message:message_text,type:'item',msg_type:'bot',_token:token},
          success:function(response){
            console.log(response);
          },
          error:function(error){
             console.log(error); 
          }
      });
         
     }
       
    </script>
    
    <!--Bot Live chat section-->
<script>
    $(document).ready(function(){
       @if(Auth::check())
        let logged_user="{{Auth::user()->id}}";
       @else
         let logged_user="{{Auth::guard('customer')->user()->id}}";
       @endif
       console.log(logged_user);
        window.Echo.channel('customer.chat.'+logged_user)
        .listen('.CustomerChat',function(event){
                          let owner_message=`<li>
                            <div class="row">
                                <div class="col-md-2 col-2">
                                    <img class="b-u-image" src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=880&q=80" alt="">
                                </div>
                                <div class="col-md-8 col-8"><p class="normalp">${event.chat.message}</p></div>
                            </div>
                        </li>`;
                        $('#conversation_chat_box').append(owner_message);
        });
    });
</script>
    
  
@endsection



