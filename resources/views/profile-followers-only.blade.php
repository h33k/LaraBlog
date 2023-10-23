<div class="list-group">
    @foreach($followers as $follow)
        <a href="/profile/{{$follow->UserDoingTheFollowing->username}}" class="list-group-item list-group-item-action">
            <img class="avatar-tiny" src="{{$follow->userDoingTheFollowing->avatar}}" />
            {{$follow->userDoingTheFollowing->username}}
        </a>
    @endforeach
</div>
