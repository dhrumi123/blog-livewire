<div>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Permissions</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}"> <i
                                    data-feather="home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</li></a>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.permission') }}">Permissions</li>
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
                                    <button class="btn btn-pill btn-primary btn-air-primary add-permission" wire:click.prevent='addNew'> <i
                                            class="mr-1 fa fa-plus-circle"></i>
                                        Add new permission </button>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <table class="table table-hover">
                                            <tr>
                                                <th scope="col"> # </th>
                                                <th scope="col"> Name </th>
                                                <th scope="col"> Created Date </th>
                                                <th scope="col"> Options </th>
                                            </tr>
                                            <thead>
                                            <tbody>
                                                @foreach ($permissions as $permission)
                                                    <tr>
                                                        <th scope="row">{{ $loop->iteration }}</th>
                                                        <td> {{ $permission->name }} </td>
                                                        <td>  {{ date('d-m-Y', strtotime($permission->created_at)) }} </td>
                                                        {{-- <td> {{ $permission->created_at->toFormattedDate() }}</td> --}}
                                                        <td><a href=""
                                                                wire:click.prevent="edit({{ $permission }})"
                                                                class="mr-1 edit-link btn btn-icon btn-outline-info">
                                                                <i class="fa fa-edit"></i> </a>
                                                            <a href="#"
                                                                wire:click.prevent="confirmpermissionRemoval({{ $permission->id }})"
                                                                class="mr-1 delete-link btn btn-icon btn-outline-danger">
                                                                <i class="fa fa-trash"></i> </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            </thead>
                                        </table>
                                    </div>
                                    <div class="card-footer d-flex justify-content-end">
                                        {{ $permissions->links() }}
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
                            <span>Edit Permission</span>
                        @else
                            <span>Add New Permission </span>
                        @endif
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="create-form">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" wire:model.defer='state.name'
                                class="form-control @error('name') is-invalid @enderror" id="name"
                                aria-describedby="name" placeholder="Enter Name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-pill btn-light btn-air-light" data-bs-dismiss="modal"><i
                            class="mr-2 fa fa-times"></i>Cancel</button>
                    <button type="button" class="btn btn-pill btn-success btn-air-success"
                        wire:click.prevent="{{ $showEditModal ? 'updatePermission' : 'createPermission' }}"><i
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
                <h5>Delete Permission</h5>
            </div>
            <div class="modal-body">
                <h4>Are you sure you want to delete this Permission? </h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i
                        class="mr-2 fa fa-times"></i>Cancel</button>
                <button type="button" class="btn btn-danger" wire:click.prevent="deletePermission"><i
                        class="mr-2 fa fa-trash"></i> Delete Permission
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