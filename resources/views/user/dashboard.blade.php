@extends('layouts.dashboard_user')

@section('sidebar')
<!-- Sidebar -->
<aside class="bg-white shadow-xl rounded-[33px] p-6 w-full lg:[width:33.33333%] flex flex-col items-center text-center">
    <form action="{{ route('user.updatePhoto') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input type="file" id="fotoInput" name="foto_profil" class="hidden" onchange="this.form.submit()">

        <label for="fotoInput" class="cursor-pointer">
            <img
                src="{{ auth()->user()->foto_profil
                    ? asset('storage/foto_profil/' . auth()->user()->foto_profil)
                    : asset('images/foto-default.png') }}"
                alt="Foto Profil"
                class="h-24 w-24 rounded-full object-cover my-2 hover:opacity-80 transition"
            />
        </label>
    </form>
    <h2 class="text-xl font-semibold">{{ auth()->user()->nama }}</h2>
    <p class="text-base text-gray-600 mb-10">{{ auth()->user()->email }}</p>
    <div class="flex flex-col gap-4 w-full">
        <a href="#" class="tab-btn bg-[#46A616] text-white font-semibold justify-center flex px-4 py-2 rounded-[15px] items-center text-sm mb-4 w-full h-[51px] md:text-xl" data-target="formAkun"><i class="ph ph-user-circle mr-2 text-3xl"></i>Akun Saya</a>
        <a href="#" class="tab-btn font-semibold justify-center flex px-4 py-2 rounded-[15px] items-center text-sm mb-4 w-full h-[51px] md:text-xl hover:bg-[#ebffe3]" data-target="formRequest"><i class="ph ph-box-arrow-up mr-2 text-3xl"></i>Request Penjemputan</a>
        <a href="#" class="tab-btn font-semibold justify-center flex px-4 py-2 rounded-[15px] items-center text-sm mb-4 w-full h-[51px] md:text-xl hover:bg-[#ebffe3]" data-target="formRiwayat"><i class="ph ph-clock-counter-clockwise mr-2 text-3xl"></i>Riwayat Penjemputan</a>
    </div>
    <div class="mt-12 w-[90%] flex flex-col gap-4">
        <form action="">
            <a href="#" class="bg-[#46A616] hover:bg-[#46A616d0] font-semibold text-white text-semibold justify-center flex px-4 py-2 rounded-[15px] items-center gap-4 text-sm mb-4 w-full h-[51px] shadow-md md:text-xl">Ganti Password</a>
        </form>
        <form
            action="{{ route('auth.logout') }}"
            method="POST">
            @csrf
        <button
            type="submit"
            class="bg-[#E05555] hover:bg-[#E05555d0] font-semibold text-white px-4 py-2 gap-4 rounded-[15px] w-full h-[51px] text-sm shadow-md md:text-xl">Keluar</button>
        </form>
    </div>
</aside>
@endsection

@section('akun-saya')
<!-- Form Akun Saya -->
<main id="formAkun" class="bg-white shadow-xl rounded-[33px] p-12 w-full lg:[width:77.777777%]">
    <p class="text-black text-xl font-semibold">Home > <span class="text-black font-semibold">Akun Saya</span></p>
    <h1 class="text-4xl font-bold my-4">Akun <span class="text-[#46A616]">Saya</span></h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block font-semibold mb-1 text-xl">Nama</label>
            <p class="w-full rounded text-base py-3 text-gray-600">{{ auth()->user()->nama }}</p>
        </div>

        <div>
            <label class="block font-semibold mb-1 text-xl">Tanggal Lahir</label>
            <p class="w-full rounded text-base py-3 text-gray-600">{{ auth()->user()->tanggal_lahir ?? '-'}}</p>
        </div>

        <div>
            <label class="block font-semibold mb-1 text-xl">Nomor Telepon</label>
            <p class="w-full rounded text-base py-3 text-gray-600">{{ auth()->user()->nomor_telepon }}</p>
        </div>

        <div>
            <label class="block font-semibold mb-1 text-xl">Email</label>
            <p class="w-full rounded text-base py-3 text-gray-600">{{ auth()->user()->email }}</p>
        </div>

        <div>
            <label class="block font-semibold mb-1 text-xl">Alamat</label>
            <p class="w-full rounded text-base py-3 text-gray-600">{{ auth()->user()->alamat ?? '-' }}</p>
        </div>

        <div>
            <label class="block font-semibold mb-1 text-xl">Jenis Kelamin</label>
            <p class="mt-3 text-base text-gray-600">
                @if (auth()->user()->jenis_kelamin === 'L')
                    Laki - Laki
                @elseif (auth()->user()->jenis_kelamin === 'P')
                    Perempuan
                @else
                    -
                @endif
            </p>
        </div>

        <div class="col-span-2 mt-12">
            <button id="btnToEdit" class="bg-[#46A616] text-white font-semibold px-6 py-2 rounded-[15px] min-w-[170px] min-h-[47px] hover:bg-[#46A616d0] transition duration-300">Ubah</button>
        </div>
    </div>
</main>

<!-- Form Akun Saya -->
<main id="formAkunEdit" class="bg-white shadow-xl rounded-[33px] p-12 w-full lg:[width:77.777777%] hidden">
    <p class="text-black text-xl font-semibold">Home > <span class="text-black font-semibold">Akun Saya</span></p>
    <h1 class="text-4xl font-bold my-4">Akun <span class="text-[#46A616]">Saya</span></h1>

    <form
        action="{{ route('user.updateProfil') }}"
        method="POST"
        class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block font-semibold mb-1 text-xl">Nama</label>
            <input type="text" name="nameInput" placeholder="Masukkan Nama Anda" value="{{ auth()->user()->nama }}" required class="w-full border rounded p-3" />
        </div>

        <div>
            <label class="block font-semibold mb-1 text-xl">Tanggal Lahir</label>
            <input
                type="date"
                name="tanggalLahirInput"
                value="{{ auth()->user()->tanggal_lahir }}"
                class="w-full border rounded p-3" />
        </div>

        <div>
            <label class="block font-semibold mb-1 text-xl">Nomor Telepon</label>
            <input type="tel" name="phoneInput" placeholder="Masukkan Nomor Telepon Anda" value="{{ auth()->user()->nomor_telepon }}" class="w-full border rounded p-3" required/>
        </div>

        <div>
            <label class="block font-semibold mb-1 text-xl">Email</label>
            <input type="email" value="{{ auth()->user()->email }}" readonly class="w-full border rounded p-3" />
        </div>

        <div class="col-span-2">
            <label class="block font-semibold mb-1 text-xl">Alamat</label>
            <input
                type="text"
                name="alamatInput"
                placeholder="Masukkan alamat tempat tinggal anda"
                value="{{ auth()->user()->alamat }}"
                class="w-full border rounded p-3" />
        </div>

        <div>
            <label class="block font-semibold mb-1 text-xl">Jenis Kelamin</label>
            <div class="flex items-center gap-4 mt-3">
                <label class="inline-flex items-center">
                    <input
                        type="radio"
                        name="genderInput"
                        value="L"
                        class="mr-2 accent-[#46A616]"
                        required
                        @checked(auth()->user()->jenis_kelamin === 'L')
                    />
                    Laki - Laki
                </label>
                <label class="inline-flex items-center">
                    <input
                        type="radio"
                        name="genderInput"
                        value="P"
                        class="mr-2 accent-[#46A616]"
                        @checked(auth()->user()->jenis_kelamin === 'P')
                    />
                    Perempuan
                </label>
            </div>
            @if ($errors->has('genderInput'))
                <p class="text-sm text-red-500 mt-1">
                    {{ $errors->first('genderInput') }}
                </p>
            @endif
        </div>

        <div class="col-span-2 mt-4 flex gap-5">
            <button id="btnBatalEdit" class="bg-white border border-[#46A616] text-[#46A616] font-semibold px-6 py-2 rounded-[15px] min-w-[170px] min-h-[47px] hover:bg-[#ebffe3] hover:text-[#46A616] transition duration-300">Batal</button>
            <button type="submit" class="bg-[#46A616] text-white font-semibold px-6 py-2 rounded-[15px] min-w-[170px] min-h-[47px] hover:bg-[#46A616d0] transition duration-300">Simpan</button>
        </div>
    </form>
</main>
@endsection

@section('request-penjemputan')
<!-- Form Request Penjemputan -->
<main id="formRequest" class="hidden bg-white shadow-xl rounded-[33px] p-12 w-full lg:[width:77.777777%]">
    <p class="text-black font-semibold">
    Home > <span class="text-black font-semibold">Request Penjemputan</span>
    </p>
    <h1 class="text-2xl font-bold my-4">
    Request <span class="text-[#46A616]">Penjemputan</span>
    </h1>

    <form class="mt-4 space-y-4">
    <!-- Pilih Bank & Tanggal Penjemputan -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
        <label class="block font-semibold mb-1">Pilih Bank Sampah</label>
        <select class="border rounded p-2 w-full">
            <option selected disabled>Pilih Bank Sampah</option>
            <option>Bank Sampah A</option>
            <option>Bank Sampah B</option>
        </select>
        </div>

        <div>
            <label class="block font-semibold mb-1">Tanggal Penjemputan</label>
            <input type="date" class="border rounded p-2 w-full" />
        </div>
        <div>
            <label class="block font-semibold mb-1">Volume Sampah (kg)</label>
            <input type="number" step="0.01" min="0" placeholder="Contoh: 2.5" class="border rounded p-2 w-full" />
        </div>
    </div>

    <!-- Alamat -->
    <div>
        <label class="block font-semibold mb-1">Alamat</label>
        <input
        type="text"
        placeholder="Masukkan alamat tempat tinggal anda"
        class="w-full border rounded p-2"
        />
    </div>

    <!-- Tombol Kirim -->
    <div>
        <button
        type="submit"
        class="bg-[#46A616] hover:bg-[#3d9014] shadow-md text-white px-6 py-2 rounded font-semibold"
        >
        Buat Request
        </button>
    </div>
    </form>
</main>
@endsection

@section('riwayat-penjemputan')
<!-- Riwayat Penjemputan -->
<main id="formRiwayat" class="hidden bg-white shadow-xl rounded-[33px] p-12 w-full lg:[width:77.777777%]">
    <p class="text-black font-semibold">Home > <span class="text-black font-semibold">Riwayat Penjemputan</span></p>
    <h1 class="text-2xl font-bold my-4">Request <span class="text-[#46A616]">Penjemputan</span></h1>
    <ul class="list-disc ml-5 space-y-2 text-sm">
    <li>12 Juni 2025 - Penjemputan sukses</li>
    <li>5 Juni 2025 - Penjemputan dibatalkan</li>
    <li>27 Mei 2025 - Penjemputan sukses</li>
    </ul>
</main>
@endsection
