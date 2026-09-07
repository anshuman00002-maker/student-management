@extends('layouts.app')

@section('title', 'Students Overview')
@section('page-title', 'Student Dashboard')

@section('page-actions')
    <a href="{{ route('students.create') }}" class="btn btn-primary">Add student</a>
@endsection

@section('content')
    <section class="stats-grid">
        <div class="stat-card accent-blue">
            <span class="stat-label">Total students</span>
            <strong>{{ $students->count() }}</strong>
            <small>Active records</small>
        </div>
        <div class="stat-card accent-purple">
            <span class="stat-label">Courses</span>
            <strong>{{ $students->pluck('course')->unique()->count() }}</strong>
            <small>Distinct programs</small>
        </div>
        <div class="stat-card accent-green">
            <span class="stat-label">Enrollment</span>
            <strong>96%</strong>
            <small>On track</small>
        </div>
    </section>

    <section class="panel">
        <div class="panel-header">
            <div>
                <p class="eyebrow">Directory</p>
                <h3>Student records</h3>
                @if(isset($course)&& $course)
                <p>Course from URL: {{ $course }}</p>
                @endif
                </div>
            <div class="search-pill">{{ $students->count() }} listed</div>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Course</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $student)
                        <tr>
                            <td>
                                <div class="user-cell">
                                    <span class="avatar">{{ strtoupper(substr($student->name, 0, 1)) }}</span>
                                    <div>
                                        <strong>{{ $student->name }}</strong>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->phone }}</td>
                            <td><span class="tag">{{ $student->course }}</span></td>
                            <td>
                                <div class="action-group">
                                    <a href="{{ route('students.edit', $student->id) }}" class="link-btn edit">Edit</a>
                                    <form action="{{ route('students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Delete this student record?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="link-btn danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="empty-state">
                                <div>
                                    <h4>No students found</h4>
                                    <p>Create the first student profile to start tracking your academic records.</p>
                                    <a href="{{ route('students.create') }}" class="btn btn-primary">Create student</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
