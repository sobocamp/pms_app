<form method="post" action="{{ route('password.update') }}" class="mt-0">
    @csrf
    @method('put')

    @if (session('status') === 'password-updated')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Password berhasil diperbarui.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="mb-3">
        <label class="form-label">Password Saat Ini</label>
        <input id="current_password" name="current_password" type="password"
               class="form-control @error('current_password') is-invalid @enderror" autocomplete="current-password" />
        @error('current_password') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Password Baru</label>
        <input id="password" name="password" type="password"
               class="form-control @error('password') is-invalid @enderror" autocomplete="new-password" />
        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Konfirmasi Password Baru</label>
        <input id="password_confirmation" name="password_confirmation" type="password"
               class="form-control @error('password_confirmation') is-invalid @enderror" autocomplete="new-password" />
        @error('password_confirmation') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <button class="btn btn-primary">
        Ubah Password
    </button>
</form>
