<div class="btn-group d-inline">
    <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: x-small;">
        Tools
    </button>
    <div class="dropdown-menu dropdown-menu-open position-absolute">
        @if (!in_array($pelamar->status, ['Accepted', 'Declined']))
        <button class="btn btn-success btn-proceed btn-sm dropdown-item" data-id="{{ $pelamar->id }}" data-toggle="modal" data-target="#ProceedModal-{{ $pelamar->id }}">
            <i class="fa fa-cogs"></i> Proses
        </button>
        @endif
        <a href="https://wa.me/62{{$pelamar->UserData->no_hp}}" class="dropdown-item" target="_blank">
            <i class="fa fa-phone-alt"></i> Contact/WA
        </a>
        <a href="{{ route('admin.activity_pelamar', $pelamar->id) }}" class="dropdown-item">
            <i class="fa fa-paper-plane"></i> Activity
        </a>
        <a href="{{ route("admin.show_pelamar", ['pelamar' => $pelamar->id] ) }}" class="dropdown-item">
            <i class="fa fa-file"></i> Detail
        </a>
        <button class="btn btn-danger btn-hapus btn-sm dropdown-item" data-id="{{ $pelamar->id }}" data-toggle="modal" data-target="#DeleteModal-{{ $pelamar->id }}">
            <i class="fa fa-user-times"></i> Hapus
        </button>
    </div>
</div>
