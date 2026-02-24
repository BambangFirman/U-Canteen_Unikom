<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/assets/fontawesome/css/all.min.css">
    <title>{{ $title ?? 'Admin | U-Canteen' }}</title>
    <style>
        body { background-color: #f4f6f9; }
        .admin-sidebar {
            background: linear-gradient(135deg, #8B1A1A 0%, #6B0F0F 100%);
            min-height: 100vh;
            padding-top: 1rem;
        }
        .admin-sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            border-radius: 8px;
            margin: 4px 10px;
            transition: all 0.2s;
        }
        .admin-sidebar .nav-link:hover,
        .admin-sidebar .nav-link.active {
            background: rgba(255,255,255,0.15);
            color: #fff;
        }
        .admin-sidebar .nav-link i {
            width: 24px;
            margin-right: 10px;
        }
        .admin-brand {
            color: #fff;
            font-weight: bold;
            font-size: 1.3rem;
            padding: 15px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 1rem;
        }
        .admin-content { padding: 30px; }
        .stat-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            transition: transform 0.2s;
        }
        .stat-card:hover { transform: translateY(-3px); }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 admin-sidebar p-0">
                <div class="admin-brand">
                    <i class="bi bi-shop"></i> U-Canteen Admin
                </div>
                <nav class="nav flex-column">
                    <a class="nav-link {{ request()->is('admin') ? 'active' : '' }}" href="/admin">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                    <a class="nav-link {{ request()->is('admin/shops*') ? 'active' : '' }}" href="/admin/shops">
                        <i class="bi bi-shop-window"></i> Kelola Toko
                    </a>
                    <a class="nav-link {{ request()->is('admin/categories*') ? 'active' : '' }}" href="/admin/categories">
                        <i class="bi bi-tags"></i> Kelola Kategori
                    </a>
                    <hr class="text-white mx-3">
                    <form action="/logout" method="post" class="mx-3">
                        @csrf
                        <button type="submit" class="nav-link text-start w-100 border-0 bg-transparent" style="color: rgba(255,255,255,0.8);">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </button>
                    </form>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 admin-content">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- SweetAlert untuk session flash --}}
    @if(session()->has('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session()->get("success") }}',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true
        });
    </script>
    @endif

    @if(session()->has('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session()->get("error") }}',
            confirmButtonColor: '#d33'
        });
    </script>
    @endif

    {{-- SweetAlert konfirmasi hapus --}}
    <script>
        document.querySelectorAll('.btn-delete').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                var form = this.closest('form');
                var itemName = this.getAttribute('data-name') || 'item ini';
                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: 'Data "' + itemName + '" akan dihapus permanen!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then(function(result) {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
