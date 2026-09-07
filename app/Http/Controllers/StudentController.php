<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index( Request $request)
    {
        if (isset($_GET['course'])) {
            $course = $_GET['course'];
        } else {
            $course = null;
        }
       $course = $request->query('course');
       if($course) {
        $students = Student::where('course', $course)->get();
       } else {
        $students = Student::all();
       }

    return view('students.index', compact('students','course'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!$request->name || !$request->email || !$request->phone || !$request->course) {
            return redirect()->back()->with('error', 'All fields are required.');
        }
        $studentData =[
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'course' => $request->course
        ];
        $student = new Student();

    $student->name = $studentData['name'];
    $student->email = $studentData['email'];
    $student->phone = $studentData['phone'];
    $student->course = $studentData['course'];

    $student->save();

    return redirect()->route('students.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
          $student = Student::findOrFail($id);

    return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $student = Student::findOrFail($id);

    $student->name = $request->name;
    $student->email = $request->email;
    $student->phone = $request->phone;
    $student->course = $request->course;

    $student->save();

    return redirect()->route('students.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $student = Student::findOrFail($id);

    $student->delete();

    return redirect()->route('students.index');
    }
}
