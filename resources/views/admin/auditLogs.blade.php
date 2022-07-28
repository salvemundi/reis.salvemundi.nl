@extends('layouts.app')
@section('content')
    <script>
        setActive("logs");
    </script>


    <div class="row">
        <div class="col-12 col-lg-6 container">
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif
            <div class="table-responsive">
                <h1 class="display-5">Audit logs</h1>
                <table id="table" data-toggle="table" data-search="true" data-sortable="true" data-pagination="true"
                       data-show-columns="true">
                    <thead>
                    <tr class="tr-class-1">
                        <th data-field="name" data-sortable="true">Wie</th>
                        <th data-field="description" data-sortable="true">Wat</th>
                        <th data-field="when" data-sortable="true">Wanneer</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($logs as $log)
                            <tr id="tr-id-3" class="tr-class-2" data-title="bootstrap table">
                                <td data-value="{{ $log->user->displayName }}">{{ $log->user->displayName }}</td>
                                <td data-value="{{ $log->description }}">{{ $log->description }}</td>
                                <td data-value="{{ $log->created_at }}">{{ $log->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
