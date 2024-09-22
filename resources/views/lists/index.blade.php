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
            padding-bottom: 10px;
            /* add some space between the header and the list */
            border-bottom: 1px solid #ccc;
            /* add a light gray border */
        }

        .header h2 {
            margin-top: 0;
            /* remove the default margin */
            font-weight: bold;
            /* make the title bold */
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

        .list-group-item a {
            text-decoration: none;
            /* remove the default underline */
            color: #337ab7;
            /* set the link color to a blue-ish tone */
        }

        .list-group-item a:hover {
            color: #23527c;
            /* change the link color on hover */
        }

        .list-group-item h4 {
            margin-top: 0;
            /* remove the default margin */
            font-weight: bold;
            /* make the list item title bold */
        }

        .list-group-item p {
            margin-bottom: 0;
            /* remove the default margin */
            font-size: 14px;
            /* set the font size to 14px */
            color: #666;
            /* set the text color to a dark gray */
        }

        .btn-blue {
            background-color: #337ab7;
            /* set the button background color to blue */
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
        }

        .btn-blue:hover {
            background-color: #23527c;
            /* change the button background color on hover */
        }
    </style>
@endpush

@section('content')
    <div class="container">
        <div class="header">
            <h2>My Lists</h2>
        </div>

        <ul id="list-index" class="list-group">
            @foreach ($lists as $list)
                <li class="list-group-item">
                    <a href="{{ route('lists.show', $list) }}">
                        <h4>{{ $list->name }}</h4>
                        <p>{{ $list->description }}</p>
                    </a>
                </li>
            @endforeach

        </ul>

        <a href="{{route('lists.create')}}"><button class="btn btn-blue">Create New List</button></a>
    </div>
@endsection
