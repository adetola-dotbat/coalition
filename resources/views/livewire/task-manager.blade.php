<section class="content-header mt-5">
    <div class="container-fluid ">
        <div class="row mb-2">
            <div class="col-sm-6 mx-auto text-center">
                <h3>Task Management</h3>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content mt-3">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-md-6 mx-auto col-10  col-lg-6 ">
                <div class="card ">
                    <div class="card-header">
                        <form autocomplete="off"
                            wire:submit.prevent="{{ $editTaskManager ? 'updateTask' : 'addTask' }}">
                            <div class="form-group  mx-sm-3 mb-2">
                                <input type="text" wire:model="taskText" class="form-control mb-3"
                                    placeholder="Add Task">
                                <input type="hidden" wire:model="id">
                                <button type="submit" class="form-control btn btn-primary mb-2">
                                    @if (!$editTaskManager)
                                        <span> Add Task</span>
                                    @else
                                        <span> Update Task</span>
                                    @endif
                                </button>
                            </div>
                        </form>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th style="width:40%">Task</th>
                                    <th style="width:33%">Timestamp</th>
                                    <th style="width:50%">Action</th>
                                </tr>
                            </thead>
                            <tbody wire:sortable="priority">
                                @if (count($tasks) == 0)
                                    <p class="text-gray-500 text-center">There are no todos</p>
                                @endif
                                @foreach ($tasks as $task)
                                    <tr wire:sortable.item="{{ $task->id }}" wire:key="task-{{ $task->id }}">
                                        <td>{{ $loop->iteration }}.</td>
                                        <td wire:sortable.handle>
                                            {{ $task->task }}
                                        </td>
                                        <td> {{ $task->created_at->format('Y-m-d - h:i A') }}</td>
                                        <td>
                                            <span class="btn btn-outline-danger"
                                                wire:click="deleteTodo({{ $task->id }})">Delete</span>
                                            <span class="btn btn-warning"
                                                wire:click="editTask({{ $task->id }})">Edit</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.col -->
    </div>
</section>
