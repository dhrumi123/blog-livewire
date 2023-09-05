<div>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Category</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}"> <i
                                    data-feather="home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</li></a>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.categories') }}">Category</li>
                        </a>

                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row starter-main">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-2 justify-content-end d-flex">
                                    <button class="btn btn-pill btn-primary btn-air-primary add-category" wire:click.prevent='addNew'> <i
                                            class="mr-1 fa fa-plus-circle"></i>
                                        Add new category </button>
                                </div>
                                <div class="card">
                                    <div class="my-gallery card-body row gallery-with-description" itemscope="">
                                        @foreach ($categories as $category)
                                        <figure class="col-xl-3 col-sm-6" itemprop="associatedMedia" itemscope=""><a href="{{  asset('storage/' . $category->image)  }}" itemprop="contentUrl" data-size="1600x950"><img src="{{  asset('storage/' . $category->image)  }}" itemprop="thumbnail" alt="Image description" height="200" width="200">
                                            <div class="caption">
                                              <h4>{{ $category->name }} ( {{ $category->slug }} )</h4>
                                              <p class="card-float">
                                                 <a href="" wire:click.prevent="edit({{ $category }})"
                                                class="mr-1 edit-link btn btn-icon btn-outline-info">
                                                <i class="fa fa-edit"></i> 
                                                </a>
                                                <a href="#"
                                                    wire:click.prevent="confirmcategoryRemoval({{ $category->id }})"
                                                    class="mr-1 delete-link btn btn-icon btn-outline-danger">
                                                    <i class="fa fa-trash"></i> 
                                                </a></p>
                                                <p> {{ date('d-m-Y', strtotime($category->created_at)) }}</p>
                                            </div></a>
                                        </figure>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        @if ($showEditModal)
                            <span>Edit Category</span>
                        @else
                            <span>Add New Category </span>
                        @endif
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="create-form">
                        <div class="addcatogary-group uploda-profile-pic mw-100">
                            <div class="small-12 medium-2 large-2 columns">
                                <div class="p-image">
                                    <div class="upload-button">
                                        <div class="add-catogary-image">
                                            {{-- <img class="profile-pic" src="{{ asset('assets/images/subject-image.png') }}" onerror="this.onerror=null;this.src='{{ asset('assets/images/subject-image.png') }}';"> --}}
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        @if ($editingImage)
                                            <img src="{{ asset('storage/' . $editingImage) }}" alt="Image" height="200" width="200  ">
                                        @endif
                                        <br><br>    
                                        <label class="col-sm-3 col-form-label">Upload File</label>
                                        <div class="col-sm-9">
                                          <input class="form-control" type="file" accept="image/*" wire:model.defer='state.image' id="image">
                                        </div>
                                      </div>
                                    @error('image')
                                        <span class="invalid-feedback" style="display: block;text-align: center;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" wire:model.defer='state.name'
                                class="form-control @error('name') is-invalid @enderror" id="name"
                                aria-describedby="name" placeholder="Enter Name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-mb-3">
                            <label for="status" class="form-label">Status:</label>
                            <select class="form-control" wire:model.defer="state.status">
                                <option value="1">Active</option>
                                <option value="0">Not Active</option>
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </form>
                </div>  
                <div class="modal-footer">
                    <button type="button" class="btn btn-pill btn-light btn-air-light" data-bs-dismiss="modal"><i
                            class="mr-2 fa fa-times"></i>Cancel</button>
                    <button type="button" class="btn btn-pill btn-success btn-air-success"
                        wire:click.prevent="{{ $showEditModal ? 'updateCategory' : 'createCategory' }}"><i
                            class="mr-2 fa fa-save"></i>
                        @if ($showEditModal)
                            <span> Update </span>
                        @else
                            <span> Save </span>
                        @endif
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Delete Category</h5>
            </div>
            <div class="modal-body">
                <h4>Are you sure you want to delete this Category? </h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i
                        class="mr-2 fa fa-times"></i>Cancel</button>
                <button type="button" class="btn btn-danger" wire:click.prevent="deleteCategory"><i
                        class="mr-2 fa fa-trash"></i> Delete Category
                </button>
            </div>
        </div>
    </div>
</div>
</div>
@section('script')
    <script>
        window.addEventListener('show-form', event => {
            $('#form').modal('show');
        })

        window.addEventListener('show-delete-modal', event => {
            $('#confirmationModal').modal('show');
        })
    </script>
    <script>
        $(document).ready(function() {
            toastr.options = {
                "progressBar": true,
                "positionClass": "toast-top-right",
            }

            window.addEventListener('hide-form', event => {
                $('#form').modal('hide');
                toastr.success(event.detail.message, 'Success!');
            })

            window.addEventListener('hide-delete-modal', event => {
                $('#confirmationModal').modal('hide');
                toastr.success(event.detail.message, 'Success!');
            })
        })
    </script>
@endsection