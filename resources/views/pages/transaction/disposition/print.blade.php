<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lembar Disposisi</title>
    <style>
        body {
            margin: 0;
            padding: 20px;
            font-family: 'Times New Roman', Times, serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px 10px;
            text-align: left;
            font-size: 13px;
        }

        th {
            background-color: #f0f0f0;
        }

        h2 {
            text-align: center;
            margin: 20px 0;
            text-transform: uppercase;
            text-decoration: underline;
            font-size: 18px;
        }

        .letter-ref {
            text-align: center;
            font-size: 13px;
            margin-bottom: 10px;
        }

        .footer {
            margin-top: 40px;
            text-align: right;
            font-size: 13px;
        }
    </style>
</head>
<body onload="window.print()">

    <x-letterhead :config="$config" />

    <h2>{{ __('model.disposition.print_title') }}</h2>

    <p class="letter-ref">
        {{ __('model.letter.reference_number') }}: {{ $letter->reference_number }}
        | {{ __('model.letter.letter_date') }}: {{ $letter->formatted_letter_date }}
        | {{ $letter->type == 'incoming' ? __('model.letter.from') : __('model.letter.to') }}: {{ $letter->type == 'incoming' ? $letter->from : $letter->to }}
    </p>

    <table>
        <thead>
        <tr>
            <th>No</th>
            <th>{{ __('model.disposition.to') }}</th>
            <th>{{ __('model.disposition.status') }}</th>
            <th>{{ __('model.disposition.due_date') }}</th>
            <th>{{ __('model.disposition.content') }}</th>
            <th>{{ __('model.disposition.note') }}</th>
        </tr>
        </thead>
        <tbody>
        @forelse($data as $disposition)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $disposition->to }}</td>
                <td>{{ $disposition->status?->status }}</td>
                <td>{{ $disposition->formatted_due_date }}</td>
                <td>{{ $disposition->content }}</td>
                <td>{{ $disposition->note }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="6" style="text-align: center;">{{ __('menu.general.empty') }}</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>
            {{ $config['institution_city'] ?? '' }}, {{ \Carbon\Carbon::now()->isoFormat('D MMMM YYYY') }}
            <br>
            {{ __('model.config.pic') }}
        </p>
        <br><br><br>
        <p style="font-weight: bold;">{{ $config['pic'] ?? '' }}</p>
    </div>

</body>
</html>
