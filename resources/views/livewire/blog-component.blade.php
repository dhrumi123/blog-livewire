<div>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Blog Details</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Blog</li>
                        <li class="breadcrumb-item active">Blog Details</li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.createblog') }}"> Create Blog </a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    @if (session('message'))
        <div class="alert alert-success dark alert-dismissible fade show" role="alert">
            <p> {{ session('message') }}.</p>
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"
                data-bs-original-title="" title=""></button>
        </div>
    @endif
    <div class="container-fluid">
        <div class="row">
            @foreach ($blogs as $blog)
                <div class="col-xl-6 set-col-12 box-col-12">
                    <div class="card">
                        <div class="blog-box blog-list row">
                            <div class="col-sm-5"><img class="img-fluid sm-100-w"
                                    src="{{ asset('storage/' . $blog->image) }}" alt=""></div>
                            <div class="col-sm-7">
                                <div class="blog-details">
                                    <div class="blog-date"><span>{{ date('d', strtotime($blog->created_at)) }}</span>
                                        {{ date('F', strtotime($blog->created_at)) }}
                                        {{ date('Y', strtotime($blog->created_at)) }}
                                    </div>
                                    <h6>{{ ucfirst($blog->title) }}</h6>
                                    <div class="blog-bottom-content">
                                        <ul class="blog-social">
                                            <li>by: {{ $blog->users->name }}</li>
                                            <li>Category: {{ $blog->categories->name }} (
                                                {{ $blog->subCategories->name }} )</li>
                                        </ul>
                                        <hr>
                                        <p class="mt-0">{{ $blog->short_description }}</p>
                                        <p class="card-float">
                                            <a href="{{ route('admin.updateblog', $blog) }}"
                                                class="mr-1 edit-link btn btn-icon btn-outline-info">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="#"
                                                wire:click.prevent="confirmblogRemoval({{ $blog->id }})"
                                                class="mr-1 delete-link btn btn-icon btn-outline-danger">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <a href="{{ route('admin.viewblog', $blog) }}"
                                                class="mr-1 view-link btn btn-icon btn-outline-primary">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            @if ($blog->status == 1)
                                                <a href="#"
                                                    wire:click.prevent="confirmChangeStatus({{ $blog->id }})"
                                                    class="mr-1 status-link btn btn-icon btn-outline-success"
                                                    value="1">
                                                    <i class="fa fa-lock"></i>
                                                </a>
                                            @else
                                                <a href="#"
                                                    wire:click.prevent="confirmChangeStatus({{ $blog->id }})"
                                                    class="mr-1 status-link btn btn-icon btn-outline-danger"
                                                    value="0">
                                                    <i class="fa fa-lock"></i>
                                                </a>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Delete Blog</h5>
                </div>
                <div class="modal-body">
                    <h4>Are you sure you want to delete this Blog? </h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i
                            class="mr-2 fa fa-times"></i>Cancel</button>
                    <button type="button" class="btn btn-danger" wire:click.prevent="deleteBlog"><i
                            class="mr-2 fa fa-trash"></i> Delete Blog
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="changeStatusModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Change Status Blog</h5>
                </div>
                <div class="modal-body">
                    <h4>Are you sure you want to change the status of this Blog? </h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i
                            class="mr-2 fa fa-times"></i>Cancel</button>
                    <button type="button" class="btn btn-danger" wire:click.prevent="changeStatus"><i
                            class="mr-2 fa fa-trash"></i> Change status
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@section('script')
    <script>
        window.addEventListener('show-delete-modal', event => {
            $('#confirmationModal').modal('show');
        })

        window.addEventListener('show-confirmation-modal', event => {
            $('#changeStatusModal').modal('show');
        })
    </script>
    <script>
        $(document).ready(function() {
            toastr.options = {
                "progressBar": true,
                "positionClass": "toast-top-right",
            }

            window.addEventListener('hide-delete-modal', event => {
                $('#confirmationModal').modal('hide');
                toastr.success(event.detail.message, 'Success!');
            })

            window.addEventListener('hide-confirmation-modal', event => {
                $('#changeStatusModal').modal('hide');
                toastr.success(event.detail.message, 'Success!');
            })
        })
    </script>
@endsection
