<div class="favorite-list-item">
    @if($user)
        <div data-id="{{ $user->id }}" data-action="0" class="avatar av-m"
             style="background-image: url('{{ $user->profile_photo_url }}');">
        </div>
        <p>{{ strlen($user->name) > 5 ? substr($user->name, 0, 6).'..' : $user->name }}</p>
    @endif
</div>
