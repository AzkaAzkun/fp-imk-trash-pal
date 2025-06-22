<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login TrashPal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
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

  <body class="relative min-h-screen overflow-x-hidden font-[Poppins]">
    <!-- LAYER BACKGROUND -->
    <div class="absolute inset-0 -z-10">
      <div
        class="absolute inset-0 bg-gradient-to-b from-[#CCFFC3] to-[#FFFFFF]"
      ></div>
      <div
        class="absolute inset-0 bg-[url('./assets/bg-login.png')] bg-cover bg-center bg-no-repeat opacity-50"
        style="background-image: url('{{ asset('images/bg-login.png') }}')"
      ></div>
    </div>

    <!-- KONTEN UTAMA -->
    <div class="relative z-10">
      <!-- Navbar Section -->
      <section class="w-full px-4 mx-auto">
        <nav
          class="mx-auto px-4 flex flex-wrap p-6 justify-between items-center relative"
        >
          <!-- Logo -->
          <div class="flex items-center">
            <a href="landing.html" class="text-2xl font-bold">
              <img
                src="{{ asset('images/Logo.png') }}"
                alt="Logo"
                class="w-60 h-20 object-cover object-[center_20%] block"
              />
            </a>
          </div>
        </nav>
      </section>

      <!-- Register Section -->
      <section
        class="flex flex-col lg:flex-row items-center justify-center px-6 pb-10 pt-24 gap-10"
      >
        <!-- Form -->
        <div class="bg-white p-6 rounded-[33px] shadow-md w-full max-w-[600px] min-h-[540px]">
            <div class="flex flex-col md:flex-row items-center mb-5 mt-[35px] px-6 gap-4">
                <a href="{{ route('home') }}" class="p-2 rounded-full hover:bg-gray-100 transition duration-300 text-gray-600">
                    <i class="ph ph-arrow-left text-2xl"></i>
                </a>

                <h1 class="text-3xl md:text-5xl font-bold text-center md:text-left">
                    Login <span class="text-[#46A616]">TrashPal</span>
                </h1>
            </div>

          <form
            action="{{ route('auth.login') }}"
            method='POST'
            class="space-y-5 px-6">
            @csrf
           {{-- form email --}}
            <div>
                <label class="block text-xl font-light mb-3">Email</label>
                <input
                    type="email"
                    id="emailInput"
                    placeholder="Masukkan email anda"
                    required
                    name="emailInput"
                    class="w-full border rounded-[6px] p-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#46A616]"
                    onblur="markTouched(this)"
                />
                @if ($errors->has('emailInput'))
                    <p class="text-sm text-red-500 mt-1">
                        {{ $errors->first('emailInput') }}
                    </p>
                @endif
                <p id="emailError" class="text-sm text-red-500 mt-1 hidden">
                    Format email tidak valid
                </p>
            </div>
            {{-- form kata sandi --}}
            <div class="relative">
                <label class="block text-xl font-light mb-3 ">Kata Sandi</label>
                <div class="relative">
                    <input
                        id="passwordInput"
                        type="password"
                        required
                        name="passwordInput"
                        placeholder="Buat kata sandi"
                        class="w-full border rounded-[6px] p-2 pr-10 focus:outline-none focus:ring-2 focus:ring-[#46A616]"
                    />
                    @if ($errors->has('passwordInput'))
                        <p class="text-sm text-red-500 mt-1">
                            {{ $errors->first('passwordInput') }}
                        </p>
                    @endif
                    <!-- Ikon mata -->
                    <button
                        type="button"
                        onclick="togglePassword()"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-[#46A616] cursor-pointer"
                    >
                        <i id="eyeIcon" class="ph ph-eye text-xl"></i>
                    </button>
                </div>
            </div>

            <button
              type="submit"
              class="bg-[#46A616] text-white font-semibold w-full py-2 rounded-[15px] shadow hover:shadow-md !mt-[50px] hover:bg-green-700 transition duration-300 h-[47px]"
            >
              Masuk
            </button>
          </form>

          <p class="text-sm text-center mt-4">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-[#46A616] font-medium hover:text-green-800">Daftar</a>
          </p>
        </div>

      </section>
    </div>

    <!-- Script: Toggle Mobile Menu -->
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const toggle = document.getElementById("menu-toggle");
        const menu = document.getElementById("menu");

        toggle.addEventListener("click", function () {
          menu.classList.toggle("hidden");
        });
      });

    function togglePassword() {
        const input = document.getElementById("passwordInput");
        const icon = document.getElementById("eyeIcon");

        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("ph-eye");
            icon.classList.add("ph-eye-slash");
        } else {
            input.type = "password";
            icon.classList.remove("ph-eye-slash");
            icon.classList.add("ph-eye");
        }
    }
    </script>
  </body>
</html>
