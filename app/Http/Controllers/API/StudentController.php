<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Student;
use Validator;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();

        // return response
        $response = [
            'success' => true,
            'message' => 'Students retrieved successfully.',
            'products' => $students,
        ];
        return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'city' => 'required'            
        ]);

        if ($validator->fails()) {
            // return response
            $response = [
                'success' => false,
                'message' => 'Validation Error.', $validator->errors(),
            ];
            return response()->json($response, 404);
        }

        $student = Student::create($input);

        // return response
        $response = [
            'success' => true,
            'message' => 'Student created successfully.',
        ];
        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::find($id);

        if (is_null($student)) {
            // return response
            $response = [
                'success' => false,
                'message' => 'student not found.',
            ];
            return response()->json($response, 404);
        }

        // return response
        $response = [
            'success' => true,
            'message' => 'Student retrieved successfully.',
        ];
        return response()->json($response, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'city' => 'required'    
        ]);

        if ($validator->fails()) {
            // return response
            $response = [
                'success' => false,
                'message' => 'Validation Error.', $validator->errors(),
            ];
            return response()->json($response, 404);
        }

        $student->name = $input['name'];
        $student->email = $input['email'];
        $student->mobile = $input['mobile'];
        $student->dob = $input['dob'];
        $student->gender = $input['gender'];
        $student->city = $input['city'];

        $student->save();

        // return response
        $response = [
            'success' => true,
            'message' => 'Student updated successfully.',
        ];
        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();

        // return response
        $response = [
            'success' => true,
            'message' => 'Student deleted successfully.',
        ];
        return response()->json($response, 200);
    }
}
