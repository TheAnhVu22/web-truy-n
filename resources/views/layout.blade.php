<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!------------------ share ----------->
        {{-- <meta property="og:type" content="website"/>
        <meta property="og:title" content="{{$title}}"/>
        <meta property="og:desciption" content="{{$meta_desc}}"/>
        <meta property="og:image" content="{{$og_image}}"/>
        <meta property="og:url" content="{{$og_canonical}}"/>
        <meta property="og:site_name" content="Sachtruyen247"/>
        <link rel="icon" href="{{$link_icon}}" style="image/gif" sizes="16x16">
        <title>{{$title}}</title> --}}
        
        <style type="text/css">
            .switch_color{
            background: black;
            color: white;
          }
          .switch_color_light{
            background: wheat; !important;
            color:black;
          }
          .noidung_color {
            color:white;
          }
        </style>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
         <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/owl.theme.default.min.css') }}" rel="stylesheet">
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        {{-- font awesome --}}
        <script src="https://kit.fontawesome.com/f8077388f9.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    </head>
    <body class="antialiased">

     <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">   
        <div class="container">
            <!---------------------------menu--------------->

              <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a href="{{ route('home') }}" class="navbar-brand"><i class="fas fa-book-reader"></i> Sachtruyen.com</a>
              <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="{{ route('/') }}">Trang ch??? <i class="fas fa-home"></i></a>
                    </li>
                    
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Danh m???c truy???n <i class="fas fa-bookmark"></i>
                      </a>
                      <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach ($danhmuc as $key => $dl)
                            <li><a class="dropdown-item" href="{{ url('danh-muc/'.$dl->slug_danhmuc) }}">{{$dl->tendanhmuc}}</a></li>
                        @endforeach
                      </ul>
                    </li>

                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Th??? lo???i truy???n <i class="fas fa-th-list"></i>
                      </a>
                      <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach ($theloai as $key => $dl)
                            <li><a class="dropdown-item" href="{{ url('the-loai/'.$dl->slug_theloai) }}">{{$dl->tentheloai}}</a></li>
                        @endforeach
                      </ul>
                    </li>
                    
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('doc-sach') }}">S??ch <i class="fas fa-book"></i></a>
                    </li>
                  </ul>
                
                </div>
              </div>
            </nav>
        </div>
     </nav>
        <div class="container">
 <!-- Form t??m ki???m + ch???n m??u n???n -->
            <div class="row">
              <div class="col-md-6">              
            <div class="addthis_inline_share_toolbox"></div> 
              <form autocomplete="off" class="form-inline" action="{{url('tim-kiem')}}" method="POST">
                @csrf
                <div class="input-group mb-3 mt-2">
                  <input class="form-control mr-sm-2" id="keywords" type="search" name="tukhoa" placeholder="T??m ki???m t??c gi???,truy???n...." aria-label="Search">
                  <button class="btn btn-success my-2 my-sm-0" type="submit">T??m ki???m <i class="fas fa-search"></i></button>
                  </div>
                  <div id="search_ajax"></div>

                  <label>Ch???n m??u n???n:</label>
                    <select class="custom-select mr-sm-2" id="switch_color">  
                      <option value="xam">X??m</option>
                      <option value="den">??en</option>
                    </select>
                </form>
              </div>
            </div>

            <!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-61b5618b0a513ea4"></script>


            <!-----------------------slide------------>
            @yield('slide')
            @yield('content')
        
        
    <!---------------- footer ----------->
    <footer class="text-muted py-5">
      <div class="container">
        <p class="float-end mb-1">
          <a href="#">Back to top</a>
        </p>
        <p class="mb-1">Album example is ?? Bootstrap, but please download and customize it for yourself!</p>
        <p class="mb-0">New to Bootstrap? <a href="/">Visit the homepage</a> or read our <a href="/docs/5.1/getting-started/introduction/">getting started guide</a>.</p>
      </div>
    </footer>

  </div> {{-- end container --}}
<!-- Messenger Plugin chat Code -->
    <div id="fb-root"></div>

    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "100155512433949");
      chatbox.setAttribute("attribution", "biz_inbox");
    </script>

    <!-- Your SDK code -->
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v12.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
        {{-- slide trong view chapter--}}
        <script type="text/javascript">

                $('.owl-carousel').owlCarousel({
                loop:true,
                dots:true,
                margin:10,
                nav:true,
                responsiveClass:true,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:3
                    },
                    1000:{
                        items:5
                    }
                }
                });     
        </script>
        {{-- end slide trong view chapter--}}

        <script type="text/javascript">
      
        // $(document).on('click','.xemsachnhanh',function(){
          $('.xemsachnhanh').on('click',function(){
            var sach_id = $(this).attr('id');
            var _token = $('input[name="_token"]').val();
          
            $.ajax({
                url:'{{url('/xemsachnhanh')}}',
                method:"POST",
                dataType:"JSON",
                data:{sach_id:sach_id,_token:_token},
                success:function(data){
                    $('#tieude_sach').html(data.tieude_sach);
                    $('#noidung_sach').html(data.noidung_sach);
                }
            }); 
        });
    </script>

    <script type="text/javascript">
   $('.tabs_danhmuc').click(function(){
    const danhmuc_id = $(this).data('danhmuc_id');
    
    var _token = $('input[name="_token"]').val();

            $.ajax({
                url:'{{url('/tabs-danhmuc')}}',
                method:"POST",

                data:{_token:_token, danhmuc_id:danhmuc_id},
                success:function(data){
                    $('#tab_danhmuctruyen').html(data);
                }

            }); 
   })
 </script>

    {{-- ----- L??u truy???n y??u th??ch ---- --}}
    <script type="text/javascript">
      show_wishlist();
      function show_wishlist(){
          if(localStorage.getItem('wishlist_truyen')!=null){
            // chuy???n chu???i json th??nh ?????i t?????ng js JSON.parse
             var data = JSON.parse(localStorage.getItem('wishlist_truyen'));
             // ?????o ng?????c m???ng: th??m cu???i s??? hi???n th??? ?????u ti??n
             data.reverse();

             for(i=0;i<data.length;i++){

                var title = data[i].title;
                var img = data[i].img;
                var id = data[i].id;
                var url = data[i].url;

                $('#yeuthich').append(` 
                  <div class="card shadow-sm mt-1">
            <img src="`+img+`" alt="">
            <div class="card-body">        
                <div class="btn-group">
                  <a  href="`+url+`" style="color:black; text-decoration:none;">
                            <h4 style="color:black;  ">`+title+`</h4>
                            </a>
              </div>
            </div>
          </div>
                 `);
            }

          }
      }
      $('.btn-thich_truyen').click(function(){
        $('.fa.fa-heart').css('color','#fac');
        const id = $('.wishlist_id').val();
        const title = $('.wishlist_title').val();
        const img = $('.card-img-top').attr('src');
        const url = $('.wishlist_url').val();
       
        const item = {
          'id': id,
          'title': title,
          'img': img,
          'url': url
        }
        if(localStorage.getItem('wishlist_truyen')==null){
           localStorage.setItem('wishlist_truyen', '[]');
        }
        var old_data = JSON.parse(localStorage.getItem('wishlist_truyen'));
        // t??m ki???m ph???n t??? c?? id trong wishlist
        var matches = $.grep(old_data, function(obj){
            return obj.id == id;
        })
        // n???u c?? ph???n t??? tr??ng
        if(matches.length){
            alert('Truy???n ???? c?? trong danh s??ch y??u th??ch');
        }else{
            if(old_data.length<=5){
              old_data.push(item);
            }else{
              alert('???? ?????t t???i gi???i h???n l??u truy???n y??u th??ch.');
            }
            $('#yeuthich').append(`
                    <div class="card shadow-sm mt-1">
            <img src="`+img+`" alt="">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a  href="`+url+`">
                            <p style="color:blue">`+title+`</p>
                            </a>
                </div>          
              </div>
            </div>
          </div>
                        
              `);
             // chuy???n t??? ?????i t?????ng js sang json: JSON.stringify
            localStorage.setItem('wishlist_truyen', JSON.stringify(old_data));
            alert('???? l??u v??o danh s??ch truy???n y??u th??ch.');
            
        }
         localStorage.setItem('wishlist_truyen', JSON.stringify(old_data));
       
        

       
      });
   
    </script>
     {{-- ----- end L??u truy???n y??u th??ch ---- --}}

    {{-- x??? l?? l??u m??u n???n v??o localstorage --}}
    <script type="text/javascript">
      $(document).ready(function(){
         if(localStorage.getItem('switch_color')!==null){
            const data = localStorage.getItem('switch_color');
            const data_obj = JSON.parse(data);
            $(document.body).addClass(data_obj.class_1);
    
            $('.card-body').addClass(data_obj.class_2);
            $('.noidungchuong').addClass(data_obj.class_3);
           $('ul.mucluc > li > a, ul.infotruyen > li > a').css('color','white'); 
            $("select option[value='den']").attr("selected", "selected");

          }
        })
      $("#switch_color").change(function(){
           $(document.body).toggleClass('switch_color');
            $('.card-body').toggleClass('switch_color_light');
             $('.noidungchuong').addClass('noidung_color');
            $('ul.mucluc > li > a, ul.infotruyen > li > a').css('color','#000');

           if($(this).val() == 'den'){

               var item = {
                  'class_1':'switch_color',
                  'class_2':'switch_color_light',
                  'class_3':'noidung_color'
                }   
                $('ul.mucluc > li > a, ul.infotruyen > li > a').css('color','white'); 
              localStorage.setItem('switch_color', JSON.stringify(item));

            }else if($(this).val() == 'xam'){  
              localStorage.removeItem('switch_color');
            $('ul.mucluc > li > a, ul.infotruyen > li > a').css('color','#000'); 
            } 
      });
    </script>
    {{-- end x??? l?? l??u m??u n???n v??o localstorage --}}

    {{-- ajax t??m ki???m --}}
    <script type="text/javascript">
        //b???t s??? ki???n keyup khi ng?????i d??ng g?? t??? kh??a tim ki???m
           $('#keywords').keyup(function(){ 
            var query = $(this).val(); //l???y g??a tr??? ng d??ng g??
            if(query != '') //ki???m tra kh??c r???ng th?? th???c hi???n ??o???n l???nh b??n d?????i
            {
             var _token = $('input[name="_token"]').val(); // token ????? m?? h??a d??? li???u
             $.ajax({
              url:"{{ url('/timkiem-ajax') }}", // ???????ng d???n khi g???i d??? li???u ??i 'search' l?? t??n route m??nh ?????t b???n m??? route l??n xem l?? hi???u n?? l?? c??i j.
              method:"POST", // ph????ng th???c g???i d??? li???u.
              data:{query:query, _token:_token},
              success:function(data){ //d??? li???u nh???n v???
               $('#search_ajax').fadeIn();  
               $('#search_ajax').html(data); //nh???n d??? li???u d???ng html v?? g??n v??o c???p th??? c?? id l?? countryList
             }
           });
           }else{
             $('#search_ajax').fadeOut();  
           }
         });

       $(document).on('click', '.li_search_ajax', function(){  
        $('#keywords').val($(this).text());  
        $('#search_ajax').fadeOut();  
      });  
    </script>
     {{-- end ajax t??m ki???m --}}

   {{-- // js SDK li??n k???t facebook --}}
      <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v12.0" nonce="QTtQYjTq"></script>

        {{-- chuy???n chapter trong view chapter--}}
        <script type="text/javascript">
            $('.selectchapter').on('change',function() {
                var url= $(this).val();
                if(url){
                    window.location = url;
                }
                return false;
            });

            current_chapter();
            //h??m l???y chapter hi???n t???i
            function current_chapter() {
                // l???y ???????ng d???n hi???n t???i
                var url=window.location.href;
                // so s??nh xem chapter n??o = url hi???n t???i th?? th??m selected v??o option ?????y
                $('.selectchapter').find('option[value="'+url+'"]').attr('selected', true);
            }
        </script>
        {{--end chuy???n chapter trong view chapter--}}

    </body>
</html>
