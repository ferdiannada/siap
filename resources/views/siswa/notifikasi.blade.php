@extends('layouts.app')
@section('title','Notifikasi')

@section('content')
<div class="fade-slide">

    <!-- HEADER -->
    <div class="mb-4">
        <h4 class="fw-bold">
            <i class="bi bi-bell-fill text-primary"></i>
            Notifikasi
        </h4>
        <p class="text-muted mb-0">
            Pemberitahuan terkait aspirasi yang Anda kirim
        </p>
    </div>
    @if(session('success'))
    <div class="alert alert-success">
        <i class="bi bi-check-circle-fill"></i>
        {{ session('success') }}
    </div>
    @endif

    @if($notifikasi->count() == 0)
    <div class="text-center text-muted py-5">
        <i class="bi bi-bell-slash fs-1 mb-3"></i>
        <p class="mb-0">Belum ada notifikasi</p>
    </div>
    @else

    <div id="notifContainer" class="list-group shadow-sm">

        @if($notifikasi->whereNull('read_at')->count() > 0)
        <div class="d-flex justify-content-end mb-3">
            <form action="/siswa/notifikasi/read-all" method="POST"
                onsubmit="return confirm('Tandai semua notifikasi sebagai dibaca?')">
                @csrf
                <button class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-check2-all"></i>
                    Tandai Semua Dibaca
                </button>
            </form>
        </div>
        @endif

        @foreach($notifikasi as $n)
        <a href="/siswa/aspirasi/{{ $n->data['aspirasi_id'] }}{{ $n->read_at ? '' : '?notif='.$n->id }}" class="list-group-item list-group-item-action notif-item
                   {{ $n->read_at ? 'read' : 'unread' }}">

            <div class="d-flex align-items-start">
                <!-- ICON -->
                <div class="me-3">
                    <div class="notif-icon
                                {{ $n->read_at ? 'bg-secondary' : 'bg-primary' }}">
                        <i class="bi bi-info-circle-fill"></i>
                    </div>
                </div>

                <!-- CONTENT -->
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-1 fw-semibold">
                            {{ $n->data['judul'] ?? 'Notifikasi' }}
                        </h6>

                        @if(!$n->read_at)
                        <span class="badge bg-danger">
                            Baru
                        </span>
                        @endif
                    </div>

                    <p class="mb-1 text-muted">
                        {{ $n->data['pesan'] ?? '-' }}
                    </p>

                    <small class="text-muted">
                        <i class="bi bi-clock"></i>
                        {{ $n->created_at->diffForHumans() }}
                    </small>
                </div>
            </div>

        </a>
        @endforeach
        <!-- LOADING -->
        <div id="loading" class="text-center text-muted my-3 d-none">
            <i class="bi bi-arrow-repeat"></i>
            Memuat notifikasi...
        </div>

        <!-- END -->
        <div id="endMessage" class="text-center text-muted my-3 d-none">
            Tidak ada notifikasi lagi
        </div>

    </div>

    @endif

</div>
@endsection
@push('scripts')
<script>
    let nextPageUrl = "{{ $notifikasi->nextPageUrl() }}";
let loading = false;

window.addEventListener('scroll', () => {
    if (!nextPageUrl || loading) return;

    const nearBottom =
        window.innerHeight + window.scrollY >= document.body.offsetHeight - 200;

    if (nearBottom) {
        loadMoreNotifications();
    }
});

function loadMoreNotifications() {
    loading = true;
    document.getElementById('loading').classList.remove('d-none');

    fetch(nextPageUrl, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(res => res.json())
    .then(res => {

        res.data.forEach(n => {
            document.getElementById('notifContainer')
                .insertAdjacentHTML('beforeend', renderNotif(n));
        });

        nextPageUrl = res.next_page_url;

        if (!nextPageUrl) {
            document.getElementById('endMessage').classList.remove('d-none');
        }

        document.getElementById('loading').classList.add('d-none');
        loading = false;
    });
}

function renderNotif(n) {
    return `
    <a href="/siswa/aspirasi/${n.data.aspirasi_id}${n.read_at ? '' : '?notif='+n.id}"
       class="list-group-item list-group-item-action notif-item
       ${n.read_at ? 'read' : 'unread'}">

        <div class="d-flex align-items-start">
            <div class="me-3">
                <div class="notif-icon ${n.read_at ? 'bg-secondary' : 'bg-primary'}">
                    <i class="bi bi-info-circle-fill"></i>
                </div>
            </div>

            <div class="flex-grow-1">
                <div class="d-flex justify-content-between">
                    <h6 class="mb-1 fw-semibold">
                        ${n.data.judul ?? 'Notifikasi'}
                    </h6>
                    ${n.read_at ? '' : '<span class="badge bg-danger">Baru</span>'}
                </div>

                <p class="mb-1 text-muted">
                    ${n.data.pesan ?? '-'}
                </p>

                <small class="text-muted">
                    <i class="bi bi-clock"></i> baru saja
                </small>
            </div>
        </div>
    </a>
    `;
}
</script>
@endpush