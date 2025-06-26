@extends('layouts.dashboard_user')

@php
    use Illuminate\Support\Facades\Auth;
    use App\Models\User;
    use Carbon\Carbon;

    $lastPenjemputan = Auth::user()->penjemputan()->latest()->first();
    $banksampah = User::where('role', 'admin')->get();

    $borderColor = 'border-gray-300';

    if ($lastPenjemputan) {
        $borderColor = match($lastPenjemputan->status) {
            'menunggu' => 'border-[#3EB0E4]',
            'diproses' => 'border-[#f5a623]',
            'selesai' => 'border-[#46A616]',
            'dibatalkan' => 'border-[#E05555]',
            default => 'border-gray-300',
        };
    }

    $user = auth()->user();
    $penjemputans = $user->penjemputan()->latest()->get();
@endphp

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
        <button
            type="button"
            id="btnShowPasswordForm"
            class="bg-[#46A616] hover:bg-[#46A616d0] font-semibold text-white justify-center flex px-4 py-2 rounded-[15px] items-center gap-4 text-sm mb-4 w-full h-[51px] shadow-md md:text-xl">
            Ganti Password
        </button>
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
        <form
            action="{{ route('auth.logout') }}"
            method="POST">
            @csrf
            <button
                type="submit"
                class="bg-[#E05555] hover:bg-[#E05555d0] font-semibold text-white px-4 py-2 gap-4 rounded-[15px] w-full h-[51px] text-sm shadow-md md:text-xl">
                Keluar
            </button>
        </form>
    </div>
</aside>
@endsection

@section('akun-saya')
<!-- Form Akun Saya -->
<main id="formAkun" class="bg-white shadow-xl rounded-[33px] p-12 w-full lg:[width:77.777777%]">
    <p class="text-black text-lg font-semibold">Home > <span class="text-black font-semibold">Akun Saya</span></p>
    <h1 class="text-4xl font-bold mb-4 mt-6">Akun <span class="text-[#46A616]">Saya</span></h1>

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
    <p class="text-black text-lg font-semibold">Home > <span class="text-black font-semibold">Akun Saya</span></p>
    <h1 class="text-4xl font-bold mb-4 mt-6">Akun <span class="text-[#46A616]">Saya</span></h1>

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
    <p class="text-black text-lg font-semibold">
    Home > <span class="text-black font-semibold">Request Penjemputan</span>
    </p>
    <h1 class="text-4xl font-bold mb-4 mt-6">
    Request <span class="text-[#46A616]">Penjemputan</span>
    </h1>

    <div class="mt-4 space-y-4">
            @if ($lastPenjemputan && !in_array($lastPenjemputan->status, ['dibatalkan', 'selesai']) )
                <div class="w-full bg-gray-50 min-h-[240px] border {{ $borderColor }} rounded-[10px] shadow-md">
                    <div class="text-sm text-gray-700 p-5">
                        <h1 class="text-xl mb-5 border-b-2"><strong>Invoice No: </strong>{{ $lastPenjemputan->nomor_invoice }}</h1>
                        <p><strong>Status:</strong> {{ ucfirst($lastPenjemputan->status) }}</p>
                        <p><strong>Alamat Penjemputan:</strong> {{ $lastPenjemputan->alamat_penjemputan }}</p>
                        <p><strong>Tanggal Jemput:</strong> {{Carbon::parse($lastPenjemputan->tanggal)->format('d M Y') }}</p>
                    </div>
                </div>
                <!-- Tombol Batal Request -->
                <div>
                    <form action="{{ route('penjemputan.updateStatus') }}" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="dibatalkan">
                        @if ($errors->has('status'))
                            <p class="text-sm text-red-500 mt-1">
                                {{ $errors->first('status') }}
                            </p>
                        @endif
                        <input type="hidden" name="penjemputan_id" value="{{ $lastPenjemputan->id }}">
                        @if ($errors->has('penjemputan_id'))
                            <p class="text-sm text-red-500 mt-1">
                                {{ $errors->first('penjemputan_id') }}
                            </p>
                        @endif
                        <button
                            type="submit"
                            class="bg-[#E05555] hover:bg-[#ea7e7e] shadow-md text-white px-6 py-2 rounded-[15px] font-semibold min-w-[170px] min-h-[47px]"
                        >
                            Batalkan
                        </button>
                    </form>
                </div>
            @else
                <div class="w-full bg-gray-50 min-h-[240px] border border-gray-600 rounded-[10px] shadow-md">
                    <p class="text-gray-500 italic p-5">Belum ada riwayat penjemputan terakhir.</p>
                </div>
                <!-- Tombol Kirim -->
                <div>
                    <button
                    type="submit"
                    id="btnToRequest"
                    class="bg-[#46A616] hover:bg-[#3d9014] shadow-md text-white px-6 py-2 rounded-[15px] font-semibold min-w-[170px] min-h-[47px]"
                    >
                    Buat Request
                    </button>
                </div>
            @endif
    </div>
</main>

<!-- Form Request Penjemputan -->
<main id="formRequestEdit" class="hidden bg-white shadow-xl rounded-[33px] p-12 w-full lg:[width:77.777777%]">
    <p class="text-black text-lg font-semibold">
    Home > <span class="text-black font-semibold">Request Penjemputan</span>
    </p>
    <h1 class="text-4xl font-bold mb-4 mt-6">
    Request <span class="text-[#46A616]">Penjemputan</span>
    </h1>

    <form method="POST" action="{{ route('user.requestPenjemputan') }}" class="mt-4 space-y-4">
        @csrf
        <!-- Pilih Bank & Tanggal Penjemputan -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold mb-1 text-xl">Pilih Bank Sampah</label>
                <select name="bankSampahInput" class="border rounded p-2 w-full" required>
                    <option selected disabled>Pilih Bank Sampah</option>
                    @foreach ($banksampah as $user)
                        <option value="{{ $user->id }}">{{ $user->nama }}</option>
                    @endforeach
                </select>
                @if ($errors->has('bankSampahInput'))
                    <p class="text-sm text-red-500 mt-1">
                        {{ $errors->first('bankSampahInput') }}
                    </p>
                @endif
            </div>

            <div>
            <label class="block font-semibold mb-1 text-xl">Tanggal Penjemputan</label>
            <input
                type="date"
                class="border rounded p-2 w-full"
                name="tanggalPenjemputanInput"
                />
            </div>
            @if ($errors->has('tanggalPenjemputanInput'))
                <p class="text-sm text-red-500 mt-1">
                    {{ $errors->first('tanggalPenjemputanInput') }}
                </p>
            @endif
        </div>

        <!-- Alamat & Volume -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold mb-1 text-xl">Alamat Penjemputan</label>
                <input
                    type="text"
                    placeholder="Masukkan alamat penjemputan"
                    class="w-full border rounded p-2"
                    name="alamatPenjemputanInput"
                />
                @if ($errors->has('alamatPenjemputanInput'))
                    <p class="text-sm text-red-500 mt-1">
                        {{ $errors->first('alamatPenjemputanInput') }}
                    </p>
                @endif
            </div>

            <div>
                <label class="block font-semibold mb-1 text-xl">Volume</label>
                <input
                    type="number"
                    step="0.01"
                    name="volumeInput"
                    placeholder="Masukkan volume sampah anda"
                    class="w-full border rounded p-2"
                />
                @if ($errors->has('volumeInput'))
                    <p class="text-sm text-red-500 mt-1">
                        {{ $errors->first('volumeInput') }}
                    </p>
                @endif
            </div>
        </div>

        <!-- Tombol Kirim -->
        <div class="col-span-2 mt-4 flex gap-5">
            <button id="btnBatalRequest" class="bg-white border border-[#46A616] text-[#46A616] font-semibold px-6 py-2 rounded-[15px] min-w-[170px] min-h-[47px] hover:bg-[#ebffe3] hover:text-[#46A616] transition duration-300">Batal</button>
            <button type="submit" class="bg-[#46A616] text-white font-semibold px-6 py-2 rounded-[15px] min-w-[170px] min-h-[47px] hover:bg-[#46A616d0] transition duration-300">Request</button>
        </div>
    </form>
</main>
@endsection

@section('riwayat-penjemputan')
<main id="formRiwayat" class="hidden bg-white shadow-xl rounded-[33px] p-12 w-full lg:[width:77.777777%]">
    <p class="text-black font-semibold">Home > <span class="text-black font-semibold">Riwayat Penjemputan</span></p>
    <h1 class="text-3xl font-bold my-4">Riwayat <span class="text-[#46A616]">Penjemputan</span></h1>

    <div class="flex flex-col gap-4 text-sm mt-6">
        @foreach ($penjemputans as $penjemputan)
            @php
                switch ($penjemputan->status) {
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

            <div class="border {{ $border }} rounded-[15px] p-4 flex flex-col shadow-md">
                <div class="flex justify-between items-center">
                    <p class="font-semibold text-black">Invoice No. : <span class="font-bold">{{ $penjemputan->nomor_invoice }}</span></p>
                    <span class="text-white {{ $bg }} px-3 py-1 rounded-full text-xs font-semibold flex items-center gap-1">
                        <i class="ph {{ $icon }} text-sm"></i> {{ ucfirst($penjemputan->status) }}
                    </span>
                </div>
                <div class="flex justify-between items-center mt-2">
                    <p class="text-gray-500">{{ Carbon::parse($penjemputan->tanggal)->translatedFormat('d F Y') }}</p>
                    <button
                        type="button"
                        class="{{ $text }} font-semibold hover:underline"
                        onclick="showDetail({{ $penjemputan->id }})"
                    >
                        Detail Transaksi
                    </button>
                </div>
            </div>
        @endforeach
        <!-- Modal Detail -->
        <div id="detailModal" class="hidden fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg w-[90%] md:w-[600px] shadow-lg relative">
                <button onclick="closeDetail()" class="absolute top-2 right-4 text-gray-600 text-xl font-bold">&times;</button>
                <h2 class="text-2xl font-bold mb-4">Detail Penjemputan</h2>
                <div id="modalContent">
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
