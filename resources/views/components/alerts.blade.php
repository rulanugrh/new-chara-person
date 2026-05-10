@if(session('success'))
    <div class="mb-6 rounded-2xl bg-emerald-50 border border-emerald-200 p-4 text-sm text-emerald-900">
        {{ session('success') }}
    </div>
@endif

@if(session('warning'))
    <div class="mb-6 rounded-2xl bg-amber-50 border border-amber-200 p-4 text-sm text-amber-900">
        {{ session('warning') }}
    </div>
@endif

@if($errors->any())
    <div class="mb-6 rounded-2xl bg-rose-50 border border-rose-200 p-4 text-sm text-rose-900">
        <div class="font-semibold">Terjadi kesalahan</div>
        <ul class="mt-2 list-disc list-inside">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
