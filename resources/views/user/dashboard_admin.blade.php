@extends('layouts.dashboard_admin')

@php
    use Illuminate\Support\Facades\Auth;
    use App\Models\User;
    use App\Models\UserPenjemputan;
    use Carbon\Carbon;

    $penjemputanSelesai = UserPenjemputan::where('status', 'selesai')->where('bank_sampah_id',auth()->user()->id)->count();
    $penjemputanDitolak = UserPenjemputan::where('status', 'ditolak')->where('bank_sampah_id',auth()->user()->id)->count();
    $sampahDiterima = UserPenjemputan::where('status', 'selesai')->where('bank_sampah_id',auth()->user()->id)->sum('volume');
    $jumlahUserAktif = UserPenjemputan::distinct('user_id')->where('bank_sampah_id',auth()->user()->id)->count('user_id');
@endphp

@section('sidebar')
<!-- Sidebar -->
<aside class="bg-white shadow-xl rounded-[33px] p-6 w-full lg:[width:25%] flex flex-col items-center text-center">
    <img src="{{  asset('images/Logo.png')}}" alt="Logo"
              class="w-60 h-20 object-cover object-[center_20%]" />
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
                class="h-[135px] w-[150px] object-cover mt-2 mb-4 hover:opacity-80 transition"
            />
        </label>
    </form>
    <h2 class="text-xl font-semibold">{{ auth()->user()->nama }}</h2>
    <p class="text-base text-gray-600 mb-8">{{ auth()->user()->email }}</p>
    <div class="flex flex-col w-full">
        <div class="flex flex-col w-full">
            <a href="#" class="tab-btn bg-[#46A616] text-white font-semibold justify-center flex px-4 py-2 rounded-[15px] items-center text-sm mb-2 w-full h-[51px] md:text-base" data-target="formDashboard"><i class="ph ph-house-line mr-2 text-3xl"></i>Dashboard</a>
            <a href="#" class="tab-btn font-semibold justify-center flex px-4 py-2 rounded-[15px] items-center text-sm mb-2 w-full h-[51px] md:text-base hover:bg-[#ebffe3]" data-target="formRequest"><i class="ph ph-box-arrow-up mr-2 text-3xl"></i>Request Penjemputan</a>
            <a href="#" class="tab-btn font-semibold justify-center flex px-4 py-2 rounded-[15px] items-center text-sm mb-2 w-full h-[51px] md:text-base hover:bg-[#ebffe3]" data-target="formRiwayat"><i class="ph ph-clock-counter-clockwise mr-2 text-3xl"></i>Catatan Penjemputan</a>
        </div>
        <div class="border-t-2 my-4 border-black w-full"></div>
        <a href="#" class="tab-btn font-semibold justify-center flex px-4 py-2 rounded-[15px] items-center text-sm w-full h-[51px] md:text-base hover:bg-[#ebffe3]" data-target="formAkun"><i class="ph ph-user-circle mr-2 text-3xl"></i>Akun Saya</a>
    </div>
    <div class="mt-12 w-[90%] flex flex-col gap-4">
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
<main id="formAkun" class="hidden bg-white shadow-xl rounded-[33px] p-12 w-full lg:[width:77.777777%]">
    <p class="text-black text-xl font-semibold">Home > <span class="text-black font-semibold">Akun Saya</span></p>
    <h1 class="text-4xl font-bold my-4">Akun <span class="text-[#46A616]">Saya</span></h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block font-semibold mb-1 text-xl">Nama Bank Sampah</label>
            <p class="w-full rounded text-base py-3 text-gray-600">{{ auth()->user()->nama }}</p>
        </div>

        <div>
            <label class="block font-semibold mb-1 text-xl">Alamat</label>
            <p class="w-full rounded text-base py-3 text-gray-600">{{ auth()->user()->alamat ?? '-' }}</p>
        </div>

        <div>
            <label class="block font-semibold mb-1 text-xl">Nomor Telepon</label>
            <p class="w-full rounded text-base py-3 text-gray-600">{{ auth()->user()->nomor_telepon }}</p>
        </div>

        <div>
            <label class="block font-semibold mb-1 text-xl">Email</label>
            <p class="w-full rounded text-base py-3 text-gray-600">{{ auth()->user()->email }}</p>
        </div>

        <div class="col-span-2 mt-12">
            <button id="btnToEdit" class="bg-[#46A616] text-white font-semibold px-6 py-2 rounded-[15px] min-w-[170px] min-h-[47px] hover:bg-[#46A616d0] transition duration-300 mr-3">Ubah</button>
            <button
                type="button"
                id="btnShowPasswordForm"
                class="bg-[#46A616] text-white font-semibold px-6 py-2 rounded-[15px] min-w-[170px] min-h-[47px] hover:bg-[#46A616d0] transition duration-300">
                Ganti Password
            </button>
        </div>
        <div id="passwordFormModal" class="fixed inset-0 bg-black bg-opacity-40 items-center justify-center z-50 hidden">
            <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 relative">
                <h2 class="text-xl font-bold mb-4">Ganti Password</h2>
                <form action="{{ route('user.updatePassword') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block font-semibold mb-1">Password Lama</label>
                    <input type="password" name="current_password" class="w-full border rounded p-2" required>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold mb-1">Password Baru</label>
                    <input type="password" name="new_password" class="w-full border rounded p-2" required>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold mb-1">Konfirmasi Password Baru</label>
                    <input type="password" name="new_password_confirmation" class="w-full border rounded p-2" required>
                </div>

                <div class="flex justify-end gap-2 mt-6">
                    <button type="button" id="btnClosePasswordForm" class="text-gray-600 hover:underline">Batal</button>
                    <button type="submit" class="bg-[#46A616] text-white px-4 py-2 rounded hover:bg-[#3d9014]">Simpan</button>
                </div>
                </form>
            </div>
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
        <div class="col-span-2">
            <label class="block font-semibold mb-1 text-xl">Nama Bank Sampah</label>
            <input type="text" name="nameInput" placeholder="Masukkan Nama Anda" value="{{ auth()->user()->nama }}" required class="w-full border rounded p-3" />
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
            <label class="block font-semibold mb-1 text-xl">Nomor Telepon</label>
            <input type="tel" name="phoneInput" placeholder="Masukkan Nomor Telepon Anda" value="{{ auth()->user()->nomor_telepon }}" class="w-full border rounded p-3" required/>
        </div>

        <div>
            <label class="block font-semibold mb-1 text-xl">Email</label>
            <input type="email" value="{{ auth()->user()->email }}" readonly class="w-full border rounded p-3" />
        </div>

        <div class="col-span-2 mt-4 flex gap-5">
            <button id="btnBatalEdit" class="bg-white border border-[#46A616] text-[#46A616] font-semibold px-6 py-2 rounded-[15px] min-w-[170px] min-h-[47px] hover:bg-[#ebffe3] hover:text-[#46A616] transition duration-300">Batal</button>
            <button type="submit" class="bg-[#46A616] text-white font-semibold px-6 py-2 rounded-[15px] min-w-[170px] min-h-[47px] hover:bg-[#46A616d0] transition duration-300">Simpan</button>
        </div>
    </form>
</main>
@endsection

@section('dashboard')
<main id="formDashboard" class="bg-white shadow-xl rounded-[33px] p-12 w-full lg:[width:77.777777%]">
    <h1 class="text-3xl font-bold text-black mb-1">DASHBOARD</h1>
    <div class="border-b-2 border-black w-full my-2"></div>

    <div class="flex justify-between items-center mt-4">
        <h2 class="text-2xl font-semibold text-black">
            Statistik <span class="text-[#46A616]">Aktivitas</span>
        </h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
        <!-- Box 1 -->
        <div class="bg-green-600 text-white rounded-[20px] p-6 shadow-lg">
            <p class="text-lg font-semibold">Penjemputan Selesai</p>
            <h3 class="text-4xl font-bold mt-2">{{ $penjemputanSelesai }}</h3>
        </div>

        <!-- Box 2 -->
        <div class="bg-red-500 text-white rounded-[20px] p-6 shadow-lg">
            <p class="text-lg font-semibold">Penjemputan Ditolak</p>
            <h3 class="text-4xl font-bold mt-2">{{ $penjemputanDitolak }}</h3>
        </div>

        <!-- Box 3 -->
        <div class="bg-gray-500 text-white rounded-[20px] p-6 shadow-lg">
            <p class="text-lg font-semibold">Sampah Diterima (KG)</p>
            <h3 class="text-4xl font-bold mt-2">{{ $sampahDiterima }}</h3>
        </div>

        <!-- Box 4 -->
        <div class="bg-gray-500 text-white rounded-[20px] p-6 shadow-lg">
            <p class="text-lg font-semibold">User Melakukan Pemesanan</p>
            <h3 class="text-4xl font-bold mt-2">{{ $jumlahUserAktif }}</h3>
        </div>
    </div>
</main>
@endsection

@section('request-penjemputan')
<main id="formRequest" class="hidden bg-white shadow-xl rounded-[33px] p-12 w-full lg:[width:77.777777%]">
    <p class="text-black font-semibold">
        Home > <span class="text-black font-semibold">Request Penjemputan</span>
    </p>
    <h1 class="text-2xl font-bold my-4">
        Request <span class="text-[#46A616]">Penjemputan</span>
    </h1>

    @foreach ($requests as $request)
    @php
        switch ($request->status) {
            case 'selesai':
                $border = 'border-[#46A616]';
                $bg = 'bg-[#46A616]';
                $icon = 'ph-check-circle';
                $text = 'text-[#46A616]';
                break;
            case 'diproses':
                $border = 'border-[#f5a623]';
                $bg = 'bg-[#f5a623]';
                $icon = 'ph-clock';
                $text = 'text-[#f5a623]';
                break;
            case 'dibatalkan':
                $border = 'border-[#E05555]';
                $bg = 'bg-[#E05555]';
                $icon = 'ph-x-circle';
                $text = 'text-[#E05555]';
                break;
            case 'menunggu':
                $border = 'border-[#3EB0E4]';
                $bg = 'bg-[#3EB0E4]';
                $icon = 'ph-hourglass';
                $text = 'text-[#3EB0E4]';
                break;
            default:
                $border = 'border-gray-300';
                $bg = 'bg-gray-300';
                $icon = '';
        }
    @endphp
    <div class="border {{ $border }} rounded-xl p-4 flex items-start justify-between gap-4 mb-4">
    <div class="flex gap-4 items-start">
        <img src="{{ $request->user->foto_profil ? asset('storage/foto_profil/' . $request->user->foto_profil) : asset('images/foto-default.png') }}" alt="Foto User" class="w-14 h-14 rounded-full object-cover" />
        <div>
            <p class="font-bold text-lg">Nama : {{ $request->user->nama }}</p>
            <p class="text-sm text-gray-600">Waktu : {{ Carbon::parse($request->tanggal)->translatedFormat('l, d F Y') }}</p>
            <p class="text-sm text-gray-600">Alamat : {{ $request->alamat_penjemputan }}</p>
            <p class="text-sm text-gray-600">Status : {{ $request->status }}</p>
        </div>
    </div>
        <div class="flex gap-4 items-center">
            <form action="{{ route('penjemputan.approve', $request->id) }}" method="POST">
                @csrf
                <button type="submit" class="bg-[#46A616] hover:bg-green-600 p-2 rounded-full text-white h-[40px] w-[40px]">
                    <i class="ph ph-check-circle"></i>
                </button>
            </form>
            <form action="{{ route('penjemputan.progress', $request->id) }}" method="POST">
                @csrf
                <button type="submit" class="bg-[#f5a623] hover:bg-yellow-600 p-2 rounded-full text-white h-[40px] w-[40px]">
                    <i class="ph ph-clock"></i>
                </button>
            </form>
            <form action="{{ route('penjemputan.reject', $request->id) }}" method="POST">
                @csrf
                <button type="submit" class="bg-[#E05555] hover:bg-red-600 p-2 rounded-full text-white h-[40px] w-[40px]">
                    <i class="ph ph-x-circle"></i>
                </button>
            </form>
        </div>
    </div>
    @endforeach

    <!-- Pagination -->
    <div class="mt-6 flex justify-center">
        {{ $requests->links('pagination::tailwind') }}
    </div>
</main>
@endsection


@section('catatan-penjemputan')
<!-- Riwayat Penjemputan -->
<main id="formRiwayat" class="hidden bg-white shadow-xl rounded-[33px] p-12 w-full lg:[width:77.777777%]">
    <p class="text-black font-semibold">
        Home > <span class="text-black font-semibold">Catatan Penjemputan</span>
    </p>
    <h1 class="text-2xl font-bold my-4">
        Catatan <span class="text-[#46A616]">Penjemputan</span>
    </h1>

    @foreach ($riwayatRequests as $request)
    @php
        switch ($request->status) {
            case 'selesai':
                $border = 'border-[#46A616]';
                $bg = 'bg-[#46A616]';
                $icon = 'ph-check-circle';
                $text = 'text-[#46A616]';
                break;
            case 'diproses':
                $border = 'border-[#f5a623]';
                $bg = 'bg-[#f5a623]';
                $icon = 'ph-clock';
                $text = 'text-[#f5a623]';
                break;
            case 'dibatalkan':
                $border = 'border-[#E05555]';
                $bg = 'bg-[#E05555]';
                $icon = 'ph-x-circle';
                $text = 'text-[#E05555]';
                break;
            case 'menunggu':
                $border = 'border-[#3EB0E4]';
                $bg = 'bg-[#3EB0E4]';
                $icon = 'ph-hourglass';
                $text = 'text-[#3EB0E4]';
                break;
            default:
                $border = 'border-gray-300';
                $bg = 'bg-gray-300';
                $icon = '';
        }
    @endphp
    <div class="border {{ $border }} rounded-xl p-4 flex items-start justify-between gap-4 mb-4">
    <div class="flex gap-4 items-start">
        <img src="{{ $request->user->foto_profil ? asset('storage/foto_profil/' . $request->user->foto_profil) : asset('images/foto-default.png') }}" alt="Foto User" class="w-14 h-14 rounded-full object-cover" />
        <div>
            <p class="font-bold text-lg">Nama : {{ $request->user->nama }}</p>
            <p class="text-sm text-gray-600">Waktu : {{ Carbon::parse($request->tanggal)->translatedFormat('l, d F Y') }}</p>
            <p class="text-sm text-gray-600">Alamat : {{ $request->alamat_penjemputan }}</p>
            <p class="text-sm text-gray-600">Status : {{ $request->status }}</p>
        </div>
    </div>
    @endforeach

    <!-- Pagination -->
    <div class="mt-6 flex justify-center">
        {{ $requests->links('pagination::tailwind') }}
    </div>
</main>
@endsection
