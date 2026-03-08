@extends('layouts.admin')

@section('content')
<h1 class="mb-4 text-2xl font-bold">Create Project</h1>
<div class="rounded-xl bg-white p-6 shadow">@include('admin.projects._form')</div>
@endsection
