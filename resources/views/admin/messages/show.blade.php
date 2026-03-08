@extends('layouts.admin')
@section('content')
<a class="text-cyan-600" href="{{ route('admin.messages.index') }}">Back</a>
<div class="mt-4 rounded-xl bg-white p-6 shadow">
    <h1 class="text-2xl font-bold">{{ $message->subject }}</h1>
    <p class="mt-2 text-sm text-slate-500">From {{ $message->name }} ({{ $message->email }}) @if($message->phone)- {{ $message->phone }}@endif</p>
    <p class="mt-6 whitespace-pre-line text-sm">{{ $message->message }}</p>
</div>
@endsection
