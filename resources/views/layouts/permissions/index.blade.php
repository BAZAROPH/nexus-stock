@extends("app")
@section("title", "Gestion des permissions")

@section("breadcrumbs")
    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Permissions</li>
@endsection

@section("content")

@if(session('success'))
