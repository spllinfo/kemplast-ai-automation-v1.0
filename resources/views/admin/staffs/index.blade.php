@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Staff Management</h5>
                    <a href="{{ route('admin.staffs.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add New Staff
                    </a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Designation</th>
                                    <th>Department</th>
                                    <th>Phone</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($staffs as $staff)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($staff->profile_picture)
                                                    <img src="{{ Storage::url('profile-pictures/' . $staff->profile_picture) }}" 
                                                         alt="{{ $staff->first_name }}" 
                                                         class="rounded-circle me-2"
                                                         style="width: 40px; height: 40px; object-fit: cover;">
                                                @endif
                                                {{ $staff->first_name }} {{ $staff->last_name }}
                                            </div>
                                        </td>
                                        <td>{{ $staff->email }}</td>
                                        <td>{{ $staff->designation }}</td>
                                        <td>{{ $staff->department }}</td>
                                        <td>{{ $staff->phone }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.staffs.edit', $staff) }}" 
                                                   class="btn btn-sm btn-primary">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <form action="{{ route('admin.staffs.destroy', $staff) }}" 
                                                      method="POST" 
                                                      class="d-inline"
                                                      onsubmit="return confirm('Are you sure you want to delete this staff member?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection