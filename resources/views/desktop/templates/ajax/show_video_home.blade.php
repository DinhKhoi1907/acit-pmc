@if($post)
<div class="ajax-home-video">
	<iframe src="https://www.youtube.com/embed/{{Helper::GetIDYoutube($post['video'])}}" width="100%" height="100%" allowfullscreen frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>
</div>
<span class="ajax-home-video-close"><i class="fal fa-times"></i></span>
@endif