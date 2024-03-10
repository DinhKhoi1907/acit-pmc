@extends('desktop.master')

@section('element_detail','main_page_detail')
@section('page_detail','page_detail')

@section('banner')
    @include('desktop.layouts.banner')
@endsection

@section('content')
<div class="py-8 lg:py-14 content-page-layout">
	@if($video)
        <div class="flex flex-wrap gap-[30px] justify-center">
            @foreach($video as $k=>$v)
                <div class="w-[calc(100%/2-15px)] md:w-[calc(100%/3-20px)] group">
                    <a href="{{UPLOAD_PHOTO.$v['video']}}" data-fancybox="gallery" class="himg rounded-2xl cursor-pointer overflow-hidden relative after:content-[''] after:absolute after:top-0 after:left-0 after:w-[calc(100%-8px)] after:h-[calc(100%-8px)] after:border-solid after:border-4 after:rounded-2xl after:border-cmain after:z-30 after:opacity-0 group-hover:after:opacity-100 after:transition-all after:duration-300"><img class="w-auto inline-block rounded-2xl" src="{{ (isset($v['photo']))?Thumb::Crop(UPLOAD_PHOTO,$v['photo'],858,580,1):'' }}" alt="{{$v['ten'.$lang]}}" width="429" height="290"><span class="absolute group-hover:w-[200px] group-hover:h-[200px] bg-[rgba(255,255,255,0.8)] -bottom-10 -left-10 rounded-full border-solid border-4 border-cmain w-0 h-0 transition-all duration-500" style="backdrop-filter: blur(2px);">
                        <svg class="absolute top-14 right-14 z-[1]" xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24"><path fill="#0DAA70" d="M3 22v-20l18 10-18 10z"/></svg>
                    </a>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

<!--css thêm cho mỗi trang-->
@push('css_page')
	
@endpush

<!--js thêm cho mỗi trang-->
@push('js_page')

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
                "{{ (isset($row_detail['photo']))?url('/').'/'.UPLOAD_STATICPOST.$row_detail['photo']:'' }}"
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