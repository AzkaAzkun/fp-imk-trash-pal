<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Dashboard</title>
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
  <body class="bg-gradient-to-b from-[#ccffc3b2] via-[#FFFFFF] to-[#ccffc3b2]">
    <div>
      <!-- Navbar Section -->
      <section class="w-full px-4 mx-auto bg-opacity-0">
        <nav
          class="mx-auto px-4 flex flex-wrap p-6 justify-between items-center"
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

          <!-- Hamburger Button -->
          <button
            id="menu-toggle"
            class="lg:hidden p-2 border border-[#26C3F4] rounded"
          >
            <svg
              class="w-6 h-6 text-black"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              viewBox="0 0 24 24"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M4 6h16M4 12h16M4 18h16"
              />
            </svg>
          </button>

          <!-- Menu Items -->
            <div
                id="menu"
                class="w-full lg:flex hidden mt-4 lg:mt-0 lg:w-auto lg:items-center"
            >
                <div class="flex flex-col lg:flex-row w-full items-center">
                    <div
                        class="text-lg font-semibold flex gap-7 mr-0 lg:mr-24 mb-4 lg:mb-0"
                    >
                        <a href="{{ route('home') }}" class="hover:text-[#515151] px-[19px] py-[13px]">Beranda</a>
                        <a href="{{ route('layanan') }}" class="hover:text-[#515151] px-[19px] py-[13px]">Layanan</a>
                        <a href="{{ route('tentang') }}" class="hover:text-[#515151] px-[19px] py-[13px]">Tentang Kami</a>
                    </div>

                    @auth
                        <div class="relative inline-block text-left">
                            <!-- Trigger -->
                            <div onclick="toggleMenu()" class="flex items-center gap-2 cursor-pointer">
                                <img
                                    src="{{ auth()->user()->foto_profil
                                        ? asset('storage/foto_profil/' . auth()->user()->foto_profil)
                                        : asset('images/foto-default.png') }}"
                                    alt="Foto Profil"
                                    class="w-10 h-10 rounded-full object-cover"
                                />
                                <p class="text-lg font-semibold px-[19px] py-[13px]">
                                    {{ explode(' ', auth()->user()->nama)[0] }}
                                </p>
                            </div>

                            <!-- Dropdown -->
                            <div id="dropdownMenu"
                                class="hidden absolute right-0 mt-2 w-[300px] bg-[#f8fff9] border rounded-xl shadow-lg z-50 p-3">
                                <div
                                    class="flex justify-center py-5"
                                >
                                    <img
                                        src="{{ auth()->user()->foto_profil
                                            ? asset('storage/foto_profil/' . auth()->user()->foto_profil)
                                            : asset('images/foto-default.png') }}"
                                        alt="Foto Profil"
                                        class="w-[56px] h-[56px] rounded-full object-cover"
                                    />
                                </div>
                                <div class="text-center mb-4">
                                    <p class="text-lg font-semibold">{{ auth()->user()->nama }}</p>
                                    <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
                                </div>
                                <a href="{{ route('dashboard') }}"
                                    class="block px-4 py-3 text-xl hover:text-[#46A616]">Dashboard</a>
                                <form
                                    action="{{ route('auth.logout') }}"
                                    method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left px-4 py-3 text-xl hover:text-[#46A616]">Keluar</button>
                                </form>
                            </div>
                        </div>
                    @endauth

                    @guest
                    <!-- Login & Register Buttons -->
                    <div class="text-lg font-semibold flex gap-4">
                        <a
                        href="{{ route('register') }}"
                        class="bg-[#46A616] text-white px-[23px] py-[11px] rounded-[15px] hover:bg-green-800 transition duration-300 shadow-lg p-4"
                        >
                        Daftar
                        </a>
                        <a
                        href="{{ route('login') }}"
                        class="bg-white text-[#46A616] border border-[#46A616] px-[23px] py-[11px] rounded-[15px] hover:bg-green-700 hover:text-white transition duration-300 shadow-lg"
                        >
                        Masuk
                        </a>
                    </div>
                    @endguest
                </div>
            </div>
        </nav>
      </section>

      <!-- Hero Section -->
      <section id="hero" class="w-full bg-opacity-0">
        <div
          class="container mx-auto flex flex-col lg:flex-row items-center justify-between px-6 lg:px-24 py-16"
        >
          <!-- Text Section -->
          <div class="w-full lg:w-1/2 mb-8 lg:mb-0 text-center lg:text-left">
            <h2 class="text-[48px] lg:text-[72px] leading-snug font-bold">
              Bank Sampah<br />
              <span class="text-[#46A616]"> Digital </span>
            </h2>
            <p
              class="text-gray-600 text-[20px] lg:text-[30px] leading-relaxed mt-4"
            >
              Kemudahan sekarang ada di tangan Anda.
              <span class="text-[#46A616] font-semibold">TrashPal</span> hadir
              untuk anda.
            </p>
            <button
              class="rounded-[18px] px-[19px] py-[13px] my-10 text-lg text-white bg-[#46A616] hover:bg-green-700 transition duration-300 w-[206px] h-[53px]"
            >
            <a href="{{ route('register') }}">Daftar Sekarang</a>
            </button>
          </div>

          <!-- Image Section: Hidden on mobile -->
          <div class="hidden lg:flex w-full lg:w-1/2 justify-center">
            <img
              src="{{  asset('images/img_hero.png')}}"
              class="max-w-full h-auto"
              alt="Hero Image"
            />
          </div>
        </div>
      </section>
    </div>

    <!-- Mengapa TrashPal Section -->
    <section>
      <div class="py-24 mx-auto">
        <h2 class="font-bold text-center text-[72px] leading-snug">
          Mengapa <span class="text-[#46A616]">TrashPal</span> ?
        </h2>
      </div>
    </section>

    <!-- item 1 -->
    <section
      class="container mx-auto flex flex-col lg:flex-row items-center justify-between gap-10 px-6 lg:px-24 py-12 text-center lg:text-left"
    >
      <!-- Teks -->
      <div class="w-full lg:w-1/2">
        <h1 class="font-bold mb-4 text-[40px] lg:text-[40px] leading-snug">
          Pendaftaran ke bank <br />
          sampah terdekat
        </h1>
        <p class="text-gray-600 text-[24px] lg:text-[24px] leading-relaxed">
          TrashPal langsung mendaftarkan anda <br />
          ke bank sampah terdekat.
        </p>
      </div>
      <!-- Gambar -->
      <div class="flex justify-center">
        <img src="{{  asset('images/img1.png')}}" alt="Pendaftaran Bank Sampah" />
      </div>
    </section>

    <!-- item 2 -->
    <section
      class="container mx-auto flex flex-col-reverse lg:flex-row items-center justify-between gap-10 px-6 lg:px-24 py-12"
    >
      <!-- Gambar -->
      <div class="flex justify-center">
        <img src="{{  asset('images/img2.png')}}" alt="Pendaftaran Bank Sampah" />
      </div>

      <!-- Teks -->
      <div class="w-full lg:w-1/2 text-center lg:text-right">
        <h1 class="font-bold mb-2 text-[40px] leading-snug">
          Permintaan jemputan <br />sampah oleh petugas
        </h1>
        <p class="text-gray-600 text-[24px] leading-relaxed">
          TrashPal akan mengirim petugas untuk <br />
          mengangkut sampah anda sesuai <br />
          permintaan.
        </p>
      </div>
    </section>

    <!-- item 3 -->
    <section
      class="container mx-auto flex flex-col lg:flex-row items-center justify-between gap-10 px-6 lg:px-24 py-12 text-center lg:text-left"
    >
      <!-- Teks -->
      <div class="w-full lg:w-1/2">
        <h1 class="font-bold mb-2 text-[40px] leading-snug">
          Edukasi & Cek riwayat <br />
          penjemputan sampah
        </h1>
        <p class="text-gray-600 text-[24px] leading-relaxed">
          TrashPal memberikan informasi terkait <br />
          pengolahan sampah & mencatat setiap <br />
          penjemputan yang terjadi.
        </p>
      </div>
      <!-- Gambar -->
      <div class="flex justify-center">
        <img src="{{  asset('images/img3.png')}}" alt="Pendaftaran Bank Sampah" />
      </div>
    </section>

    <!-- Mengapa TrashPal Section -->
    <section>
      <div class="py-24 mx-auto">
        <h2 class="text-[82px] font-bold text-center">
          Jadilah Duta <span class="text-[#46A616]">TrashPal</span>?
        </h2>
      </div>
    </section>

    <!-- item 4 -->
    <section
      class="container mx-auto flex flex-col lg:flex-row items-center justify-between gap-10 px-6 lg:px-24 py-12 text-center lg:text-left"
    >
      <!-- Teks -->
      <div class="w-full lg:w-1/2 mb-8 lg:mb-0 inline-block align-middle">
        <h1 class="font-bold mb-2 text-[44px] leading-snug">
          Mulai dari rumah <br />
          bersama <span class="text-[#46A616] font-semibold">TrashPal</span>
        </h1>
        <p class="text-gray-600 text-[24px] leading-relaxed">
          TrashPal adalah aplikasi sahabatmu untuk mengenal, memilah, dan
          mengakses bank sampah secara mudah dan menyenangkan. Bukan sekadar
          informasi, jemputan—kami hadir untuk bantu wujudkan lingkungan yang
          lebih hijau bersama <span class="text-[#46A616]">KAMU</span> dari
          rumah.
        </p>
         @auth
        <a href="{{ route('dashboard') }}"
            class="inline-block rounded-[18px] px-[19px] py-[13px] my-10 text-lg text-white bg-[#46A616] hover:bg-green-700 transition duration-300 text-[20px] w-[206px] h-[53px] text-center">
            Layanan
        </a>
        @else
        <a href="{{ route('login') }}"
            class="inline-block rounded-[18px] px-[19px] py-[13px] my-10 text-lg text-white bg-[#46A616] hover:bg-green-700 transition duration-300 text-[20px] w-[206px] h-[53px] text-center">
            Layanan
        </a>
        @endauth
      </div>

      <!-- Gambar: disembunyikan di mobile -->
      <div class="hidden lg:flex justify-center">
        <img
          src="{{ asset('images/img4.png') }}"
          alt="Pendaftaran Bank Sampah"
          class="max-w-full h-auto rounded-md"
        />
      </div>
    </section>

    <section class="py-12 mx-auto flex justify-center">
      <img src="{{ asset('images/logo_drop.png') }}" alt="Logo" />
    </section>
    <footer class="bg-[#46A616] text-white py-6">
      <div class="container mx-auto text-center font-bold text-[24px]">
        <p>&copy;TrashPal.co | PT.Amamiya 2025</p>
      </div>
    </footer>
    <!-- JavaScript for Hamburger Toggle -->
    <script>
        const toggleBtn = document.getElementById("menu-toggle");
        const menu = document.getElementById("menu");

        toggleBtn.addEventListener("click", () => {
            menu.classList.toggle("hidden");
        });

        function toggleMenu() {
            const menu = document.getElementById('dropdownMenu');
            const isHidden = menu.classList.contains('hidden');

            if (isHidden) {
                menu.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            } else {
                menu.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }
        }

        // Optional: klik di luar untuk nutup menu
        document.addEventListener('click', function (event) {
            const dropdown = document.getElementById('dropdownMenu');
            const trigger = event.target.closest('.cursor-pointer');
            if (!trigger && !event.target.closest('#dropdownMenu')) {
                dropdown?.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }
        });
    </script>
  </body>
</html>
