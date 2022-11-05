<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Lockersystem</title>
</head>
<body>
    <div class="container">
        <h1>Locker summary</h1>

        @if (session('message'))
            {{ session('message') }}
        @endif
        @if (session('edit'))
            {{ session('edit') }}
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Locker number</th>
                    <th>Student name</th>
                    <th>Student number</th>
                    <th>Last hired</th>
                    <th>Last freed</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lockers as $locker)
                    <tr @if(!$locker->in_use) class="table-success" @endif>
                        <td>{{ $locker->locker_number }}</td>
                        @isset($locker->student->name)
                            <td>{{ $locker->student->name }}</td>
                        @else
                            <td></td>
                        @endisset

                        @isset($locker->student->student_number)
                            <td>{{ $locker->student->student_number }}</td>
                        @else
                            <td></td>
                        @endisset

                        @isset($locker->last_hired)
                            <td>{{ $locker->last_hired }}</td>
                        @else
                            <td>Not available</td>
                        @endisset

                        @isset($locker->last_freed)
                            <td>{{ $locker->last_freed }}</td>
                        @else
                            <td>Not available</td>
                        @endisset

                        <td>
                            {{-- @isset($locker->student->id)
                                <form action="{{ route('lockers.editStudent', $locker->student->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-danger">Remove Student</button>
                                </form>
                            @endisset --}}

                            <a class="btn btn-primary" href="{{ route('lockers.edit', $locker->id) }}">Edit</a>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>