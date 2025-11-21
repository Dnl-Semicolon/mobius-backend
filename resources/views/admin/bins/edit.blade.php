@extends('layouts.admin')
@section('title','Edit Bin')
@section('content')
    <form method="post" action="{{ route('admin.bins.update', $bin) }}" class="space-y-6">
        @csrf
        @method('PUT')
        @include('admin.bins._form', ['submitLabel' => 'Update Bin'])
    </form>
@endsection
