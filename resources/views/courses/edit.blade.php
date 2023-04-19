@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Course Detail</h1>
    </div>

    <div class="card">
        <div class="card-body" style="overflow-x: auto;overflow-y: hidden;">

            <form id="course-edit" action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <div class="d-flex w-100 gap-5 flex-wrap">
                        <div class="mb-3 flex-xxl-fill">
                            <label for="name" class="form-label">Course Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Course name" value="{{$course->name}}">
                        </div>
                        <div class="mb-3">
                            <label for="course_type" class="form-label">Course Type</label>
                            <select class="form-select" name="course_type" aria-label="course type">
                                @foreach($courseTypeList as $key => $item)
                                    <option value="{{$key}}" {{($course->course_type == $key) ? 'selected' : '' }}>{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="release_date" class="form-label">Release Date</label>
                            <input type="datetime-local" class="form-control" name="release_date" value="{{\Carbon\Carbon::parse($course->release_date)->format('Y-m-d H:i')}}">
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" name="status" aria-label="status">
                                @foreach($statusList as $key => $item)
                                    <option value="{{$key}}" {{($course->status == $key) ? 'selected' : '' }}>{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-3">
                    <a class="btn btn-danger" href="{{ route('courses.index') }}">Cancel</a>
                    <button type="submit" class="btn btn-success"">Save</a>
                </div>
            </form>
        </div>
    </div>
@endsection