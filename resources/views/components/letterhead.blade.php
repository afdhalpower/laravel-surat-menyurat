<div style="display: flex; align-items: center; justify-content: center; margin-bottom: 10px;">
    @if(!empty($config['institution_logo']))
        <div style="margin-right: 15px;">
            <img src="{{ asset('storage/' . $config['institution_logo']) }}" alt="Logo" style="max-height: 70px; width: auto;">
        </div>
    @endif
    <div style="text-align: center;">
        <h1 style="margin: 0; font-size: 22px; text-transform: uppercase;">{{ $config['institution_name'] }}</h1>
        <p style="margin: 3px 0 0; font-size: 12px;">
            {{ $config['institution_address'] }}
            @if(!empty($config['institution_city']))
                , {{ $config['institution_city'] }}
            @endif
        </p>
        <p style="margin: 0; font-size: 11px;">
            @if(!empty($config['institution_phone']))
                Telp: {{ $config['institution_phone'] }}
            @endif
            @if(!empty($config['institution_email']))
                | Email: {{ $config['institution_email'] }}
            @endif
        </p>
    </div>
</div>
<hr style="border: 1px solid black; margin: 0 0 15px;">
