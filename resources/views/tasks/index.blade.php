@extends('layouts.default')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Tasks</h2>
            </div>
            <div class="pull-right">
                @can('task-create')
                <a class="btn btn-success" href="{{ route('tasks.create') }}"> Create New task</a>
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
            <th>Details</th>
            <th>Status</th>
            <th width="280px">Action</th>
        </tr>
	    @foreach ($tasks as $task)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $task->title }}</td>
	        <td>{{ $task->description }}</td>
            <td>{{ $task->status }}</td>
	        <td>
                <form action="{{ route('tasks.destroy',$task->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    @can('task-edit')
                        <a class="btn btn-primary" href="{{ route('tasks.edit',$task->id) }}">Edit</a>
                    @endcan
                    @can('change-task-status')
                        <a class="btn btn-primary" href="{{ route('tasks.change-status-page',['task' => $task->id]) }}">Change Status</a>
                    @endcan
                    @can('task-delete')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>
    {!! $tasks->links() !!}
@endsection