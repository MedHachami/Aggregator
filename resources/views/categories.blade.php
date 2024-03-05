<x-layouts.admin-layout title="Dashboard">
    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="middle-content container-xxl p-0">
                <div class="row layout-top-spacing">
                    <div class="col-lg-12">
                        <div class="d-flex flex-row-reverse pe-4">
                            <a id="btn-add-notes" class="btn btn-secondary" href="javascript:void(0);">Add Category</a>
                        </div>
                    </div>
                </div>
                <div class="row app-notes layout-top-spacing" id="cancel-row">
                    <div class="col-lg-12">
                        <div class="app-container">
                            <div class="app-note-container">
                                <div class="app-note-overlay"></div>
                                <div id="ct" class="note-container note-grid">
                                    @foreach ($categories as $category)
                                    <div class="note-item all-notes note-social">
                                        <div class="note-inner-content">
                                            <div class="note-content">
                                                <p class="note-title" data-noteTitle="{{ $category->name }}">{{ $category->name }}</p>
                                                <p class="meta-time">{{ $category->created_at }}</p>
                                                <div class="note-description-content">
                                                    <p class="note-description" data-noteDescription="Curabitur facilisis vel elit sed dapibus sodales purus rhoncus.">
                                                        {{ $category->description }}
                                                    </p>
                                                    @if($category->posts_count > 0)
                                                        <span class="badge badge-secondary mt-2 me-4" style="font-size: 18px;">{{ $category->posts_count }} post</span>
                                                    @else
                                                        <span class="badge badge-danger mb-2 me-4" style="font-size: 18px;">No posts</span>
                                                    @endif

                                                </div>
                                            </div>
                                            <div class="note-action d-flex">
                                                <div class="pe-3">
                                                    <button class="btn btn-primary" onclick="openEditModal({{ $category->id }}, '{{ $category->name }}', '{{ $category->description }}')">
                                                        <span><i class="fa-solid fa-pencil"></i></span>
                                                    </button>
                                                </div>
                                                <div>
                                                    <form action="{{ route('delete-category') }}" method="post" style="display: inline">
                                                        @csrf
                                                        @method('delete')

                                                        <!-- Button to delete the category -->
                                                        <input name="id" type="hidden" value="{{ $category->id }}">
                                                        <button type="submit" class="btn"><span><i class="fa-solid fa-trash"></i></span></button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="notesMailModal" tabindex="-1" role="dialog" aria-labelledby="notesMailModalTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title add-title" id="notesMailModalTitleeLabel">Add Category</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                            </svg>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="notes-box">
                                            <div class="notes-content">

                                                <form action="{{ route('add-category') }}" id="notesMailModalTitle" method="post">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="d-flex note-title">
                                                                <input name="name" type="text" id="n-title" class="form-control" maxlength="25" placeholder="Title">
                                                            </div>
                                                            <span class="validation-text"></span>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="d-flex note-description">
                                                                <textarea name="description" id="n-description" class="form-control" maxlength="60" placeholder="Description" rows="3"></textarea>
                                                            </div>
                                                            <span class="validation-text"></span>
                                                            <span class="d-inline-block mt-1 text-danger">Maximum Limit 60 characters</span>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button id="btn-n-save" class="float-left btn">Save</button>
                                                        <a class="btn" data-bs-dismiss="modal" href="javascript:void(0);">Discard</a>
                                                        <button class="btn btn-primary" type="submit">Add</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Modal edit -->
                        <div class="modal fade" id="notesMailModalEdit" tabindex="-1" role="dialog" aria-labelledby="notesMailModalTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title add-title" id="notesMailModalTitleeLabel">Edit Category</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                            </svg>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="notes-box">
                                            <div class="notes-content">

                                                <form action="{{ route('update-category') }}" id="notesMailModalTitleEdit" method="post">
                                                    @csrf
                                                    @method('put')

                                                    <input name="id" type="hidden" id="categoryId">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="d-flex note-title">
                                                                <input id="nameInput" name="name" type="text" id="n-title" class="form-control" maxlength="25" placeholder="Title">
                                                            </div>
                                                            <span class="validation-text"></span>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="d-flex note-description">
                                                                <textarea id="descInput" name="description" id="n-description" class="form-control" maxlength="60" placeholder="Description" rows="3"></textarea>
                                                            </div>
                                                            <span class="validation-text"></span>
                                                            <span class="d-inline-block mt-1 text-danger">Maximum Limit 60 characters</span>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="float-left btn btn-n-save">Save</button>
                                                        <a class="btn" data-bs-dismiss="modal" href="javascript:void(0);">Discard</a>
                                                        <button class="btn btn-primary" type="submit">Edit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  END CONTENT AREA  -->
</x-layouts.admin-layout>
