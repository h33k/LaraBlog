<x-profile doctitle="{{$sharedData['username']}}'s Profile | LaraBlog" :sharedData="$sharedData">
    @include('profile-posts-only')
</x-profile>
