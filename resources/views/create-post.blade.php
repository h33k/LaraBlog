<x-layout>
  <div class="container py-md-5 container--narrow">
      <form action="/create-post" method="POST">
        @csrf
        <div class="form-group">
          <label for="post-title" class="text-muted mb-1"><small>Title</small></label>
          <input value="{{ old('title') }}" required name="title" id="post-title" class="form-control form-control-lg form-control-title" type="text" placeholder="" autocomplete="off" />
            @error('title')
            <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
            @enderror
        </div>

        <div class="form-group">
          <label for="post-body" class="text-muted mb-1"><small>Body Content</small></label>
          <textarea required name="body" id="post-body" class="body-content tall-textarea form-control" type="text">{{ old('body') }}</textarea>
            @error('body')
            <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
            @enderror
        </div>

          <div class="mb-3 small alert alert-info shadow-sm">
              <h6 onclick="displayGuideContent()">Formatting text guide...</h6>
              <div id="guide-content" class="d-none">
                  <p>
                      ### Header <br>
                      [Inline link](https://www.yoursite.com) <br>
                      **Strong text** <br>
                      _Italic text_ <br>
                  </p>
                  <p>
                      1. First ordered list item <br>
                      2. Another item <br>
                      ⋅⋅* Unordered sub-list. <br>
                      25. Some other item with any number <br>
                  </p>
                  <p>
                      * Unordered list can use asterisks <br>
                      - Or minuses <br>
                      + Or pluses <br>
                  </p>
              </div>
          </div>

        <button class="btn btn-primary">Save New Post</button>
      </form>
    </div>
</x-layout>
