<div id="toc_container" class="mb-5">

    <p
        class="flex items-center pb-2 mb-4 text-2xl font-medium border-0 border-b border-solid border-cmain2 border-opacity-30 toc_title text-cmain2">
        {{ __('Mục lục') }}
    </p>

    <ul id="toc"></ul>

</div>


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


        #toc_container li,
        #toc_container ul,
        #toc_container ul li {

            list-style: outside none none !important;

        }

        #toc_container li {
            margin-bottom: 0.5rem;
        }

        #toc>li {
            margin-bottom: 0.7rem;
        }

        #toc>li>ul {
            padding-left: 1rem;
            padding-top: 0.5rem;
        }

        #toc>li>ul>li>ul {
            padding-left: 1rem;
        }

        #toc a {
            font-size: 14px;
            color: #444;
            font-weight: 500;
        }

        #toc a:hover {
            color: #333;
        }


        @media screen and (max-width: 820px) {}
    </style>
@endpush

@push('js_page')
    <script src="{{ asset('js/jquery.toc.js') }}"></script>
    <script>
        $("#toc").toc({
            content: "#toc-content",
            headings: "h2,h3,h4"
        });
        $('body').on('click', '#toc a', function(e) {
            e.preventDefault();
            var div = $(this).attr('href');
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
