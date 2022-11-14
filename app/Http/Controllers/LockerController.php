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
        $locker = Locker::find($id);
        $students = Student::all();
        return view('edit', [
            'locker' => $locker,
            'students' => $students
        ]);
    }

    public function update(Request $request, $id)
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
            // if student has a locker, dont assign locker
            $locker_user = Locker::where('student_id', request('student_id'))->first();
            if(isset($locker_user)) 
            {
                return redirect()->back()->with('error', 'Student already has a locker');
            }

            $locker->student_id = request('student_id');
            $locker->last_hired = now();
            $locker->last_freed = null;
            $locker->in_use = true;
        }
        $locker->save();

        return redirect()->route('lockers.show')->with('edit', 'Student has been assigned to locker');
    }
}
