<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\DataTables\CoursesDataTable;
use App\Http\Requests\CourseRequest;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CoursesDataTable $dataTable)
    {
        return $dataTable->render('courses.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseRequest $request)
    {
        dd($request);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $course = Course::find($id);

        $statusList = Course::STATUSES;
        $courseTypeList = Course::COURSE_TYPES;

        return view('courses.edit', compact('course', 'statusList', 'courseTypeList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseRequest $request, string $id)
    {
        $course = Course::find($id);
        
        $course->update($request->all());

        return back()->with('alert-success', 'Başarılı bir şekilde kaydedilmiştir.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $course = Course::find($id);
        $course->delete();

        return back()->with('alert-success', 'Başarılı bir şekilde silinmiştir.');
    }
}
