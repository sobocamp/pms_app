<form method="post" action="{{ route('profile.destroy') }}" class="mt-0">
    @csrf
    @method('delete')

    <button class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus akun ini? Tindakan tidak dapat dibatalkan.')">
        Hapus Akun
    </button>
</form>
