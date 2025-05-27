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
    <style>
      body {
        font-family: "Poppins", sans-serif;
      }
    </style>
  </head>
  <body>
    <div class="bg-gradient-to-b from-[#CCFFC3] to-[#FFFFFF]">
      <!-- Navbar Section -->
      <section class="w-full px-4 mx-auto bg-opacity-0">
        <nav
          class="mx-auto px-4 flex flex-wrap p-6 justify-between items-center"
        >
          <div class="flex items-center">
            <a href="index.html" class="text-2xl font-bold">
              <img
                src="{{  asset('build/assets/Logo.png')}}"
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
                class="text-lg font-semibold flex gap-4 mr-0 lg:mr-24 mb-4 lg:mb-0"
              >
                <a href="#hero" class="hover:text-[#26C3F4]">Beranda</a>
                <a href="#about" class="hover:text-[#26C3F4]">Layanan</a>
                <a href="#skills" class="hover:text-[#26C3F4]">Tentang Kami</a>
              </div>

              <!-- Login & Register Buttons -->
              <div class="text-lg font-semibold flex gap-4">
                <a
                  href="register.html"
                  class="bg-[#46A616] text-white py-2 px-4 rounded-lg hover:bg-green-800 transition duration-300 shadow-lg"
                >
                  Daftar
                </a>
                <a
                  href="#"
                  class="bg-white text-[#46A616] border border-[#46A616] py-2 px-4 rounded-lg hover:bg-green-700 hover:text-white transition duration-300 shadow-lg"
                >
                  Masuk
                </a>
              </div>
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
              class="rounded-full px-10 py-2 my-10 text-lg text-white bg-[#46A616] hover:bg-green-700 transition duration-300"
            >
            <a href="register.html">Daftar Sekarang</a>
            </button>
          </div>

          <!-- Image Section: Hidden on mobile -->
          <div class="hidden lg:flex w-full lg:w-1/2 justify-center">
            <img
              src="{{  asset('build/assets/img_hero.png')}}"
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
        <img src="{{  asset('build/assets/img1.png')}}" alt="Pendaftaran Bank Sampah" />
      </div>
    </section>

    <!-- item 2 -->
    <section
      class="container mx-auto flex flex-col-reverse lg:flex-row items-center justify-between gap-10 px-6 lg:px-24 py-12"
    >
      <!-- Gambar -->
      <div class="flex justify-center">
        <img src="{{  asset('build/assets/img2.png')}}" alt="Pendaftaran Bank Sampah" />
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
        <img src="{{  asset('build/assets/img3.png')}}" alt="Pendaftaran Bank Sampah" />
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
        <button
          class="rounded-full px-10 py-2 my-10 text-lg text-white bg-[#46A616] hover:bg-green-700 transition duration-300 text-[20px]"
        >
          Layanan
        </button>
      </div>

      <!-- Gambar: disembunyikan di mobile -->
      <div class="hidden lg:flex justify-center">
        <img
          src="{{ asset('build/assets/img4.png') }}"
          alt="Pendaftaran Bank Sampah"
          class="max-w-full h-auto rounded-md"
        />
      </div>
    </section>

    <section class="py-12 mx-auto flex justify-center">
      <img src="{{ asset('build/assets/logo_drop.png') }}" alt="Logo" />
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
    </script>
  </body>
</html>
