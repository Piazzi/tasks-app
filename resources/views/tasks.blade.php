@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Task Form</div>
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops! Something went wrong!</strong>

                    <br><br>

                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="card-body">
                    <!-- New Task Form -->
                    <form action="/task" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        <!-- Task Name -->
                        <div class="form-group">
                            <label for="task" class="col-sm-3 control-label">Task</label>

                            <div class="col-sm-6">
                                <input type="text" name="name" id="task-name" class="form-control">
                                <input hidden name="priority" id="priority" value="1" class="form-control">
                            </div>
                        </div>

                        <!-- Add Task Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-plus"></i> Add Task
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">To do</div>
                <div class="card-body">
                    <!-- Current Tasks -->
                    @if (count($tasks) > 0)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        </div>

                        <div class="panel-body">
                            <table id="" class="table table-striped task-table">

                                <!-- Table Headings -->
                                <thead>
                                    <th>Order</th>
                                    <th>Task</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </thead>

                                <!-- Table Body -->
                                <tbody id="tablecontents">
                                    @foreach ($tasks as $task)
                                    <tr class="row1" data-id="{{ $task->id }}">
                                        <td class="pl-3"><i class="fa fa-sort"></i></td>

                                        <!-- Task Name -->
                                        <td class="table-text">
                                            <form action="/task/update" method="POST" id="edit-{{$task->id}}">
                                                @csrf
                                                <div>
                                                    <input type="text" name="name" id="task-name" value="{{$task->name}}" class="form-control">
                                                    <input hidden name="priority" id="priority" value="1" class="form-control">
                                                </div>
                                            </form>
                                        </td>
                                        <td>
                                        <button form="edit-{{$task->id}}" for="edit-{{$task->id}}" type="submit" >Edit Task</button>

                                        </td>
                                        <td>
                                            <form action="/task/{{ $task->id }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button>Delete Task</button>
                                            </form>
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
</div>

@endif

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
<script type="text/javascript">
    $(function() {
        $("#table").DataTable();

        $("#tablecontents").sortable({
            items: "tr",
            cursor: 'move',
            opacity: 0.6,
            update: function() {
                updatePriority();
            }
        });

        function updatePriority() {
            let task = [];
            let token = $('meta[name="csrf-token"]').attr('content');
            $('tr.row1').each(function(index, element) {
                task.push({
                    id: $(this).attr('data-id'),
                    position: index + 1
                });
            });

            $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ url('task') }}",
                    data: {
                        task: task,
                        _token: token
                    },
                    success: function(response) {
                        response.status == "success" ? console.log(response) : console.log(response);
                    }
                }

            )
        };
    });
</script>

<!-- TODO: Current Tasks -->
@endsection