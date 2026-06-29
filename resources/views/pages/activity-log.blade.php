@extends('layout.main')

@section('content')
    <x-breadcrumb
        :values="[__('menu.activity_log')]">
    </x-breadcrumb>

    <div class="card">
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                <tr>
                    <th>{{ __('model.user.name') }}</th>
                    <th>{{ __('model.general.description') }}</th>
                    <th>{{ __('model.general.created_at') }}</th>
                </tr>
                </thead>
                @if($data->count())
                    <tbody>
                    @foreach($data as $log)
                        <tr>
                            <td>{{ $log->user->name }}</td>
                            <td>{{ $log->description }}</td>
                            <td>{{ $log->created_at->diffForHumans() }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                @else
                    <tbody>
                    <tr>
                        <td colspan="3" class="text-center">{{ __('menu.general.empty') }}</td>
                    </tr>
                    </tbody>
                @endif
            </table>
        </div>
    </div>

    {!! $data->links() !!}
@endsection
