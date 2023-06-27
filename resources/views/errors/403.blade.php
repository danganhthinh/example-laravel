@extends('errors::illustrated-layout')

@section('title', __('Access Denied / Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: "Looks like you're not authorized to access this page"))
@section('image')
    <div style="background-image: url({{ asset('/svg/403.svg') }});" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
    </div>
@endsection
