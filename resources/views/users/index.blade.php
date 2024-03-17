@extends('layouts.default')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Users</h2>
            </div>
            <div class="pull-right">
                @can('user-create')
                <a class="btn btn-success" href="#"> Create New User</a>
                @endcan
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th width="280px">Action</th>
        </tr>
	    @foreach ($users as $user)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $user->name }}</td>
	        <td>{{ $user->email }}</td>
	        <td>
                <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    @can('assign-task')
                        <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Task Assign</a>
                    @endcan
                    @can('user-delete')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>
    
@endsection