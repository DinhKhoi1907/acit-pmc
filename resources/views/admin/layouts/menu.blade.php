<div class="sidebar">
  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
      <li class="nav-item {{ (isset($request) && Helper::GetPrefixAdmin($request)=='dashboard') ? 'menu-open' : '' }}">
        <a href="{{route('admin.dashboard')}}" class="nav-link">
          <i class="nav-icon fas fa-chart-line"></i>          
          <p>Bảng điều khiển</p>
        </a>
      </li>

      @if(config('config_all.order.active')==true)
        <li class="nav-item has-treeview {{ (isset($request) && Helper::GetPrefixAdmin($request)=='order') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fal fa-clipboard-list"></i>
              <p>Giỏ hàng <i class="right fal fa-chevron-right"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('admin.order.show',['man'])}}" class="nav-link {{ (isset($request) && $request->category=='man' && Helper::GetPrefixAdmin($request)=='order') ? 'active' : '' }}">
                    <i class="text-xs nav-icon fas fa-dot-circle"></i>
                    <p>Danh sách đơn hàng</p>
                  </a>
                </li>
            </ul>
        </li>
      @endif


      @if(config('config_all.coupon.active')==true)
        <li class="nav-item has-treeview {{ (isset($request) && Helper::GetPrefixAdmin($request)=='coupon') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-pager"></i>
              <p>Quản lý Voucher <i class="right fal fa-chevron-right"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('admin.coupon.show',['man','coupon_all'])}}" class="nav-link {{ (isset($request) && $request->type=='coupon_all' && $request->category=='man' && Helper::GetPrefixAdmin($request)=='coupon') ? 'active' : '' }}">
                    <i class="text-xs nav-icon fas fa-dot-circle"></i>
                    <p>Danh sách voucher</p>
                  </a>
                </li>
            </ul>
        </li>
      @endif


      @if(count(config('config_type.product'))>0)
        @foreach(config('config_type.product') as $key => $value)
          @if(isset($value) && (isset($value['dropdown']) && $value['dropdown']==true) && $key!='shownews')
          <li class="nav-item has-treeview {{ (isset($request) && (Helper::GetPrefixAdmin($request)=='product' || Helper::GetPrefixAdmin($request)=='size' || Helper::GetPrefixAdmin($request)=='color') && in_array($type, Helper::GetArrayType(config('config_type.product'))) && !in_array($type, Helper::GetArrayType(config('config_type.product.shownews'))) || (isset($request) && isset($type) && Helper::GetPrefixAdmin($request)=='category' && $key==$type) ) ? 'menu-open' : '' }}">                
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-layer-group"></i>
              <p>Quản lý {{ $value['title_main'] }}<i class="right fal fa-chevron-right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              @if(in_array($key, Helper::GetArrayType(config('category'))))
              <li class="nav-item">
                <a href="{{route('admin.category.show',[$key])}}" class="nav-link {{ (isset($request) && $key==$request->type && Helper::GetPrefixAdmin($request)=='category') ? 'active' : '' }}">
                  <i class="text-xs nav-icon fas fa-dot-circle"></i>
                  <p>{{config('category')[$key]['title_main_category']}}</p>
                </a>
              </li>
              @endif

              @if(isset($value['display']) && $value['display']==true)
              <li class="nav-item">
                <a href="{{route('admin.product.show',['man',$key])}}" class="nav-link {{ (isset($request) && $request->category=='man' && $key==$request->type && Helper::GetPrefixAdmin($request)=='product') ? 'active' : '' }}">
                  <i class="text-xs nav-icon fas fa-dot-circle"></i>
                  <p>{{ $value['title_main'] }}</p>
                </a>
              </li>
              @endif

              @if(isset($value['brand']) && $value['brand'] == true)
                  <li class="nav-item">
                      <a href="{{route('admin.brand.show',['man',$key])}}" class="nav-link {{ (isset($request) && $request->category=='man' && $key==$request->type && Helper::GetPrefixAdmin($request)=='brand') ? 'active' : '' }}" title="Danh mục Nhà cung cấp"><i class="text-xs nav-icon fas fa-dot-circle"></i><p>Danh mục Nhà cung cấp</p></a>
                  </li>
              @endif

              @if(isset($value['mau']) && $value['mau'] == true)
                  <li class="nav-item">
                      <a href="{{route('admin.color.show',['man',$key])}}" class="nav-link {{ (isset($request) && $request->category=='man' && $key==$request->type && Helper::GetPrefixAdmin($request)=='color') ? 'active' : '' }}" title="Danh mục màu sắc"><i class="text-xs nav-icon fas fa-dot-circle"></i><p>Danh mục màu sắc</p></a>
                  </li>
              @endif

              @if(isset($value['size']) && $value['size'] == true)
                  {{-- <li class="nav-item">
                      <a href="{{route('admin.size.show',['man',$key])}}" class="nav-link {{ (isset($request) && $request->category=='man' && $key==$request->type && Helper::GetPrefixAdmin($request)=='size') ? 'active' : '' }}" title="Phân loại lớp"><i class="text-xs nav-icon fas fa-dot-circle"></i><p>Phân loại lớp</p></a>
                  </li> --}}
              @endif

            </ul>
          </li>
          @endif
        @endforeach
        

        @if(config('config_type.product.shownews'))
          <li class="nav-item has-treeview {{ (isset($request) && (Helper::GetPrefixAdmin($request)=='product' || Helper::GetPrefixAdmin($request)=='size' || Helper::GetPrefixAdmin($request)=='color') && in_array($type, Helper::GetArrayType(config('config_type.product.shownews'))) ) ? 'menu-open' : '' }}">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-newspaper"></i>
                <p>Quản lý sản phẩm khác<i class="right fal fa-chevron-right"></i></p>
              </a>
              <ul class="nav nav-treeview">
                @foreach(config('config_type.product.shownews') as $key => $value)
                <li class="nav-item">
                  <a href="{{route('admin.product.show',['man',$key])}}" class="nav-link {{ (isset($request) && $request->category=='man' && $key==$request->type && Helper::GetPrefixAdmin($request)=='product') ? 'active' : '' }}">
                    <i class="text-xs nav-icon fas fa-dot-circle"></i>
                    <p>{{ $value['title_main'] }}</p>
                  </a>
                </li>
                @endforeach
              </ul>
          </li>
        @endif
      @endif
      

      @if(config('lazada.active'))
      <li class="nav-item has-treeview {{ (isset($request) && Helper::GetPrefixAdmin($request)=='lazada') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-dumpster"></i>
            <p>Quản lý kho<i class="right fal fa-chevron-right"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{route('admin.lazada.show',['man','product'])}}" class="nav-link {{ (isset($request) && $request->category=='man' && $request->type=='product' && Helper::GetPrefixAdmin($request)=='lazada') ? 'active' : '' }}" title="Đồng bộ Lazada"><i class="text-xs nav-icon fas fa-dot-circle"></i><p>Đồng bộ sản phẩm Lazada</p></a>
            </li>
            <li class="nav-item">
                <a href="{{route('admin.lazada.inventory',['man','nhapkho'])}}" class="nav-link {{ (isset($request) && $request->category=='man' && $request->type=='nhapkho' && Helper::GetPrefixAdmin($request)=='lazada') ? 'active' : '' }}" title="Quản lý nhập kho"><i class="text-xs nav-icon fas fa-dot-circle"></i><p>Quản lý nhập kho</p></a>
            </li>
            <li class="nav-item">
                <a href="{{route('admin.lazada.inventory',['man','xuatkho'])}}" class="nav-link {{ (isset($request) && $request->category=='man' && $request->type=='xuatkho' && Helper::GetPrefixAdmin($request)=='lazada') ? 'active' : '' }}" title="Quản lý xuất kho"><i class="text-xs nav-icon fas fa-dot-circle"></i><p>Quản lý xuất kho</p></a>
            </li>
          </ul>
      </li>
      @endif


      @if(config('config_type.tags'))
        <li class="nav-item has-treeview {{ (isset($request) && Helper::GetPrefixAdmin($request)=='tags' && in_array($type, Helper::GetArrayType(config('config_type.tags'))) ) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tags"></i>
              <p>Quản lý tags <i class="right fal fa-chevron-right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              @foreach(config('config_type.tags') as $key => $value)
              <li class="nav-item">
                <a href="{{route('admin.tags.show',['man',$key])}}" class="nav-link {{ (isset($request) && $request->category=='man' && $key==$request->type && Helper::GetPrefixAdmin($request)=='tags') ? 'active' : '' }}">
                  <i class="text-xs nav-icon fas fa-dot-circle"></i>
                  <p>{{ $value['title_main'] }}</p>
                </a>
              </li>
              @endforeach
            </ul>
        </li>
      @endif


      @foreach(config('config_type.post') as $key => $value)
        @if(isset($value) && (isset($value['dropdown']) && $value['dropdown']==true) && $key!='shownews')
        <li class="nav-item has-treeview {{ (isset($request) && Helper::GetPrefixAdmin($request)=='post' && in_array($type, Helper::GetArrayType(config('config_type.post'))) && !in_array($type, Helper::GetArrayType(config('config_type.post.shownews'))) || (isset($request) && isset($type) && Helper::GetPrefixAdmin($request)=='category' && $key==$type) ) ? 'menu-open' : '' }}"> 
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-newspaper"></i>
            <p>Quản lý {{ $value['title_main'] }}<i class="right fal fa-chevron-right"></i></p>
          </a>
          <ul class="nav nav-treeview">
            @if(in_array($key, Helper::GetArrayType(config('category'))))
            <li class="nav-item">
              <a href="{{route('admin.category.show',[$key])}}" class="nav-link {{ (isset($request) && $key==$request->type && Helper::GetPrefixAdmin($request)=='category') ? 'active' : '' }}">
                <i class="text-xs nav-icon fas fa-dot-circle"></i>
                <p>{{config('category')[$key]['title_main_category']}}</p>
              </a>
            </li>
            @endif

            <li class="nav-item">
              <a href="{{route('admin.post.show',['man',$key])}}" class="nav-link {{ (isset($request) && $request->category=='man' && $key==$request->type && Helper::GetPrefixAdmin($request)=='post') ? 'active' : '' }}">
                <i class="text-xs nav-icon fas fa-dot-circle"></i>
                <p>{{ $value['title_main'] }}</p>
              </a>
            </li>
          </ul>
        </li>
        @endif
      @endforeach


      @if(config('config_type.post.shownews'))
        <li class="nav-item has-treeview {{ (isset($request) && Helper::GetPrefixAdmin($request)=='post' && in_array($type, Helper::GetArrayType(config('config_type.post.shownews'))) ) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-newspaper"></i>
              <p>Quản lý bài viết<i class="right fal fa-chevron-right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              @foreach(config('config_type.post.shownews') as $key => $value)
                <li class="nav-item">
                  <a href="{{route('admin.post.show',['man',$key])}}" class="nav-link {{ (isset($request) && $request->category=='man' && $key==$request->type && Helper::GetPrefixAdmin($request)=='post') ? 'active' : '' }}">
                    <i class="text-xs nav-icon fas fa-dot-circle"></i>
                    <p>{{ $value['title_main'] }}</p>
                  </a>
                </li>
              @endforeach
            </ul>
        </li>
      @endif

      @foreach(config('config_type.album') as $key => $value)
        @if(isset($value) && (isset($value['dropdown']) && $value['dropdown']==true) && $key!='shownews')
        <li class="nav-item has-treeview {{ (isset($request) && in_array($type, Helper::GetArrayType(config('config_type.album'))) && !in_array($type, Helper::GetArrayType(config('config_type.album.shownews'))) || (isset($request) && isset($type) && Helper::GetPrefixAdmin($request)=='category' && $key==$type) ) ? 'menu-open' : '' }}">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-image"></i>
            <p>Quản lý {{ $value['title_main'] }}<i class="right fal fa-chevron-right"></i></p>
          </a>
          <ul class="nav nav-treeview">
            @if(in_array($key, Helper::GetArrayType(config('category'))))
            <li class="nav-item">
              <a href="{{route('admin.category.show',[$key])}}" class="nav-link {{ (isset($request) && $key==$request->type && Helper::GetPrefixAdmin($request)=='category') ? 'active' : '' }}">
                <i class="text-xs nav-icon fas fa-dot-circle"></i>
                <p>{{config('category')[$key]['title_main_category']}}</p>
              </a>
            </li>
            @endif

            <li class="nav-item">
              <a href="{{route('admin.album.show',['man',$key])}}" class="nav-link {{ (isset($request) && $request->category=='man' && $key==$request->type && Helper::GetPrefixAdmin($request)=='album') ? 'active' : '' }}">
                <i class="text-xs nav-icon fas fa-dot-circle"></i>
                <p>{{ $value['title_main'] }}</p>
              </a>
            </li>
          </ul>
        </li>
        @endif
      @endforeach


      @if(config('config_type.album.shownews'))
        <li class="nav-item has-treeview {{ (isset($request) && in_array($type, Helper::GetArrayType(config('config_type.album.shownews'))) && !in_array($type, Helper::GetArrayType(config('config_type.album.shownews'))) ) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-newspaper"></i>
              <p>Quản lý bộ sưu tập <i class="right fal fa-chevron-right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              @foreach(config('config_type.album.shownews') as $key => $value)
              <li class="nav-item">
                <a href="{{route('admin.album.show',['man',$key])}}" class="nav-link {{ (isset($request) && $request->category=='man' && $key==$request->type && Helper::GetPrefixAdmin($request)=='album') ? 'active' : '' }}">
                  <i class="text-xs nav-icon fas fa-dot-circle"></i>
                  <p>{{ $value['title_main'] }}</p>
                </a>
              </li>
              @endforeach
            </ul>
        </li>
      @endif


      <li class="nav-item has-treeview {{ (isset($request) && in_array($type, Helper::GetArrayType(config('config_type.staticpost'))) ) ? 'menu-open' : '' }}">
        <a class="nav-link" href="#" title="Quản lý trang tĩnh">
            <i class="nav-icon fas fa-bookmark"></i>
            <p>
                Quản lý Trang tĩnh - Mô tả
                <i class="right fal fa-chevron-right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @foreach(config('config_type.staticpost') as $key => $value)
            <li class="nav-item ">
                <a class="nav-link {{ (isset($request) && $key==$type && Helper::GetPrefixAdmin($request)=='staticpost') ? 'active' : '' }}" href="{{route('admin.staticpost.show',['man',$key])}}" title=""><i class="text-xs nav-icon fas fa-dot-circle"></i><p>{{ $value['title_main'] }}</p></a>
                </li>
            @endforeach
        </ul>
      </li>

      <li class="nav-item has-treeview {{ (isset($request) && Helper::GetPrefixAdmin($request)=='photo' && in_array($type, Helper::GetArrayType(config('config_type.photo'))) ) ? 'menu-open' : '' }}">
          <a class="nav-link" href="#" title="Quản lý hình ảnh - video">
              <i class="nav-icon fas fa-photo-video"></i>
              <p>
                  Quản lý hình ảnh
                  <i class="right fal fa-chevron-right"></i>
              </p>
          </a>

          <ul class="nav nav-treeview">
            @foreach(config('config_type.photo') as $key => $value)
              @if(!isset($value['watermark']) || (isset($value['watermark']) && $value['watermark']) )
                <li class="nav-item">
                    <a class="nav-link {{ (isset($request) && $key==$type && Helper::GetPrefixAdmin($request)=='photo') ? 'active' : '' }}" href="{{route('admin.photo.show',[$value['category'],$key])}}" title=""><i class="text-xs nav-icon fas fa-dot-circle"></i><p></p>{{ $value['title_main'] }}</a>
                </li>              
              @endif
            @endforeach
          </ul>
      </li>

      @if(config('config_all.places')==true)
          <li class="nav-item has-treeview {{ (isset($request) && Helper::GetPrefixAdmin($request)=='places') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-building"></i>
              <p>Quản lý địa điểm <i class="right fal fa-chevron-right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.places.show',['list'])}}" class="nav-link {{ (isset($request) && $request->category=='list' && Helper::GetPrefixAdmin($request)=='places') ? 'active' : '' }}">
                  <i class="text-xs nav-icon fas fa-dot-circle"></i>
                  <p>Tỉnh thành</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('admin.places.show',['cat'])}}" class="nav-link {{ (isset($request) && $request->category=='cat' && Helper::GetPrefixAdmin($request)=='places') ? 'active' : '' }}">
                  <i class="text-xs nav-icon fas fa-dot-circle"></i>
                  <p>Quận huyện</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('admin.places.show',['item'])}}" class="nav-link {{ (isset($request) && $request->category=='item' && Helper::GetPrefixAdmin($request)=='places') ? 'active' : '' }}">
                  <i class="text-xs nav-icon fas fa-dot-circle"></i>
                  <p>Phường xã</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('admin.places.show',['man'])}}" class="nav-link {{ (isset($request) && $request->category=='man' && Helper::GetPrefixAdmin($request)=='places') ? 'active' : '' }}">
                  <i class="text-xs nav-icon fas fa-dot-circle"></i>
                  <p>Đường</p>
                </a>
              </li>
            </ul>
          </li>
      @endif

      @if(config('config_type.newsletter'))
        <li class="nav-item has-treeview {{ (isset($request) && in_array($type, Helper::GetArrayType(config('config_type.newsletter'))) && in_array($type, Helper::GetArrayType(config('config_type.newsletter'))) ) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-envelope-open-text"></i>
              <p>Quản lý đăng ký email <i class="right fal fa-chevron-right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              @foreach(config('config_type.newsletter') as $key => $value)
              <li class="nav-item">
                <a href="{{route('admin.newsletter.show',['man',$key])}}" class="nav-link {{ (isset($request) && $request->category=='man' && $key==$request->type && Helper::GetPrefixAdmin($request)=='newsletter') ? 'active' : '' }}">
                  <i class="text-xs nav-icon fas fa-dot-circle"></i>
                  <p>{{ $value['title_main'] }}</p>
                </a>
              </li>
              @endforeach
            </ul>
        </li>
      @endif

      <li class="nav-item has-treeview {{ (isset($request) && Helper::GetPrefixAdmin($request)=='seopage' && in_array($type, Helper::GetArrayType(config('config_type.seopage'))) ) ? 'menu-open' : '' }}">
        <a class="nav-link" href="#" title="Quản lý seo page">
            <i class="nav-icon fas fa-bookmark"></i>
            <p>
                Quản lý SEO page
                <i class="right fal fa-chevron-right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @foreach(config('config_type.seopage') as $key => $value)
            <li class="nav-item ">
                <a class="nav-link {{ (isset($request) && $key==$type && Helper::GetPrefixAdmin($request)=='seopage') ? 'active' : '' }}" href="{{route('admin.seopage.show',['man',$key])}}" title=""><i class="text-xs nav-icon fas fa-dot-circle"></i><p>{{ $value['title_main'] }}</p></a>
                </li>
            @endforeach
        </ul>
      </li>

      @if(config('config_all.question.active')==true)
        <li class="nav-item {{ (isset($request) && Helper::GetPrefixAdmin($request)=='question') ? 'menu-open' : '' }}">
          <a href="{{route('admin.question.show',['man'])}}" class="nav-link ">
            <i class="nav-icon fas fa-comments"></i>
            <p>Quản lý hỏi đáp</p>
          </a>
        </li>
      @endif

      <li class="nav-item {{ (isset($request) && in_array($type, Helper::GetArrayType(config('config_type.setting'))) && Helper::GetPrefixAdmin($request)=='setting') ? 'menu-open' : '' }}">
        <a href="{{route('admin.setting.show',['man','setting'])}}" class="nav-link">
          <i class="nav-icon fas fa-cogs"></i>
          <p>Thiết lập thông tin</p>
        </a>
      </li>

      @if(config('config_all.menus')==true)
        <li class="nav-item {{ (isset($request) && Helper::GetPrefixAdmin($request)=='menu') ? 'menu-open' : '' }}">
          <a href="{{route('admin.menu.index')}}" class="nav-link">
            <i class="nav-icon fas fa-bars"></i>
            <p>Cấu hình menu</p>
          </a>
        </li>
      @endif

      @if(config('config_all.fileupload')==true)
        <li class="nav-item {{ (isset($request) && Helper::GetPrefixAdmin($request)=='gallery') ? 'menu-open' : '' }}">
          <a href="{{route('admin.gallery.fileupload')}}" class="nav-link">
            <i class="nav-icon fas fa-file-upload"></i>
            <p>Thư viện hình ảnh</p>
          </a>
        </li>
      @endif

    </ul>
  </nav>
  <!-- /.sidebar-menu -->
</div>
