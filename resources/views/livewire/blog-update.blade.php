<div>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Add Blog</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">Blog</li>
                        <li class="breadcrumb-item active">Update Blog</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body add-post">
                        <form autocomplete="off" enctype="multipart/form-data">
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label for="validationCustom01">Title:</label>
                                    <input class="form-control" id="validationCustom01" type="text"
                                           placeholder="Post Title" wire:model.defer="state.title">
                                    @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <div class="col-form-label">Category:
                                        <select class="form-control" id="category_id" wire:model="selectedCategory"
                                               >
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" >{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <div class="col-form-label"> Sub Category:
                                        <select class="form-control" name="subcategory_id"
                                                wire:model.defer="selectedSubCategory">
                                            <option value="" selected>Choose sub category</option>
                                            @foreach ($subcategories  as $subcategory)
                                                <option value="{{ $subcategory->id }}">{{ $subcategory->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('sub_category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="note">Note:</label>
                                        <textarea id="note" data-note="@this" wire:model="note" class="form-control"></textarea>
                                    </div>
                                    @error('note')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status:</label>
                                <select class="form-control" wire:model.defer="state.status" id="status">
                                    <option value="1">Active</option>
                                    <option value="0">Not Active</option>
                                </select>
                                @error('status')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="featured" class="form-label">Featured:</label>
                                <select class="form-control" wire:model.defer="state.featured" id="featured">
                                    <option value="1">Active</option>
                                    <option value="0">Not Active</option>
                                </select>
                                @error('featured')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Upload File</label>
                                <input class="form-control" type="file" accept="image/*"
                                       wire:model.defer='state.image' id="image">
                                @error('image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="tags-input">Tags</label>                                
                                <input class="form-control" id="tags-input" type="text" wire:model="tags"> 
                                @error('tags')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </form>
                        <div class="btn-showcase">
                            <button class="btn btn-primary" type="submit" id="submit"
                                    wire:click="updateBlog">Post
                            </button>
                            <input class="btn btn-light" type="reset" value="Cancel">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('script')
    <script>
        var tagsInput = $("#tags-input");
         $(document).ready(function () {
            // initializes tags input
            
         });
        document.addEventListener('livewire:update', function () {
            // destroy tags input
            tagsInput.tagsinput('destroy');
            // re-initializes tags input
            tagsInput.tagsinput({
                allowDuplicates: false
            });

            ClassicEditor
            .create(document.querySelector('#note'))
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    let note = editor.getData();
                    console.log(note);
                    $('#note').attr('data-note', note);
                    @this.
                    set('note', note);
                })
            })
            .catch(error => {
                console.error(error);
            }); 
        
        });

        $('#category_id').on('change', function (e) {
            @this.
            set('tags', $('#tags-input').val());
            // destroy tags input
            tagsInput.tagsinput('destroy');
            // re-initializes tags input
            tagsInput.tagsinput({
                allowDuplicates: false
            });
        });

        $('#tags-input').on('itemAdded', function (event) {
            @this.
                    set('tags', $('#tags-input').val());
            // destroy tags input
            tagsInput.tagsinput('destroy');
            
            // re-initializes tags input
            tagsInput.tagsinput({
                allowDuplicates: false
            });
        });

        document.addEventListener('livewire:load', function () {
            tagsInput.tagsinput({
                allowDuplicates: false
            });

            ClassicEditor
            .create(document.querySelector('#note'))
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    let note = editor.getData();
                    $('#note').attr('data-note', note);
                    @this.
                    set('note', note);
                    @this.
                    set('tags', $('#tags-input').val());
                    // destroy tags input
                    tagsInput.tagsinput('destroy');
                    // re-initializes tags input
                    tagsInput.tagsinput({
                        allowDuplicates: false
                    });
                })
            })
            .catch(error => {
                console.error(error);
            }); 
        });
    </script>

@endsection




