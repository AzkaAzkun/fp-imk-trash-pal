<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
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
        @yield('dashboard')
        @yield('request-penjemputan')
        @yield('catatan-penjemputan')
    </div>
    <!-- Script: Toggle Mobile Menu -->
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const buttons = document.querySelectorAll(".tab-btn");
        const formAkunEdit = document.getElementById("formAkunEdit");
        const formAkun = document.getElementById("formAkun");
        const btnToEdit = document.getElementById("btnToEdit");
        const btnBatalEdit = document.getElementById("btnBatalEdit");
        const sections = ["formAkun", "formRequest", "formRiwayat", "formAkunEdit", "formDashboard"];

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
    });
    </script>
  </body>
</html>
