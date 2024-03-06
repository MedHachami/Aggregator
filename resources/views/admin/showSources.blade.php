<x-layouts.admin-layout title="Add-Ressource" >
    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="middle-content container-xxl p-0">

                <div class="row layout-top-spacing">
                    <div class="col-lg-3 col-md-3 col-sm-3 mb-4">
                        <input id="t-text" type="text" name="searched" placeholder="Search" class="form-control" required="">
                    </div>
                    <h2>Posts:</h2>
                </div>

                <div class="row">

                    <div  class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 mb-4">
                        <a href="app-blog-post.html" class="card style-2 mb-md-0 mb-4">
                            <img src="{{asset('images/grid-blog-style-3.jpg')}}" class="card-img-top" alt="...">
                            <div class="card-body px-0 pb-0">
                                <h5 class="card-title mb-3">14 Tips to improve your photography @if(isset($posts))@dd($posts) @else dkdd @endif</h5>
                                <div class="media mt-4 mb-0 pt-1">
                                    <img src="{{asset('images/profile-3.jpg')}}" class="card-media-image me-3" alt="">
                                    <div class="media-body">
                                        <h4 class="media-heading mb-1">Shaun Park</h4>
                                        <p class="media-text">01 May</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 mb-4">
                        <a href="app-blog-post.html" class="card style-2 mb-md-0 mb-4">
                            <img src="{{asset('images/grid-blog-style-1.jpg')}}" class="card-img-top" alt="...">
                            <div class="card-body px-0 pb-0">
                                <h5 class="card-title mb-3">The ideal work from home office setup</h5>
                                <div class="media mt-4 mb-0 pt-1">
                                    <img src="{{asset('images/profile-2.jpg')}}" class="card-media-image me-3" alt="">
                                    <div class="media-body">
                                        <h4 class="media-heading mb-1">Vanessa Kirby</h4>
                                        <p class="media-text">02 May</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @if(!empty($postsPaginated))

                        @foreach($postsPaginated as $post)
                            <div card class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 mb-4">
                                <a href="app-blog-post.html" class="card style-2 mb-md-0 mb-4">
                                    @if(is_null($post['image'] || empty($post['image'])))

                                        <img src="{{asset('images/grid-blog-style-3.jpg')}}" class="card-img-top" alt="...">
                                    @else
                                        <img src="{{$post['image']}}" class="card-img-top" alt="...">
                                    @endif
                                    <div class="card-body px-0 pb-0">
                                        <h5 class="card-title mb-3">{{substr($post['description'], 0, 100) }}</h5>
                                        <div class="media mt-4 mb-0 pt-1">
                                            <img src="{{asset('images/profile-3.jpg')}}" class="card-media-image me-3" alt="">
                                            <div class="media-body">
                                                <h4 class="media-heading mb-1">{{ substr($post['title'], 0, 40) }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        @endforeach
                        <div class="pagination">
                            {{-- Custom pagination links --}}
                            @if ($postsPaginated->currentPage() > 1)
                                <a href="{{ $postsPaginated->previousPageUrl() }}" rel="prev">&laquo; Previous</a>
                            @endif

                            @for ($i = 1; $i <= $postsPaginated->lastPage(); $i++)
                                <a href="{{ $postsPaginated->url($i) }}">{{ $i }}</a>
                            @endfor

                            @if ($postsPaginated->currentPage() < $postsPaginated->lastPage())
                                <a href="{{ $postsPaginated->nextPageUrl() }}" rel="next">Next &raquo;</a>
                            @endif
                        </div>

                    @else
                        @for($i = 0; $i <= 9; $i++)

                            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 mb-4">
                                <a href="app-blog-post.html" class="card style-2 mb-md-0 mb-4">
                                    <img src="{{asset('images/grid-blog-style-3.jpg')}}" class="card-img-top" alt="...">
                                    <div class="card-body px-0 pb-0">
                                        <h5 class="card-title mb-3">14 Tips to improve your photography</h5>
                                        <div class="media mt-4 mb-0 pt-1">
                                            <img src="{{asset('images/profile-3.jpg')}}" class="card-media-image me-3" alt="">
                                            <div class="media-body">
                                                <h4 class="media-heading mb-1">Shaun Park</h4>
                                                <p class="media-text">03 May</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endfor
                    @endif



                </div>

            </div>


        </div>

    </div>

</x-layouts.admin-layout>
<script>
    const searched = document.getElementById('t-text');
    const cards = document.querySelectorAll('[card]');

    function getSearched() {
        console.log('cool');
        for (let i = 0; i < cards.length; i++) {
            if (!cards[i].innerHTML.includes(searched.value)) {
                cards[i].style.display = 'none';
            } else {
                cards[i].style.display = 'block';
            }
        }
    }

    searched.addEventListener('input', getSearched);

    const pagination = document.getElementsByClassName('pagination');
</script>

