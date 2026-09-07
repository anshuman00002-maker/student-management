@extends('layouts.app')

@section('title', 'Edit Student')
@section('page-title', 'Update student')

@section('page-actions')
    <a href="{{ route('students.index') }}" class="btn btn-secondary">Back to list</a>
@endsection

@section('content')
    <section class="panel form-panel">
        <div class="panel-header">
            <div>
                <p class="eyebrow">Profile</p>
                <h3>Edit student information</h3>
            </div>
        </div>

        <form action="{{ route('students.update', $student->id) }}" method="POST" class="stack-form">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <label class="field">
                    <span>Full name</span>
                    <input type="text" name="name" value="{{ old('name', $student->name) }}" required>
                </label>

                <label class="field">
                    <span>Email address</span>
                    <input type="email" name="email" value="{{ old('email', $student->email) }}" required>
                </label>

                <label class="field">
                    <span>Phone number</span>
                    <input type="text" name="phone" value="{{ old('phone', $student->phone) }}" required>
                </label>

                <label class="field">
                    <span>Course</span>
                    <input type="text" name="course" value="{{ old('course', $student->course) }}" required>
                </label>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Update student</button>
                <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </section>
@endsection
