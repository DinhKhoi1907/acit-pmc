@extends('desktop.master')



@section('element_detail','main_page_detail')

@section('page_detail','page_detail')



@section('banner')

    {{-- @include('desktop.layouts.banner') --}}

@endsection



@section('content')

<div class="-mt-48 bg-cmain6 py-14 bor-none md:mt-0">

    <div class="content-page-layout detail-page-post">

        <div class="px-8 py-12 bg-white rounded-md">

            <div class="text-3xl text-left home-title"><span>{{$row_detail['ten'.$lang]}}</span></div>

            <div class="mb-3 text-muted d-none"><small>{{ngaydang}}: {{date("d/m/Y h:i A",$row_detail['ngaytao'])}}</small></div>



            @if(isset($row_detail['noidung'.$lang]) && $row_detail['noidung'.$lang] != '')

                <div id="toc_container" class="mb-5">

                    <p class="flex items-center pb-2 mb-2 text-xl font-bold border-0 border-b border-solid border-cmain3 toc_title"><i class="mr-2 fas fa-list-ol text-[20px]"></i>{{__('Nội dung bài viết')}}</p>

                    <ul id="toc"></ul>

                </div>

            

                <div class="content-main content-css w-clear" id="toc-content">{!! $row_detail['noidung'.$lang] !!}</div>

                

                <div class="share">

                    <div class="flex flex-wrap social-plugin w-clear ">

                        <div class="addthis_inline_share_toolbox_qj48"></div>

                        <div class="ml-2 zalo-share-button" data-href="{{Helper::getCurrentPageURL()}}" data-oaid="{{($settingOption['oaidzalo']!='')?$settingOption['oaidzalo']:'579745863508352884'}}" data-layout="1" data-color="blue" data-customize=false></div>

                    </div>

                </div>

            @else

                <div class="alert-data" role="alert">

                    <strong><i class="mr-1 far fa-exclamation-circle"></i>{{__('Không tìm thấy kết quả')}} !</strong>

                </div>

            @endif

            @if(isset($posts) && count($posts) > 0)
            <div class="mt-10">
                <p class="mb-2 text-xl font-bold capitalize text-cmain3">{{__('Bài viết khác')}} :</p>
                <ul class="pl-3 css_define">
                    @foreach($posts as $k=>$v)
                        <li class="flex items-center mb-1"><i class="mr-2 fas fa-square-full text-[5px] text-gray-200"></i><a class="text-base transition-all duration-300 text-cmain3 hover:text-cmain" href="{{$v['tenkhongdau'.$lang]}}">{{$v['ten'.$lang]}}</a></li>
                    @endforeach
                </ul>
            </div>
            @endif

        </div>



        {{-- @if(isset($posts) && count($posts) > 0)

            <div class="mt-12">

                <p class="home-title">{{__('Bài viết liên quan')}}</p>

            </div>

            <div class="content-main w-clear">            

                <div class="flex flex-wrap gap-[36px]">

                    @foreach($posts as $k=>$v)

                        <div class="w-full sm:w-[calc(100%/2-12px)] md:w-[calc(100%/3-24px)] group revealOnScroll" data-animation="animate__fadeInUp" data-timeout="{{($k+1)*200}}">
                            <a href="{{$v['tenkhongdau'.$lang]}}" title="{{$v['tenkhongdau'.$lang]}}"><img class="w-full lg:w-fit rounded-[20px]" src="{{ (isset($v['photo']))?Thumb::Crop(UPLOAD_POST,$v['photo'],678,465,1):'' }}" alt="" width="339" height="232.5"></a>                                
                            <h3 class="mt-[22px] mb-3"><a href="{{$v['tenkhongdau'.$lang]}}" class="font-semibold text-cmain3 group-hover:text-cmain text-[18px] leading-[131%] block line-clamp-2 min-h-[48px] transition-all duration-300">{{$v['ten'.$lang]}}</a></h3>
                            <p class="flex items-center mb-3"><svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.70247 0.280762C7.89544 0.280762 8.08875 0.280762 8.28173 0.280762C8.4846 0.301596 8.68748 0.320722 8.89001 0.343947C10.6384 0.544433 12.176 1.22718 13.4472 2.44102C15.4473 4.35093 16.2878 6.70074 15.9132 9.44401C15.6307 11.5134 14.6546 13.2341 13.0097 14.5176C10.6257 16.378 7.95521 16.8196 5.13475 15.7332C2.36723 14.6676 0.717923 12.5865 0.138325 9.67421C0.0655762 9.30876 0.0447421 8.9334 0 8.56249C0 8.36952 0 8.1762 0 7.98323C0.00922165 7.9279 0.023908 7.87291 0.0269819 7.81724C0.0744563 6.96646 0.242495 6.13958 0.574475 5.35574C1.76475 2.54724 3.869 0.886658 6.8773 0.377418C7.1502 0.33131 7.42719 0.312184 7.70247 0.280762ZM7.98083 14.8336C11.6012 14.8428 14.5415 11.9175 14.5528 8.29472C14.5641 4.7133 11.6329 1.75623 8.06177 1.74632C4.42912 1.73608 1.47581 4.64363 1.46556 8.24076C1.45531 11.8785 4.36628 14.8243 7.98083 14.8336Z" fill="#828282"/>
                                <path d="M7.28613 6.10571C7.28613 5.37344 7.28237 4.64117 7.28784 3.9089C7.29023 3.60015 7.4487 3.37678 7.72979 3.26031C8.0102 3.14385 8.27728 3.19201 8.50475 3.39864C8.67484 3.55336 8.73529 3.75316 8.73461 3.98063C8.73154 4.85498 8.73324 5.72898 8.73324 6.60333C8.73324 7.01216 8.72675 7.42099 8.73837 7.82947C8.74076 7.9193 8.78516 8.02893 8.84766 8.09246C9.45219 8.70826 10.0649 9.31552 10.6742 9.92688C10.8781 10.1315 10.9584 10.3746 10.8781 10.6581C10.7999 10.9338 10.6148 11.1049 10.3388 11.1698C10.0885 11.2285 9.86102 11.1653 9.67966 10.9853C8.94637 10.2575 8.21717 9.52591 7.48764 8.79399C7.33463 8.64064 7.28271 8.44937 7.28374 8.23488C7.28715 7.52516 7.2851 6.81577 7.2851 6.10605H7.28647L7.28613 6.10571Z" fill="#828282"/>
                                </svg><span class="text-[#101010] opacity-50 leading-[29px] ml-3">{{date('d/m/Y', $v['ngaytao'])}}</span>
                            </p>
                            <div class="text-[#333333] leading-6">{{$v['mota'.$lang]}}</div>
                        </div>  

                    @endforeach

                </div>     

            </div>

            <div class="row">

                <div class="col-sm-12 dev-center dev-paginator">{{ $posts->render('desktop.layouts.paginator') }}</div>

            </div>

        @endif --}}

    </div>

</div>

@endsection



<!--css thêm cho mỗi trang-->

@push('css_page')

    <style type="text/css">



        #toc_container {



            background: #f9f9f9 none repeat scroll 0 0;



            border: 1px solid #f5f5f5;



            display: table;



            font-size: 95%;



            padding: 20px;



            width: 100%;



            border-radius: 10px;            



        }







        #toc_container li, #toc_container ul, #toc_container ul li{

            list-style: outside none none !important;

        }

        #toc_container li{margin-bottom:0.5rem;}





        #toc >li{margin-bottom:0.5rem;}

        #toc >li > ul{padding-left: 1rem;padding-top:0.5rem;}

        #toc >li > ul >li >ul{padding-left: 1rem;}

        #toc a{font-size:15px;color: #999; font-weight: 500;}
        #toc a:hover{color:#333;}


        @media screen and (max-width: 820px){}



    </style>

@endpush



<!--js thêm cho mỗi trang-->

@push('js_page')

    <!-- Like Share -->

    <script src="//sp.zalo.me/plugins/sdk.js"></script>



    <script src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-55e11040eb7c994c" async="async"></script>

    <script type="text/javascript">

        var addthis_config = addthis_config||{};

        addthis_config.lang = LANG

    </script>



    <script src="{{ asset('js/jquery.toc.js') }}"></script>



    <script>



        $("#toc").toc({content: "#toc-content", headings: "h2,h3,h4"});



        $('body').on('click', '#toc a', function(e) {

            e.preventDefault();



            var div  = $(this).attr('href');

            console.log($(div).offset());



            $('html, body').animate({

                scrollTop: $(div).offset().top - 20

            }, 800);

        });





        // $(window).on('load', function () {

        //     var val = $('#1._Vesti_bulum_lob_ortis_dic_tum_imp_erdiet_a');

        //     console.log(val);

        // });

        



    </script>

@endpush





@push('strucdata')

    <script type="application/ld+json">

        {

            "@context": "https://schema.org",

            "@type": "NewsArticle",

            "mainEntityOfPage":

            {

                "@type": "WebPage",

                "@id": "https://google.com/article"

            },

            "headline": "{!!$row_detail['ten'.$lang]!!}",

            "image":

            [

                "{{ (isset($row_detail['photo']))?url('/').'/'.UPLOAD_POST.$row_detail['photo']:'' }}"

            ],

            "datePublished": "{{date('Y-m-d',$row_detail['ngaytao'])}}",

            "dateModified": "{{date('Y-m-d',$row_detail['ngaysua'])}}",

            "author":

            {

                "@type": "Person",

                "name": "{!!$setting['ten'.$lang]!!}",

                "url": "{{url()->current()}}"

            },

            "publisher":

            {

                "@type": "Organization",

                "name": "Google",

                "logo":

                {

                    "@type": "ImageObject",

                    "url": "{{ (isset($logo))?url('/').'/'.UPLOAD_PHOTO.$logo['photo']:'' }}"

                }

            },

            "description": "{{SEOMeta::getDescription()}}"

        }

    </script>

@endpush