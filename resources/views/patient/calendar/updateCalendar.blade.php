<x-app-layout>

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta description="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/updatecalendar.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.5.2-web/css/all.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="header">
        <h4><i class="fa-solid fa-calendar-days"></i> Update Calendar</h4>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form class="form" method="post" action="{{ route('patient.updatedCalendar', $calendar->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $calendar->name) }}" required>
        </div>
        <div class="form-group">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" name="description" value="{{ old('description', $calendar->description) }}" required>
        </div>
        <div class="form-group form-inline">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" style="width: 35%;" id="date" name="date" value="{{ old('date', $calendar->date) }}" required>
            
            <label for="time" class="form-label time">Time</label>
            <input type="time" class="form-control" style="width: 25%;" id="time" name="time" value="{{ old('time') }}" required>
        </div>
        <div class="btn-container">
            <button type="submit" class="btn btn-light"><i class="fa-regular fa-calendar-check"></i> Update</button>
            <a href="{{ route('patient.calendar') }}" class="btn btn-light"><i class="fa-regular fa-calendar-minus"></i> Cancel</a>
        </div>
    </form>
</body>
</html>
@endsection

@section('title')
    Update Calendar
@endsection

</x-app-layout>