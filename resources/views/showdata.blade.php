<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/showdata.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>

    <div class="container">
        @if (Session::has('msg'))
        <p class="alert alert-success">{{ Session::get('msg') }}</p>
        @endif
        <a href="{{ url('createdata') }}" class="link">Add Data</a>
        <table class="table" border="2">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Bus Name</th>
                    <th>Departing Time</th>
                    <th>Coach-No</th>
                    <th>Starting Point</th>
                    <th>Ending Point</th>
                    <th>Fare</th>
                    <th>Coach Type</th>
                    <th>Seats Available</th>
                    <th>View</th>
                    <th>Action</th>
                </tr>
            </thead>
            @foreach ($showdata as $key => $value)
            <tr>

                <td>{{ $key + 1 }}</td>
                <td>{{ $value->date }}</td>
                <td>{{ $value->bus_name }}</td>
                <td>{{ $value->departing_time }}</td>
                <td>{{ $value->coach_no }}</td>
                <td>{{ $value->starting_point }}</td>
                <td>{{ $value->ending_point }}</td>
                <td>{{ $value->fare }}</td>
                <td>{{ $value->coach_type }}</td>
                <td>{{ $value->seats_available }}</td>
                <td>{{ $value->view }}</td>
                <td>
                    <a href="{{ url('editdata', ['id' => $value->id]) }}" class="btn btn-success">Edit</a>

                    <form id="delete-form-{{ $value->id }}" action="{{ route('bus.destroy', $value->id) }}"
                        method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>

                    <a href="#" class="btn btn-danger" onclick="event.preventDefault();
                            if(confirm('Are you sure you want to delete this bus record?')) {
                                document.getElementById('delete-form-{{ $value->id }}').submit();
                            }">
                        Delete
                    </a>
                </td>
            </tr>
            @endforeach
        </table>
        {{ $showdata->links() }}
    </div>

</body>

</html>