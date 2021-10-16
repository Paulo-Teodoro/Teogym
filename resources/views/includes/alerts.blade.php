@if(session('info'))
    <div class="message info">
        <p>{{ session('info') }}</p>
    </div>
@endif

@if(session('success'))
    <div class="message success">
        <p>{{ session('success') }}</p>
    </div>
@endif

@if(session('warning'))
    <div class="message warning">
        <p>{{ session('warning') }}</p>
    </div>
@endif

@if(session('error'))
    <div class="message error">
        <p>{{ session('error') }}</p>
    </div>
@endif

@if ($errors->any())
    <ul class="error">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>       
@endif