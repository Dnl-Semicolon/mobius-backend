@extends('layouts.admin')
@section('title','New Bin')
@section('content')
    <form method="post" action="{{ route('admin.bins.store') }}" class="space-y-6">
        @csrf
        @include('admin.bins._form', ['submitLabel' => 'Create Bin'])
    </form>
@endsection
