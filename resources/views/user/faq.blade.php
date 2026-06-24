@extends('layouts.user-layout')
@section('title', 'FAQ')
@section('content')
@php
     $data = [
          'Apa itu Unud Event?' => 
          'Unud Event adalah platform pusat informasi dan pendaftaran berbagai kegiatan di lingkungan Universitas Udayana. Di sini, kamu bisa menemukan info seminar, workshop, webinar, lomba, hingga kegiatan pengabdian masyarakat yang diselenggarakan oleh pihak universitas, fakultas, jurusan, maupun organisasi mahasiswa (Himpunan/BEM).',

          'Siapa saja yang bisa mendaftar akun di website ini?' => 
          'Akun di platform ini dikhususkan bagi Penyelenggara Acara, sehingga akses pembuatannya tidak dibuka untuk publik. Hak akses akun hanya diberikan kepada Lembaga Mahasiswa seperti Himpunan Mahasiswa (Hima), Badan Eksekutif Mahasiswa (BEM), dan Dewan Perwakilan Mahasiswa (DPM) selaku pengelola utama, serta seluruh Unit Kegiatan Mahasiswa (UKM) resmi di lingkungan Universitas Udayana. Untuk vendor atau pihak luar yang ingin berpartisipasi, dapat memperoleh akses akun melalui jalur kerja sama resmi yang diajukan dan divalidasi terlebih dahulu oleh salah satu DPM terkait.',
     
          'Apa saja benefit yang didapatkan setelah mengikuti event?' => 
          'Benefit berbeda-beda untuk tiap event, namun umumnya meliputi sertifikat (lokal/nasional), kesempatan berinterkasi dan membangun koneksi dengan mahasiswa Universitas Udayana di Fakultas yang berbeda,konsumsi/makan siang (untuk event offline) dan SKP (Satuan Kredit Prestasi bagi mahasiswa Unud).',

          'Apakah mahasiswa luar Unud atau masyarakat umum boleh ikut serta?' => 
          'Tergantung kebijakan masing-masing event. Setiap halaman detail event akan menampilkan informasi Peserta yang dapat mengikuti event (misalnya: Khusus Mahasiswa Dalam Kampus, SMA, atau Umum). Pastikan kategori kamu sesuai sebelum melakukan pendaftaran.',
     ]
@endphp
<div class="flex flex-col justify-center">
     <div class="mb-6">
          <h1 class="text-4xl font-bold text-primary text-center mb-2">Pertanyaan Umum</h1>
          <div class="flex justify-center mb-4">
               <p class="px-3 py-2 bg-primary rounded-xl text-4xl font-bold text-white text-center w-fit">Unud Events</p>
          </div>
         <p class="text-xl font-semibold text-primary text-center">Temukan jawaban dari pertanyaan yang paling sering ditanyakan seputar layanan Unud Events.</p>
     </div>
     <div class="flex flex-col gap-4 w-5xl mx-auto">
          @foreach ($data as $question => $answer)
          <div x-data="{ open: false }" @click="open = !open" class="flex flex-col gap-2 cursor-pointer select-none">
               <div class="px-4 py-3 rounded-lg border-2 border-primary bg-white">
                    <div class="flex justify-between items-center">
                         <div class="flex gap-2 font-bold text-primary">
                              <span>Q:</span>
                              <span>{{ $question }}</span>
                         </div>
                         <div :class="open ? 'rotate-180' : ''">
                              <x-icons.down-arrow class="text-primary!" />
                         </div>
                    </div>
               </div>
               <div class="grid transition-all duration-300 ease-in-out"
                    :class="open ? 'grid-rows-[1fr]' : 'grid-rows-[0fr]'">
                    <div class="overflow-hidden">
                         <div class="px-4 py-3 rounded-lg border-2 border-primary bg-white">
                              <div class="flex gap-2 font-medium text-primary">
                                   <span>A:</span>
                                   <span>{{ $answer }}</span>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
          @endforeach
     </div>
</div>
@endsection