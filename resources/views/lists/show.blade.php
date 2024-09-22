@extends('layouts.app')
@push('styles')
    <style>
        .container {
            max-width: 800px;
            /* adjust the width to your liking */
            margin: 40px auto;
            /* add some margin to center the container */
            padding: 20px;
            /* add some padding for better readability */
            background-color: #f9f9f9;
            /* add a light gray background */
            border: 1px solid #ddd;
            /* add a light gray border */
            border-radius: 10px;
            /* add a slight rounded corner */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            /* add a subtle shadow */
        }

        .header {
            display: block;
            flex-direction: column;
            /* change to column layout */
            align-items: center;
            padding-bottom: 10px;
            border-bottom: 1px solid #ccc;
        }

        .header h2 {
            margin-top: 0;
            font-weight: bold;
            margin-bottom: 10px;
            /* add some margin between title and input */
        }

        .header input[type="text"] {
            width: 50%;
            margin: 0;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .header button {
            background-color: #ffa07a;
            /* set the button background color to orange */
            color: #fff;
            /* set the button text color to white */
            padding: 10px 20px;
            /* add some padding to the button */
            border: none;
            /* remove the default border */
            border-radius: 5px;
            /* add a slight rounded corner */
            cursor: pointer;
            /* change the cursor to a pointer on hover */
            /* margin-left: 20px; */
            /* add some margin between the input and the button */
        }

        .header button:hover {
            background-color: #ff9900;
            /* change the button background color on hover */
        }

        .list-group {
            list-style: none;
            /* remove the default list style */
            padding: 0;
            /* remove the default padding */
            margin: 0;
            /* remove the default margin */
        }

        .list-group-item {
            padding: 10px;
            /* add some padding to each list item */
            border-bottom: 1px solid #ccc;
            /* add a light gray border */
        }

        .list-group-item:last-child {
            border-bottom: none;
            /* remove the border from the last list item */
        }

        .list-group-item input[type="checkbox"] {
            margin-right: 10px;
            /* add some margin between the checkbox and the text */
        }
    </style>
@endpush
@section('content')
    <div class="container">
        <div class="header">
            <h2>{{ $list->name }}</h2>
            <form method="post" action="{{route('tasks.store')}}">
                <input type="hidden" name="list_id" value="{{ $list->id }}">

                @csrf
            <div class="row">
                <div class="col-md-6">
                    <input style="width: 90%"  name='title' type="text" id="myInput" placeholder="Title..." class=" @error('title') is-invalid @enderror form-control">
                    @error('title')

                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <input style="width: 90%"  name='description' type="text" id="myInput" placeholder="Description..." class=" @error('description') is-invalid @enderror form-control">
                    @error('description')

                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <button onclick="" class="btn btn-orange">Add</button><br>
                </div>
            </div>
        </form>
        </div>

        <ul id="myUL" class="list-group">
            @foreach ($list->task as $task)
                <li class="list-group-item">
                    <form style="display:inline" action="{{ route('tasks.update', $task) }}" method="POST">
                        @method('put')
                        @csrf
                        <input {{ $task->check == true ? 'checked' : '' }} onchange="this.form.submit()" type="checkbox"
                        aria-label="...">
                        <span>{{ $task->title }}</span>
                        <small style='margin-left: 40%'>{{ $task->description }}</small>
                    </form>
                    <form style="display:inline " action="{{ route('tasks.destroy', $task) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button style="margin-left:95%" class="btn btn-danger">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endsection
