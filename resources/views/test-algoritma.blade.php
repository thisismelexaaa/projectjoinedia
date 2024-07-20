<!DOCTYPE html>
<html>

<head>
    <title>Optimized Schedule</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1 class="mt-5">Optimized Event Schedule</h1>

        <form method="GET" action="{{ url('/algoritma-genetika') }}" class="form-inline mb-4">
            <div class="form-group mr-2">
                <label for="start_date" class="mr-2">Start Date</label>
                <input type="date" name="start_date" class="form-control" value="{{ request()->get('start_date') }}">
            </div>
            <div class="form-group mr-2">
                <label for="end_date" class="mr-2">End Date</label>
                <input type="date" name="end_date" class="form-control" value="{{ request()->get('end_date') }}">
            </div>
            <div class="form-group mr-2">
                <label for="location" class="mr-2">Location</label>
                <input type="text" name="location" class="form-control" value="{{ request()->get('location') }}">
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>

        <!-- Display Best Individual -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Nama</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Type</th>
                    <th>Organizer</th>
                    <th>Status</th>
                    <th>Kategori</th>
                    <th>Location</th>
                    <th>Level</th>
                    <th>Harga Event</th>
                    <th>Kuota</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bestIndividual as $event)
                    <tr>
                        <td>{{ $event['id'] }}</td>
                        <td>{{ $event['user_id'] }}</td>
                        <td>{{ $event['nama'] }}</td>
                        <td>{{ $event['start_date'] }}</td>
                        <td>{{ $event['end_date'] }}</td>
                        <td>{{ $event['type'] }}</td>
                        <td>{{ $event['organizer'] }}</td>
                        <td>{{ $event['status'] }}</td>
                        <td>{{ $event['kategori'] }}</td>
                        <td>{{ $event['location'] }}</td>
                        <td>{{ $event['level'] }}</td>
                        <td>{{ $event['price'] }}</td>
                        <td>{{ $event['kuota'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
