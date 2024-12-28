<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Courses;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resources.
     */
    public function index()
    {
        // Retrieve all courses from the database
        $courses = Courses::all();

        // Return the courses as a JSON response
        return response()->json($courses);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate incoming request data
            $validatedData = $request->validate([
                'course_name' => 'required|string|max:255',
                'course_code' => 'required|string|max:50|unique:courses,course_code',
            ]);
    
            // Create a new course and store it in the database
            $course = Courses::create($validatedData);
    
            // Return the created course as a JSON response
            return response()->json([
                'success' => true,
                'message' => 'Course created successfully.',
                'data' => $course,
            ], 201); // 201 indicates resource created
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            return response()->json([
                'success' => false,
                'message' => 'Validation error.',
                'errors' => $e->errors(), // Detailed validation errors
            ], 422); // 422 indicates unprocessable entity
        } catch (\Exception $e) {
            // Handle other exceptions
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating the course.',
                'error' => $e->getMessage(), // Include the exception message
            ], 500); // 500 indicates server error
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the course by its ID, or return a 404 if not found
        $course = Courses::findOrFail($id);

        // Return the course as a JSON response
        return response()->json($course);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate incoming request data
        $request->validate([
            'course_name' => 'sometimes|required|string|max:255',
            'course_code' => 'sometimes|required|string|max:50|unique:courses,course_code,' . $id,
        ]);

        // Find the course by ID
        $course = Courses::findOrFail($id);

        // Update the course with new data
        $course->update($request->only(['course_name', 'course_code']));

        // Return the updated course as a JSON response
        return response()->json($course);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the course by ID
        $course = Courses::findOrFail($id);

        // Delete the course from the database
        $course->delete();

        // Return a 204 No Content response indicating success
        return response()->json(null, 204);
    }
}
