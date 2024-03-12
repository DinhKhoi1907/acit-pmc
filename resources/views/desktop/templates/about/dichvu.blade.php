<div class="relative section-dichvu overflow-hidden">
  <div class="hinhtron"></div>
  <div class="content-page-layout py-16">
      <div class="dichvu-title mx-10 revealOnScroll" data-animation="animate__fadeInUp">
          <h1>Dịch vụ</h1>
          <p class="text-center">{{ $seopage_static['dichvu']['mota' . $lang] }}</p>
      </div>
      <div class="dichvu__owl owl-carousel owl-theme mt-10">
          @foreach ($dichvu_nb as $k => $v)
              <div class="relative overflow-hidden group revealOnScroll cursor-pointer bg-white shadow-md rounded-[10px] card-nb border border-solid border-cmain dichvu-card"
                  data-animation="animate__fadeInUp" data-timeout="{{ ($k + 1) * 200 }}">
                  <a href="dich-vu">
                      <div class="px-7 py-[37px]">
                          <h1 class="text-xl font-bold uppercase text-black mb-6">{{ $v['ten' . $lang] }}</h1>
                          <p class="text-[16px] leading-[160%] text-black mb-5 text-split-6">{{ $v['mota' . $lang] }}
                          </p>
                          <button
                              class="mt-auto py-[10px] px-5 bg-cmain border-0 rounded-md flex items-center cursor-pointer transition-all duration-700">
                              <span
                                  class="text-[16px] font-[Roboto] text-white font-extrabold leading-[24px] tracking-[2px] uppercase">Xem
                                  chi tiết</span>
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                  viewBox="0 0 24 24" fill="none">
                                  <path
                                      d="M15.586 10.657L11.636 6.70704C11.4538 6.51844 11.353 6.26584 11.3553 6.00364C11.3576 5.74144 11.4628 5.49063 11.6482 5.30522C11.8336 5.11981 12.0844 5.01465 12.3466 5.01237C12.6088 5.01009 12.8614 5.11088 13.05 5.29304L18.707 10.95C18.8002 11.0427 18.8741 11.1529 18.9246 11.2742C18.9751 11.3955 19.001 11.5256 19.001 11.657C19.001 11.7884 18.9751 11.9186 18.9246 12.0399C18.8741 12.1612 18.8002 12.2714 18.707 12.364L13.05 18.021C12.9578 18.1166 12.8474 18.1927 12.7254 18.2451C12.6034 18.2976 12.4722 18.3251 12.3394 18.3263C12.2066 18.3274 12.0749 18.3021 11.952 18.2519C11.8291 18.2016 11.7175 18.1273 11.6236 18.0334C11.5297 17.9395 11.4555 17.8279 11.4052 17.705C11.3549 17.5821 11.3296 17.4504 11.3307 17.3176C11.3319 17.1849 11.3595 17.0536 11.4119 16.9316C11.4643 16.8096 11.5405 16.6993 11.636 16.607L15.586 12.657H6C5.73478 12.657 5.48043 12.5517 5.29289 12.3641C5.10536 12.1766 5 11.9223 5 11.657C5 11.3918 5.10536 11.1375 5.29289 10.9499C5.48043 10.7624 5.73478 10.657 6 10.657H15.586Z"
                                      fill="white" />
                              </svg>
                          </button>
                      </div>
                  </a>
              </div>
          @endforeach
      </div>
  </div>
</div>



@push('css_page')
  <style>
      .hinhtron {
          position: absolute;
          top: -275px;
          left: -230px;
          width: 754px;
          height: 720px;
          background-color: #3498db;
          border-radius: 50%;
          opacity: 0.5;
      }

      .dichvu-title {
          display: flex;
          flex-direction: column;
          justify-content: center;
          align-items: center;
          gap: 17px;
      }

      .dichvu-title h1 {
          text-align: center;
          font-size: 32px;
          font-weight: 700;
          line-height: 110%;
          text-transform: uppercase;
          background: linear-gradient(159deg, #39B54A 2.34%, #076C40 82.55%);
          background-clip: text;
          -webkit-background-clip: text;
          -webkit-text-fill-color: transparent;
      }

      @media screen and (max-width: 768px) {
          .dichvu-title h1 {
              font-size: 24px;
          }
      }

      .dichvu-card:hover {
          border: 1px solid #D93832;
          border-radius: 10px;
      }

      .dichvu-card:hover h1 {
          color: #D93832;
      }

      .dichvu-card:hover button {
          background: #D93832;
      }
  </style>
@endpush

@push('js_page')
  <script>
      if ($(".dichvu__owl").exists()) {
          var owl_list_service = $('.dichvu__owl');
          owl_list_service.owlCarousel({
              autoplay: false,
              margin: 20,
              items: 5,
              dots: false,
              autoplayHoverPause: true,
              autoplaySpeed: 3000,
              autoplayTimeout: 2000,
              smartSpeed: 3000,
              //smartSpeed: 2000,
              loop: true,
              responsive: {
                  0: {
                      items: 1,
                      margin: 40,
                      stagePadding: 30,
                  },

                  600: {
                      items: 2,
                      margin: 20,
                      stagePadding: 20,
                  },

                  750: {
                      items: 2,
                      margin: 15,
                      stagePadding: 20,
                  },
                  1028: {
                      items: 3,
                      spaceBetween: 20,
                      nav: true,
                      navText: [
                          "<button class='arrow-left-service'><i class='fas fa-arrow-left'></i></button>",
                          "<button class='arrow-right-service'><i class='fas fa-arrow-right'></i></button>"
                      ]
                  }
              }
          });
      }
  </script>
@endpush
