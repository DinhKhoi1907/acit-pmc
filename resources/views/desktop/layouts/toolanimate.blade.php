@php
  $tool  = app('mangxahoi');
@endphp
<div id='arcontactus'>
  <div class="arcontactus-element">
    <div class="arcontactus-tutorial w-[70px] h-[70px] fixed top-[100px] right-[calc(50%-70px/2)] z-10 ">
        <div class="w-full h-full bg-black rounded-full arcontactus-tutorial-circle">
            <div class="absolute top-[-5px] right-[1px] animate-box"><img class="animate-box-img w-[95px]  rotate-45 animate-arrows" src="img/muiten.png"/></div>
            <img class="absolute w-[35px] bottom-[8px] right-[19px] rotate-45 animate-hand" src="img/hand.png"/>
        </div>
    </div>
  </div>
</div>
<div class="pd-compact-mobile" style="background-color: unset;">
    <div class="pd-body">
        @foreach($tool as $v)
        <a href="{{$v['link']}}" target="_blank" class="pushdy-widget-button pd-tel" style="height: 40px; width: 40px;display: block; background-image: url({{UPLOAD_PHOTO.$v['photo']}});">
            <span class="pd-label pd-tel pd-tooltip-text" style="color: black; background: rgb(20, 53, 195);">{{$v['ten'.$lang]}}</span>
        </a>
        @endforeach
        {{-- <a class="pushdy-widget-button pd-tel scroll-btn" scrollto="#contact" style="height: 40px; width: 40px;display: block; background-image: url(img/contact.png);">
          <span class="pd-label pd-tel pd-tooltip-text" style="color: black; background: rgb(20, 53, 195);">Tư vấn ngay</span>
        </a> --}}
        <div class="pd-close"><svg class="mt-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#6EBB33" d="M23 20.168l-8.185-8.187 8.185-8.174-2.832-2.807-8.182 8.179-8.176-8.179-2.81 2.81 8.186 8.196-8.186 8.184 2.81 2.81 8.203-8.192 8.18 8.192z"/></svg></div>
    </div>
</div>
<script>
var arCuMessages = [];
var arCuLoop = false;
var arCuCloseLastMessage = false;
var arCuPromptClosed = false;
var _arCuTimeOut = null;
var arCuDelayFirst = 2000;
var arCuTypingTime = 2000;
var arCuMessageTime = 4000;
var arCuClosedCookie = 0;
var arcItems = [];
var tool = @json($tool);
window.addEventListener('load', function() {
  //arCuClosedCookie = arCuGetCookie('arcu-closed');
  $('#arcontactus').on('arcontactus.init', function() {
    if (arCuClosedCookie) {
      return false;
  }
  arCuShowMessages();

});
  $('#arcontactus').on('arcontactus.openMenu', function() {
    clearTimeout(_arCuTimeOut);
    arCuPromptClosed = true;
    $('#contact').contactUs('hidePrompt');
    arCuCreateCookie('arcu-closed', 1, 30);
});
  $('#arcontactus').on('arcontactus.hidePrompt', function() {
    clearTimeout(_arCuTimeOut);
    arCuPromptClosed = true;
    arCuCreateCookie('arcu-closed', 1, 30);
});
  for (let i = 0; i < tool.length; i++) {
      var arcItem = {};
      arcItem.id = 'msg-item-'+i;
      arcItem.class = 'msg-item-'+i;
      arcItem.title = tool[i]['tenvi'];
      arcItem.icon = '<img src="public/upload/photo/'+tool[i]['photo']+'"/>';
      arcItem.href = tool[i]['link'];
      arcItem.color = '';
      arcItems.push(arcItem);
  }

  // var arcItem = {};
  //     arcItem.id = 'msg-item-n';
  //     arcItem.class = 'msg-item-n scroll-btn';
  //     arcItem.title = 'Tư vấn ngay';
  //     arcItem.icon = '<img src="img/contact.png"/>';
  //     //arcItem.href = '';
  //     arcItem.color = '#fff';
  //     arcItem.datae = "#contact";
  //     arcItems.push(arcItem);

  $('#arcontactus').contactUs({
    items: arcItems
  });

  $('#msg-item-n').attr('datae', '#contact');
});
</script>
