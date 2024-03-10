@extends('desktop.master')

@section('element_detail','main_page_detail')
@section('page_detail','page_detail')

@section('banner')
    @include('desktop.layouts.banner')
@endsection

@section('content')
<div class="py-8 lg:py-14 bg-cmain3 bor-none">
	<div class="content-page-layout">
        <p class="capitalize text-cmain font-bold text-center text-4xl md:text-6xl">Place your order easily</p>
        <p class="text-center text-cmain font-semibold text-2xl my-5">How it works ?</p>
        <div class="flex items-center justify-between my-10 content-layout-other flex-wrap gap-y-10">
            <div class="flex flex-col items-center w-2/4 md:w-1/4">
                <i class="fas fa-folder-plus text-4xl"></i>
                <p class="mt-2 font-semibold text-cmain text-xl">Join Our Folder</p>
            </div>
            <div class="flex flex-col items-center w-2/4 md:w-1/4">
                <i class="fas fa-file-upload text-4xl"></i>
                <p class="mt-2 font-semibold text-cmain text-xl">Upload Images</p>
            </div>
            <div class="flex flex-col items-center w-2/4 md:w-1/4">
                <i class="fas fa-clipboard-list text-4xl"></i>
                <p class="mt-2 font-semibold text-cmain text-xl">Instructions/Survey</p>
            </div>
            <div class="flex flex-col items-center w-2/4 md:w-1/4">
                <i class="far fa-images text-4xl"></i>
                <p class="mt-2 font-semibold text-cmain text-xl">Get Final Images</p>
            </div>
        </div>
        <p class="text-center text-cmain font-semibold text-2xl my-5">Who are you ?</p>
        <div class="content-layout-other flex items-center justify-center gap-5">            
            <a datae="#client" class="scroll-btn bg-cmain2 text-white text-xl md:text-2xl capitalize rounded-md px-5 py-2 w-[275px] text-center hover:bg-cmain hover:text-white">Existing Client</a>
            <a datae="#trial" class="scroll-btn bg-cmain2 text-white text-xl md:text-2xl capitalize rounded-md px-5 py-2 w-[275px] text-center hover:bg-cmain hover:text-white">Free Trial Client</a>
        </div>
    </div>
</div>


@if($category)
<div class="bg-white py-8 lg:py-14 bor-none" id="client">
    <div class="content-page-layout">
        <p class="capitalize text-cmain font-semibold text-center text-3xl md:text-5xl mb-5">Existing Client</p>
        @if($client)
            <div class="leading-6 text-base">{!! $client['noidung'.$lang] !!}</div>
        @endif

        <form class="mt-8" method="post" action="{{ route('sendClient') }}">
            @csrf
            <input type="hidden" name="type" value="client" />
            <div class="flex flex-wrap gap-0 gap-y-5 sm:gap-[30px] lg:gap-10">
                @foreach($category as $k=>$v)
                    <div class="w-full sm:w-[calc(100%/2-15px)] lg:w-[calc(100%/3-27px)] border border-solid border-gray-200 rounded-lg bg-cmain3">
                        <p class="text-center capitalize text-cmain font-semibold text-xl p-3 border-0 border-b border-solid border-gray-200 mb-3">{{$v['ten'.$lang]}}</p>
                        <div class="content-detail-css px-7 min-h-[135px]">{!! $v['noidung'.$lang] !!}</div>
                        <div class="mt-5 px-2 mb-2">
                            <input type="text" placeholder="Name" value="" name="ten[]" class="w-full rounded-md border border-solid border-gray-300 placeholder:font-el mb-2">
                            <input type="email" placeholder="Email" value="" name="email[]" class="w-full rounded-md border border-solid border-gray-300 placeholder:font-el mb-2">
                            <input type="text" placeholder="Company's name" value="" name="congty[]" class="w-full rounded-md border border-solid border-gray-300 placeholder:font-el mb-2">
                            <input type="hidden" placeholder="" value="{{$v['ten'.$lang]}}" name="service[]" class="w-full rounded-md border border-solid border-gray-300 placeholder:font-el mb-2">
                        </div>
                    </div>
                @endforeach
            </div>
            <p class="text-center mt-4"><button type="submit" class="inline-flex items-center justify-center py-2 cursor-pointer bg-cmain2 text-cmain font-bold text-xl border-0 rounded-md min-w-[135px] min-h-[35px]" name="submit-contact">Send <svg class="ml-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 0l-6 22-8.129-7.239 7.802-8.234-10.458 7.227-7.215-1.754 24-12zm-15 16.668v7.332l3.258-4.431-3.258-2.901z"/></svg></button></p>
        </form>
    </div>
</div>
@endif


<div class="bg-cmain3 py-8 lg:py-14 bor-none" id="trial">
    <div class="content-page-layout">
        <p class="capitalize text-cmain font-semibold text-center text-3xl md:text-5xl mb-5">Free Trial Client</p>
        @if($trial)
            <div class="leading-6 text-base">{!! $trial['noidung'.$lang] !!}</div>
        @endif
        <div class="mt-8" >
            {{-- <form id="frm_contact" class="form-contact frm_check_recaptcha //frm_newsletter validation-contact" novalidate method="post" action="{{ route('sendContact') }}">
                @csrf
                <input type="hidden" name="type" value="trial" />
                <div class="flex gap-2 justify-between">
                    <input type="text" placeholder="Name" value="" class="w-[calc(50%-4px)] rounded-md border border-solid border-gray-300 placeholder:font-el mb-3">
                    <input type="email" placeholder="Email" value="" class="w-[calc(50%-4px)] rounded-md border border-solid border-gray-300 placeholder:font-el mb-3">
                </div>
                <select name="service" class="w-full rounded-md border border-solid border-gray-300 placeholder:font-el mb-3">
                    <option value="0">Service...</option>
                    @foreach($category as $k=>$v)
                    <option value="{{$v['ten'.$lang]}}">{{$v['ten'.$lang]}}</option>
                    @endforeach
                </select>
                <input type="text" placeholder="Link: website, facebook, instagram,..." value="" class="w-full rounded-md border border-solid border-gray-300 placeholder:font-el mb-3">
                <input type="text" placeholder="Link of the photos" value="" class="w-full rounded-md border border-solid border-gray-300 placeholder:font-el mb-3">
                <textarea class="w-full rounded-md border border-solid border-gray-300 placeholder:font-el mb-3" id="noidung" rows="8" name="noidung" placeholder="Message"></textarea>
                <p class="text-center mt-4"><button type="submit" class="inline-flex items-center justify-center py-2 cursor-pointer bg-cmain2 text-cmain font-bold text-xl border-0 rounded-md min-w-[135px] min-h-[35px]" name="submit-contact" disabled>Send <svg class="ml-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 0l-6 22-8.129-7.239 7.802-8.234-10.458 7.227-7.215-1.754 24-12zm-15 16.668v7.332l3.258-4.431-3.258-2.901z"/></svg></button></p>
            </form> --}}

            <form id="frm_inquyri" class="frm-css form-contact frm_check_recaptcha //frm_newsletter validation-contact" novalidate method="post" action="{{ route('sendContact') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="type" value="trial" />
                <div class="flex flex-wrap gap-0 sm:gap-2 justify-between">
                    <div class="input-contact w-full sm:w-[calc(50%-4px)] mb-3">
                        {{-- <span class="block mb-2 text-sm label title-contact text-cmain5 font-bold"><strong class="mr-1 font-normal">*</strong>Your name</span> --}}
                        <label for="ten" class="inp">
                            <input type="text" class="form-control rounded-md border border-solid border-gray-300 placeholder:font-el" name="ten" id="ten" placeholder="Your name (*)" required>
                            <span class="label title-contact"></span>
                            <span class="focus-bg"></span>
                            <div class="invalid-feedback">Enter your name, please!</div>
                        </label>
                    </div>
                    <div class="input-contact w-full sm:w-[calc(50%-4px)] mb-3">
                        {{-- <span class="block mb-2 text-sm label title-contact text-cmain5 font-bold"><strong class="mr-1 font-normal">*</strong>Your email</span> --}}
                        <label for="email" class="inp">
                            <input type="email" class="form-control rounded-md border border-solid border-gray-300 placeholder:font-el" name="email" id="email" placeholder="Your email (*)" required>
                            <span class="label title-contact"></span>
                            <span class="focus-bg"></span>
                            <div class="invalid-feedback">Enter your email, please!</div>
                        </label>                                        
                    </div>
                </div>
                <div class="input-contact mb-3">
                    <label for="link" class="inp">
                        <input type="text" class="form-control rounded-md border border-solid border-gray-300 placeholder:font-el" name="link" id="link" placeholder="Link: website, facebook, instagram,...">
                        <span class="label title-contact"></span>
                        <span class="focus-bg"></span>
                        <div class="invalid-feedback">Enter your link, please!</div>
                    </label>
                </div>
                <div class="input-contact mb-3">
                    <label for="linkphoto" class="inp">
                        <input type="text" class="form-control rounded-md border border-solid border-gray-300 placeholder:font-el" name="linkphoto" id="linkphoto" placeholder="Link of the photos">
                        <span class="label title-contact"></span>
                        <span class="focus-bg"></span>
                        <div class="invalid-feedback">Enter your link of the photos, please!</div>
                    </label>
                </div>
                <div class="w-full">
                    <label for="noidung" class="inp h-full">
                        <textarea class="form-control w-full rounded-md border border-solid border-gray-300 placeholder:font-el mb-3" id="noidung" rows="8" name="noidung" placeholder="Please put your message here..."></textarea>
                        <span class="label"></span>
                        <span class="focus-bg"></span>
                        <div class="invalid-feedback"></div>
                    </label>
                </div>
                <p class="text-center mt-4">
                    <button type="submit" class="inline-flex items-center justify-center py-2 cursor-pointer bg-cmain2 text-cmain font-bold text-xl border-0 rounded-md min-w-[135px] min-h-[35px]" name="submit-contact" disabled>Send <svg class="ml-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 0l-6 22-8.129-7.239 7.802-8.234-10.458 7.227-7.215-1.754 24-12zm-15 16.668v7.332l3.258-4.431-3.258-2.901z"/></svg></button>
                </p>
            </form>
        </div>
    </div>
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