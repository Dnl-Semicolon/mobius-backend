@extends('layouts.admin')
@section('title','Edit Store')
@section('content')
    <div class="bg-white border rounded p-6">
        <form method="post" action="{{ route('admin.stores.update', $store) }}">
            @method('PUT')
            @include('admin.stores._form', ['store'=>$store])
        </form>
    </div>
@endsection
