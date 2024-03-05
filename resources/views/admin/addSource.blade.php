<x-layouts.admin-layout title="Add-Ressource" >

    <div id="content" class="main-content">
        <div class="layout-px-spacing">

            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p class="text-black">{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert danger"> {{ session('error') }} </div>
            @endif
            <div class="middle-content container-xxl p-0">

                <div class="row layout-top-spacing">

                    <div class="col-xxl-12 col-xl-8 col-lg-8 col-md-7 mt-xxl-0 mt-4">
                        <div class="widget-content widget-content-area ecommerce-create-section p-10">
                            <form method="post" action="{{route('addRss.store')}}">
                                @csrf
                                <div class="row">

                                    <div class="col-xxl-12 col-md-6 mb-4">
                                        <label for="proCode">Rss link</label>
                                        <input type="text" class="form-control" name="url" >
                                    </div>

                                    <div class="col-xxl-12 col-md-6 mb-4">
                                        <label for="gender">Category</label>
                                        <select class="form-select" aria-label="Default select example" name="category">
                                            @foreach($categories as $categorie)
                                                <option class="option" value="{{ $categorie['id'] }}" @if($categorie['id'] == 1) selected @endif>
                                                    {{ $categorie['name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-12">
                                        <button class="btn btn-success w-100">Genrate Rss</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>


                </div>

            </div>

        </div>

    </div>
</x-layouts.admin-layout >
