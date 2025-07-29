<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Success
    Livewire.on('swal:success', payload => {
        console.log('Received success data:', payload);
        const data = payload.data ?? {};
        Swal.fire({
            icon: 'success',
            title: data.title || 'Success',
            text: data.text || 'Something happened!',
            confirmButtonColor: '#3085d6'
        });
    });

    // Error
    Livewire.on('swal:error', payload => {
        console.log('Received error data:', payload);
        const data = payload.data ?? {};
        Swal.fire({
            icon: 'error',
            title: data.title || 'Error',
            text: data.text || 'Something went wrong!',
            confirmButtonColor: '#d33'
        });
    });

    // Info
    Livewire.on('swal:info', payload => {
        console.log('Received info data:', payload);
        const data = payload.data ?? {};
        Swal.fire({
            icon: 'info',
            title: data.title || 'Info',
            text: data.text || 'Here is some information.',
            confirmButtonColor: '#3085d6'
        });
    });

    // Warning
    Livewire.on('swal:warning', payload => {
        console.log('Received warning data:', payload);
        const data = payload.data ?? {};
        Swal.fire({
            icon: 'warning',
            title: data.title || 'Warning',
            text: data.text || 'Be careful!',
            confirmButtonColor: '#f39c12'
        });
    });
</script>

{{-- Non-Livewire session-based alert --}}
@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'সফল!',
            text: @json(session('success')),
            confirmButtonColor: '#3085d6'
        });
    </script>
@endif