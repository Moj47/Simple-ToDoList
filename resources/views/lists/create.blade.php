@extends('layouts.app')
@push('styles')
    <style>
        /* ... (rest of your CSS remains the same) ... */

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

        .create-list {
            text-align: center;
        }

        .create-list h2 {
            color: #333;
            margin-bottom: 20px;
        }

        .my-form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .form-control {
            width: 100%;
            height: 40px;
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-control:focus {
            border-color: #ffa07a;
            box-shadow: 0 0 10px rgba(255, 160, 122, 0.5);
        }

        textarea {
            width: 100%;
            height: 100px;
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: vertical;
        }

        textarea:focus {
            border-color: #ffa07a;
            box-shadow: 0 0 10px rgba(255, 160, 122, 0.5);
        }

        .but {
            background-color: #ffa07a;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .but:hover {
            background-color: #ff9900;
        }
    </style>
@endpush
@section('content')
    <div class="container">
        <div class="create-list">
            <h2>Create a New List</h2>
            <form action="{{route('lists.store')}}" method="POST" class="my-form">
                @csrf
                <input required type="text" id="name" placeholder="List Name..." class="@error('name') is-invalid @enderror form-control" name="name">
                @error('name')

                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                <textarea required class="@error('description') is-invalid @enderror form-control" name="description" placeholder="description"></textarea>
                @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                <button  class="but">Create</button>
            </form>
        </div>
    </div>
@endsection
