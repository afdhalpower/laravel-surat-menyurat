<style>
    .letterhead-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 10px;
    }
    .letterhead-logo {
        margin-right: 15px;
    }
    .letterhead-logo img {
        max-height: 70px;
        width: auto;
    }
    .letterhead-body {
        text-align: center;
    }
    .letterhead-body h1 {
        margin: 0;
        font-size: 22px;
        text-transform: uppercase;
    }
    .letterhead-body p {
        margin: 3px 0 0;
        font-size: 12px;
    }
    .letterhead-body .contact {
        margin: 0;
        font-size: 11px;
    }
    .letterhead-divider {
        border: 1px solid black;
        margin: 0 0 15px;
    }
</style>

<div class="letterhead-wrapper">
    @if(!empty($config['institution_logo']))
        <div class="letterhead-logo">
            <img src="{{ asset('storage/' . $config['institution_logo']) }}" alt="Logo">
        </div>
    @endif
    <div class="letterhead-body">
        <h1>{{ $config['institution_name'] }}</h1>
        <p>
            {{ $config['institution_address'] }}
            @if(!empty($config['institution_city']))
                , {{ $config['institution_city'] }}
            @endif
        </p>
        <p class="contact">
            @if(!empty($config['institution_phone']))
                Telp: {{ $config['institution_phone'] }}
            @endif
            @if(!empty($config['institution_email']))
                | Email: {{ $config['institution_email'] }}
            @endif
        </p>
    </div>
</div>
<hr class="letterhead-divider">
