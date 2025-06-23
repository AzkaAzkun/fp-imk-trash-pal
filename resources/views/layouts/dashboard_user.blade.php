<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap"
      rel="stylesheet"
    />
    <link rel="icon" type="image/png" href="{{ asset('images/favicon-logo.png') }}">
    <style>
      body {
        font-family: "Poppins", sans-serif;
      }
    </style>
  </head>

  <body class="relative min-h-screen overflow-x-hidden font-[Poppins]">
    <!-- LAYER BACKGROUND -->
    <div class="absolute inset-0 -z-10">
      <div
        class="absolute inset-0 bg-gradient-to-b from-[#ccffc3b2] to-[#FFFFFF]"
      ></div>
    </div>

    <!-- KONTEN UTAMA -->
    <div class="relative z-10">
      <!-- Navbar Section -->
      <section class="w-full px-4 mx-auto bg-opacity-0">
        <nav
          class="mx-auto px-6 flex flex-wrap p-2 justify-between items-center"
        >
          <div class="flex items-center">
            <a href="{{ route('home') }}" class="text-2xl font-bold">
              <img
                src="{{  asset('images/Logo.png')}}"
                alt="Logo"
                class="w-60 h-20 object-cover object-[center_20%] block"
              />
            </a>
          </div>
        </nav>
      </section>

    <div class="flex flex-col lg:flex-row gap-8 p-4 pt-2 max-w-[85rem] mx-auto min-h-[800px]">
        <!-- Main Form -->

        @yield('sidebar')
        @yield('akun-saya')
        @yield('request-penjemputan')
        @yield('riwayat-penjemputan')
    </div>
    <!-- Script: Toggle Mobile Menu -->
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const buttons = document.querySelectorAll(".tab-btn");
        const formAkunEdit = document.getElementById("formAkunEdit");
        const formAkun = document.getElementById("formAkun");
        const formRequestEdit = document.getElementById("formRequestEdit")
        const formRequest = document.getElementById("formRequest")
        const btnToEdit = document.getElementById("btnToEdit");
        const btnBatalEdit = document.getElementById("btnBatalEdit");
        const btnToRequest = document.getElementById("btnToRequest");
        const btnBatalRequest = document.getElementById("btnBatalRequest");
        const sections = ["formAkun", "formRequest", "formRiwayat", "formAkunEdit", "formRequestEdit"];

        buttons.forEach(btn => {
            btn.addEventListener("click", function (e) {
                e.preventDefault();
                const target = this.getAttribute("data-target");

                // Hide semua section
                sections.forEach(id => {
                    const el = document.getElementById(id);
                    if (el) el.classList.add("hidden");
                });

                // Show target
                const targetEl = document.getElementById(target);
                if (targetEl) targetEl.classList.remove("hidden");

                buttons.forEach(b => {
                    b.classList.remove("bg-[#46A616]", "text-white", "shadow-md");
                    b.classList.add("bg-white", "text-black","hover:bg-[#ebffe3]");
                });

                this.classList.remove("bg-white", "text-black","hover:bg-[#ebffe3]");
                this.classList.add("bg-[#46A616]", "text-white", "shadow-md");
            });
        });

        if (btnToEdit) {
            btnToEdit.addEventListener("click", function (e) {
                e.preventDefault();

                sections.forEach(id => {
                    const el = document.getElementById(id);
                    if (el) el.classList.add("hidden");
                });

                if (formAkunEdit) formAkunEdit.classList.remove("hidden");
            });
        }

        if (btnBatalEdit) {
            btnBatalEdit.addEventListener("click", function (e) {
                e.preventDefault();

                const formInEdit = document.querySelector("#formAkunEdit form");
                if (formInEdit) formInEdit.reset();

                // Sembunyikan semua section
                sections.forEach(id => {
                    const el = document.getElementById(id);
                    if (el) el.classList.add("hidden");
                });

                // Tampilkan kembali formAkun
                if (formAkun) formAkun.classList.remove("hidden");
            });
        }

        if (btnToRequest) {
            btnToRequest.addEventListener("click", function (e) {
                e.preventDefault();

                sections.forEach(id => {
                    const el = document.getElementById(id);
                    if (el) el.classList.add("hidden");
                });

                if (formRequestEdit) formRequestEdit.classList.remove("hidden");
            });
        }

        if (btnBatalRequest) {
            btnBatalRequest.addEventListener("click", function (e) {
                e.preventDefault();

                const formInEdit = document.querySelector("#formRequestEdit form");
                if (formInEdit) formInEdit.reset();

                // Sembunyikan semua section
                sections.forEach(id => {
                    const el = document.getElementById(id);
                    if (el) el.classList.add("hidden");
                });

                // Tampilkan kembali formAkun
                if (formRequest) formRequest.classList.remove("hidden");
            });
        }

    });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const btnShow = document.getElementById('btnShowPasswordForm');
            const modal = document.getElementById('passwordFormModal');
            const btnClose = document.getElementById('btnClosePasswordForm');

            if (btnShow && modal && btnClose) {
            btnShow.addEventListener('click', () => {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            });

            btnClose.addEventListener('click', () => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            });
        }
    });
    </script>
    <script>
    const penjemputans = @json($penjemputans);

    function showDetail(id) {
        const data = penjemputans.find(p => p.id === id);
        if (!data) return;

        document.getElementById('modalContent').innerHTML = `
            <p><strong>Invoice:</strong> ${data.nomor_invoice}</p>
            <p><strong>Status:</strong> ${data.status}</p>
            <p><strong>Alamat Penjemputan:</strong> ${data.alamat_penjemputan}</p>
            <p><strong>Tanggal:</strong> ${new Date(data.tanggal_penjemputan).toLocaleDateString('id-ID', {
                year: 'numeric', month: 'long', day: 'numeric'
            })}</p>
            <p><strong>Volume:</strong> ${data.volume ?? '-'} kg</p>
        `;
        document.getElementById('detailModal').classList.remove('hidden');
        document.getElementById('detailModal').classList.add('flex');
    }

    function closeDetail() {
        document.getElementById('detailModal').classList.add('hidden');
        document.getElementById('detailModal').classList.remove('flex');
    }
</script>
  </body>
  @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            confirmButtonColor: '#46A616'
        });
    </script>
    @endif
</html>
