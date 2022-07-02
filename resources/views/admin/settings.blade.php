@extends('layouts.app')
@section('content')
<script>
    setActive("settings");
</script>
<div class="row">
    <div class="col-12 col-md-6 container">
        <h1>Instellingen Intro tool</h1>
        <div class="table-responsive">
            <table id="table" data-toggle="table" data-search="true" data-sortable="true" data-pagination="true"
                   data-show-columns="true">
                <thead>
                <tr class="tr-class-1">
                    <th data-field="name" data-sortable="true">Naam</th>
                    <th data-field="value" data-sortable="true">Waarde</th>
                    <th data-field="edit" data-sortable="true">Bewerk</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($settings as $setting)
                    @include('include/settingEditModal', ['setting' => $setting])
                    <tr id="tr-id-3" class="tr-class-2" data-title="bootstrap table">
                        <td data-value="{{ $setting->name }}">{{ $setting->description }}</td>
                        <td data-value="{{ $setting->value }}">{{ $setting->value }}</td>
                        <td data-value="{{ $setting->value }}">
                            <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#edit{{ $setting->id }}">
                                Bewerk
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
