<x-layouts.base>
    @php
        $role = auth()->check() ? auth()->user()->role : null;
        $adminRoutes = [
            'dashboard', 'scan-member', 'non-member', 'edit-biaya-pendaftaran', 'membership-plan', 'member',
            'payment', 'payment-form', 'membership-plan-form', 'member-form', 'member-confirmation',
            'member-card', 'non-member-form', 'receipt', 'receipt-member','kasir-dashboard', 'midtrans-payment'
        ];

        $kasirRoutes = [
            'dashboard', 'kasir-dashboard', 'non-member', 'payment', 'receipt', 'receipt-member', 'scan-member','dashboard','member-form', 
            'member-confirmation','member-card','non-member-form', 'midtrans-payment'
        ];
    @endphp

    @if($role === 'admin' && in_array(request()->route()->getName(), $adminRoutes))
        @include('layouts.nav')
        @include('layouts.sidenav')
        <main class="content">
            @include('layouts.topbar')
            {{ $slot }}
            @include('layouts.footer')
        </main>

    @elseif($role === 'kasir' && in_array(request()->route()->getName(), $kasirRoutes))
        @include('layouts.nav')
        @include('layouts.sidenav') {{-- Buat side nav khusus kasir kalau perlu --}}
        <main class="content">
            @include('layouts.topbar') {{-- Topbar bisa sama atau beda dengan admin --}}
            {{ $slot }}
            @include('layouts.footer')
        </main>

    @elseif(in_array(request()->route()->getName(), ['register', 'register-example', 'login', 'login-example',
        'forgot-password', 'forgot-password-example', 'reset-password','reset-password-example']))

        {{ $slot }}
        @include('layouts.footer2')

    @elseif(in_array(request()->route()->getName(), ['404', '500', 'lock']))
        {{ $slot }}
    @endif
</x-layouts.base>