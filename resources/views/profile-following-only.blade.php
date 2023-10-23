<div class="list-group">
    @foreach($following as $follow)
        <a href="/profile/{{$follow->UserBeingFollowed->username}}" class="list-group-item list-group-item-action">
            <img class="avatar-tiny" src="{{$follow->UserBeingFollowed->avatar}}" />
            {{$follow->UserBeingFollowed->username}}
        </a>
    @endforeach
</div>
