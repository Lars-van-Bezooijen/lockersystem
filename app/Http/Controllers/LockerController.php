<?php

namespace App\Http\Controllers;

use App\Models\Locker;
use App\Models\Student;
use Illuminate\Http\Request;

class LockerController extends Controller
{
    public function show()
    {
        $lockers = Locker::all();
        return view('lockers', [
            'lockers' => $lockers
        ]);
    }

    public function edit($id)
    {
        // $locker = Locker::find($id);
        // $locker->student_id = null;
        // $locker->save();
        // return redirect()->route('lockers.show')->with('message', 'Student has been removed from locker');
        $locker = Locker::find($id);
        $students = Student::all();
        return view('edit', [
            'locker' => $locker,
            'students' => $students
        ]);
    }

    public function update($id)
    {
        $locker = Locker::find($id);
        if(request('student_id') == 'null') 
        {
            $locker->student_id = null;
            $locker->last_freed = now();
            $locker->in_use = false;
        }
        else 
        {
            $locker->student_id = request('student_id');
            $locker->last_hired = now();
            $locker->last_freed = null;
            $locker->in_use = true;
        }
        $locker->save();

        return redirect()->route('lockers.show')->with('edit', 'Student has been assigned to locker');
    }
}
