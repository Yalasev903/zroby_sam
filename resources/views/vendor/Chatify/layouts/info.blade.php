{{-- user info and avatar --}}
<div class="avatar av-l chatify-d-flex" style="background-image: url('{{ Auth::user()->profile_photo_url }}');"></div>
<p class="info-name">{{ config('chatify.name') }}</p>
<div class="messenger-infoView-btns">
    <a href="#" class="danger delete-conversation">Видалити розмову</a>
</div>
{{-- shared photos --}}
<div class="messenger-infoView-shared">
    <p class="messenger-title"><span>Спільні фотографії</span></p>
    <div class="shared-photos-list"></div>
</div>
