@extends('layouts.app')

@section('title', 'Add Student')
@section('page-title', 'Create student')

@section('page-actions')
    <a href="{{ route('students.index') }}" class="btn btn-secondary">Back to list</a>
@endsection

@section('content')
    <section class="panel form-panel">
        <div class="panel-header">
            <div>
                <p class="eyebrow">Enrollment</p>
                <h3>Add a new student</h3>
            </div>
        </div>

        <form action="{{ route('students.store') }}" method="POST" class="stack-form">
            @csrf

            <div class="form-grid">
                <label class="field">
                    <span>Full name</span>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. Anshuman Singh" required >
                </label>

                <label class="field">
                    <span>Email address</span>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="student@email.com" required>
                </label>

                <label class="field">
                    <span>Phone number</span>
                    <input type="number" name="phone" value="{{ old('phone') }}" placeholder="+91 555 123 4567" required>
                </label>

                <label class="field">
                    <span>Course</span>
                    <input type="text" name="course" value="{{ old('course') }}" placeholder="Bachelor in Technology" required>
                </label>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Save student</button>
                <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </section>
@endsection
