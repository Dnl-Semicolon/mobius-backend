@extends('layouts.admin')
@section('title','New Store')
@section('content')
    <div class="bg-white border rounded p-6">
        <form method="post" action="{{ route('admin.stores.store') }}">
            @include('admin.stores._form')
        </form>
    </div>
@endsection
