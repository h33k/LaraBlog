<div class="list-group">
    @foreach($posts as $post)
        <x-post :post="$post" hideAuthor="true" />
    @endforeach
</div>
<div class="mt-4">
    {{$posts->links()}}
</div>
