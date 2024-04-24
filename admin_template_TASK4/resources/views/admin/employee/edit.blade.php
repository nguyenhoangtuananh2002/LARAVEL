@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <x-form :action="route('admin.employee.update')" type="put" :validate="true">
                <x-input type="hidden" name="id" :value="$employee->id" />
                <div class="row justify-content-center">
                    @include('admin.employee.forms.edit-left')
                    @include('admin.employee.forms.edit-right')
                </div>
                @include('admin.forms.actions-fixed')
            </x-form>
        </div>
    </div>
@endsection
