@extends('adminlte::page')

@section('content')
    <!-- Your content here -->
    @if(session('error'))
    <div class="alert alert-danger" id="error-message">
        {{ session('error') }}
    </div>
    @endif
@endsection

@push('scripts')
<script>
    // Check if there's an error message, and hide it after 3 seconds
    window.onload = function() {
        let errorMessage = document.getElementById('error-message');
        if (errorMessage) {
            setTimeout(function() {
                errorMessage.style.display = 'none';
            }, 3000); // 3000 milliseconds = 3 seconds
        }
    }
</script>
@endpush
