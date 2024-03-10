@extends('desktop.master')



<div id="container">

    {{-- <p>Real 3D Flipbook has lightbox feature - book can be displayed in the same page with lightbox effect.</p>

    <p>Click on a book cover to start reading.</p> --}}

    <img src="images/book2/thumb1.jpg" />

    <input type="hidden" value="{{UPLOAD_FILE.$row_detail['taptin']}}" id="catalogue-file">

</div>





@push('css_page')

<link rel="stylesheet" href="css/flipbook.style.css">

{{-- <link rel="stylesheet" href="css/font-awesome.css"> --}}

@endpush





@push('js_page')
<script src="js/flipbook.min.js"></script>
<script>
    $(document).ready(function () {
        var file = $('#catalogue-file').val();
        $("#container").flipBook({
            pdfUrl:file,
            btnDownloadPages:{
                enabled: false,
            },
            btnDownloadPdf:{
                forceDownload: true
            }
        });
    })
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