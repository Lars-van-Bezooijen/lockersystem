<?php

namespace App\Http\Controllers;

use App\Models\Locker;
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
        $locker->student_id = null;
        $locker->save();
        return redirect()->route('lockers.show')->with('message', 'Student has been removed from locker');
    }
}
