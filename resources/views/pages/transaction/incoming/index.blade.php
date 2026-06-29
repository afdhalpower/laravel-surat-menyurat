@extends('layout.main')

@section('content')
    <x-breadcrumb
        :values="[__('menu.transaction.menu'), __('menu.transaction.incoming_letter')]">
        <a href="{{ route('transaction.incoming.create') }}" class="btn btn-primary">{{ __('menu.general.create') }}</a>
        <a href="{{ route('transaction.incoming.pdf', request()->query()) }}" target="_blank" class="btn btn-success">{{ __('menu.general.export_pdf') }}</a>
        <a href="{{ route('transaction.incoming.excel', request()->query()) }}" target="_blank" class="btn btn-info">{{ __('menu.general.export_excel') }}</a>
    </x-breadcrumb>

    <div class="card mb-3">
        <div class="card-body">
            <form method="GET" action="{{ route('transaction.incoming.index') }}" class="row g-3">
                <input type="hidden" name="search" value="{{ $search }}">
                <div class="col-md-4">
                    <label class="form-label">{{ __('menu.agenda.start_date') }}</label>
                    <input type="date" name="since" value="{{ $since ?? '' }}" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label">{{ __('menu.agenda.end_date') }}</label>
                    <input type="date" name="until" value="{{ $until ?? '' }}" class="form-control">
                </div>
                <div class="col-md-2">
                    <label class="form-label">{{ __('menu.agenda.filter_by') }}</label>
                    <select name="filter" class="form-control">
                        <option value="letter_date" @selected(($filter ?? 'letter_date') == 'letter_date')>{{ __('model.letter.letter_date') }}</option>
                        <option value="received_date" @selected(($filter ?? '') == 'received_date')>{{ __('model.letter.received_date') }}</option>
                        <option value="created_at" @selected(($filter ?? '') == 'created_at')>{{ __('model.general.created_at') }}</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">{{ __('menu.general.filter') }}</button>
                    <a href="{{ route('transaction.incoming.index') }}" class="btn btn-secondary">{{ __('menu.general.cancel') }}</a>
                </div>
            </form>
        </div>
    </div>

    @foreach($data as $letter)
        <x-letter-card
            :letter="$letter"
        />
    @endforeach

    {!! $data->appends(['search' => $search, 'since' => $since, 'until' => $until, 'filter' => $filter])->links() !!}
@endsection
