<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\DetailEvent;
use App\Models\Event;
use App\Models\EventType;
use App\Models\Participant;
use App\Models\Timeline;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
   /**
    * Run the database seeds.
    */
   public function run(): void
   {
      $adminUsers = User::where('role', 'admin')->with(['faculty', 'major'])->get();
      $categories = Category::all()->keyBy('name');
      $types = EventType::all()->keyBy('name');
      $participants = Participant::all()->keyBy('name');

      $eventsData = [
         // 1. INVFEST Hackathon & Web
         [
            'type' => 'Lomba',
            'name' => 'Udayana Informatics Festival (INVFEST): Web & Mobile App Hackathon',
            'description' => 'Kompetisi pengembangan perangkat lunak tingkat nasional yang menantang mahasiswa untuk menciptakan solusi digital inovatif di bidang pariwisata cerdas, ekonomi kreatif, dan kelestarian lingkungan Bali. Peserta akan melewati tahap seleksi proposal dan babak final hackathon 24 jam.',
            'location' => 'offline',
            'price' => 75000,
            'days_ahead' => 12,
            'duration_days' => 2,
            'organizer_slug' => 'hima-informatika',
            'fallback_instance' => 'HIMA Informatika Fakultas MIPA',
            'categories' => ['Hackaton', 'Web Development', 'UI/UX Design'],
            'participants' => ['Mahasiswa', 'Umum'],
            'details' => [
               'Total Hadiah' => 'Rp 17.500.000 + Piala Bergilir Rektor Universitas Udayana & Sertifikat',
               'Guidebook & Silabus' => 'https://bit.ly/Guidebook-INVFEST-2026',
               'Ketentuan Tim' => '1 tim beranggotakan 2-3 mahasiswa aktif se-Indonesia (wajib melampirkan scan KTM).',
               'Contact Person' => 'Arya Satya (081234567891) | invfest@unud.ac.id',
            ],
            'timelines' => [
               ['desc' => 'Pendaftaran Gelombang 1 & Pengumpulan Proposal', 'days_offset' => 0, 'hour' => 8, 'duration' => 10],
               ['desc' => 'Pengumuman Finalis 10 Besar', 'days_offset' => 10, 'hour' => 18, 'duration' => 1],
               ['desc' => 'Technical Meeting Finalis', 'days_offset' => 11, 'hour' => 15, 'duration' => 2],
               ['desc' => 'Babak Final Hackathon 24 Jam & Penjurian', 'days_offset' => 12, 'hour' => 9, 'duration' => 24],
            ],
         ],

         // 2. Seminar Budaya & AI
         [
            'type' => 'Seminar',
            'name' => 'Seminar Nasional: Harmonisasi Artificial Intelligence dan Preservasi Budaya Bali',
            'description' => 'Seminar interaktif yang mengkaji potensi implementasi teknologi kecerdasan buatan dalam melestarikan manuskrip lontar, seni tari, serta sastra Bali kuno tanpa mengikis nilai-nilai luhur kearifan lokal (Tri Hita Karana).',
            'location' => 'offline',
            'price' => 35000,
            'days_ahead' => 8,
            'duration_days' => 1,
            'organizer_slug' => 'bem-fakultas-ilmu-budaya',
            'fallback_instance' => 'BEM Fakultas Ilmu Budaya Universitas Udayana',
            'categories' => ['Big Data Analytic', 'Karya Tulis Ilmiah'],
            'participants' => ['Mahasiswa Dalam Kampus', 'Mahasiswa', 'Umum'],
            'details' => [
               'Keynote Speaker' => 'Prof. Dr. I Nyoman Darma Putra (Budayawan) & Lead Researcher AI Southeast Asia',
               'Tempat Pelaksanaan' => 'Auditorium Widya Sabha, Kampus Bukit Jimbaran, Badung',
               'Fasilitas Peserta' => 'E-Sertifikat Nasional (Bernilai SKP Mahasiswa), Seminar Kit, Snack Box & Lunch',
               'Contact Person' => 'Ni Kadek Sintya (087812345678)',
            ],
            'timelines' => [
               ['desc' => 'Registrasi Ulang & Pengambilan Seminar Kit', 'days_offset' => 8, 'hour' => 8, 'duration' => 1],
               ['desc' => 'Opening Ceremony & Tari Pembukaan Tradisional', 'days_offset' => 8, 'hour' => 9, 'duration' => 1],
               ['desc' => 'Sesi Panel Utama & Diskusi Interaktif', 'days_offset' => 8, 'hour' => 10, 'duration' => 3],
               ['desc' => 'Sesi Tanya Jawab, Doorprize, & Penutup', 'days_offset' => 8, 'hour' => 13, 'duration' => 2],
            ],
         ],

         // 3. Pengabdian Pesisir
         [
            'type' => 'Pengabdian',
            'name' => 'Udayana Mengabdi: Konservasi Terumbu Karang & Edukasi Maritim Pesisir',
            'description' => 'Aksi nyata pengabdian masyarakat pesisir di Desa Serangan. Program meliputi penanaman bibit mangrove, transplantasi terumbu karang bersama nelayan lokal, serta penyuluhan pengolahan limbah plastik ramah lingkungan.',
            'location' => 'offline',
            'price' => 0,
            'days_ahead' => 15,
            'duration_days' => 2,
            'organizer_slug' => 'bem-fakultas-kelautan-dan-perikanan',
            'fallback_instance' => 'BEM Fakultas Kelautan dan Perikanan Unud',
            'categories' => ['Essay', 'Business Plan'],
            'participants' => ['Mahasiswa Dalam Kampus', 'Umum'],
            'details' => [
               'Lokasi Kegiatan' => 'Kawasan Pesisir Pantai Serangan, Denpasar Selatan',
               'Fasilitas Relawan' => 'Kaos Relawan, Konsumsi 2 Hari, Sertifikat Pengabdian Masyarakat (SKP), Alat Tanam',
               'Persyaratan' => 'Mahasiswa aktif, memiliki kesiapan fisik di luar ruangan, dan komitmen penuh selama program.',
               'Contact Person' => 'Wayan Gede Adi (089612345678)',
            ],
            'timelines' => [
               ['desc' => 'Briefing Relawan & Pelepasan Kontingen', 'days_offset' => 15, 'hour' => 7, 'duration' => 1],
               ['desc' => 'Aksi Bersih Pantai & Edukasi Kelautan Siswa SD', 'days_offset' => 15, 'hour' => 8, 'duration' => 4],
               ['desc' => 'Transplantasi Karang & Pembagian Bibit Mangrove', 'days_offset' => 16, 'hour' => 8, 'duration' => 5],
            ],
         ],

         // 4. Workshop Laravel & Livewire
         [
            'type' => 'Workshop',
            'name' => 'Workshop Fullstack Web: Membangun Aplikasi Enterprise dengan Laravel & Livewire',
            'description' => 'Pelatihan intensif *hands-on coding* yang membedah arsitektur modern Laravel 11/12/13, komponen reaktif Livewire, dan integrasi Tailwind CSS. Peserta akan dipandu langsung membangun aplikasi fullstack siap produksi mulai dari nol.',
            'location' => 'offline',
            'price' => 50000,
            'days_ahead' => 6,
            'duration_days' => 1,
            'organizer_slug' => 'hima-teknologi-informasi',
            'fallback_instance' => 'HIMA Teknologi Informasi Fakultas Teknik',
            'categories' => ['Web Development', 'UI/UX Design'],
            'participants' => ['Mahasiswa', 'Umum'],
            'details' => [
               'Instruktur' => 'Senior Backend Engineer Tech Startup & Alumni TI Unud',
               'Prasyarat' => 'Membawa laptop pribadi dengan spesifikasi minimum RAM 8GB, PHP 8.2+, Composer, & Node.js.',
               'Benefit' => 'Akses Repositori Source Code, E-Certificate, Modul PDF Lengkap, dan Makan Siang.',
               'Contact Person' => 'Deasa Putra (082156789012)',
            ],
            'timelines' => [
               ['desc' => 'Persiapan Lingkungan & Setup Boilerplate', 'days_offset' => 6, 'hour' => 9, 'duration' => 1],
               ['desc' => 'Sesi 1: REST API & Eloquent Advanced Relationship', 'days_offset' => 6, 'hour' => 10, 'duration' => 2],
               ['desc' => 'Sesi 2: Reactive State Management dengan Livewire', 'days_offset' => 6, 'hour' => 13, 'duration' => 3],
               ['desc' => 'Deployment & QnA Komprehensif', 'days_offset' => 6, 'hour' => 16, 'duration' => 1],
            ],
         ],

         // 5. Webinar Beasiswa Luar Negeri
         [
            'type' => 'Webinar',
            'name' => 'Webinar Nasional: Strategi Lolos Beasiswa Bergengsi IISMA & LPDP 2026',
            'description' => 'Kupas tuntas kiat menembus beasiswa pertukaran pelajar internasional (IISMA) dan studi magister/doktoral (LPDP). Dapatkan wawasan langsung seputar penulisan motivation letter, kurasi essay, serta simulasi wawancara.',
            'location' => 'online',
            'price' => 0,
            'days_ahead' => 4,
            'duration_days' => 1,
            'organizer_slug' => 'bem-fakultas-ekonomi-dan-bisnis',
            'fallback_instance' => 'BEM Fakultas Ekonomi dan Bisnis Universitas Udayana',
            'categories' => ['Essay', 'Debat'],
            'participants' => ['SMA', 'Mahasiswa', 'Umum'],
            'details' => [
               'Narasumber 1' => 'Alumni IISMA di University of Edinburgh, UK',
               'Narasumber 2' => 'Penerima Beasiswa LPDP Master Program di Harvard University',
               'Platform' => 'Zoom Cloud Meetings & Live YouTube Stream',
               'Fasilitas' => 'E-Certificate, Template Motivation Letter Juara, & Rekaman Video Acara',
               'Narahubung' => 'Candra Wijaya (085712345678)',
            ],
            'timelines' => [
               ['desc' => 'Open Gate Zoom & Pemutaran Video Profil', 'days_offset' => 4, 'hour' => 9, 'duration' => 1],
               ['desc' => 'Sesi Kupas Tuntas IISMA & Bedah Essay', 'days_offset' => 4, 'hour' => 10, 'duration' => 2],
               ['desc' => 'Sesi Beasiswa LPDP & Tips Wawancara', 'days_offset' => 4, 'hour' => 12, 'duration' => 2],
               ['desc' => 'Sesi Tanya Jawab Langsung & Penutup', 'days_offset' => 4, 'hour' => 14, 'duration' => 1],
            ],
         ],

         // 6. Lomba Karya Tulis Ilmiah Kedokteran
         [
            'type' => 'Lomba',
            'name' => 'Udayana National Medical Scientific Competition (UNMSC) 2026',
            'description' => 'Ajang kompetisi riset dan karya tulis ilmiah kedokteran bergengsi tingkat nasional. Mahasiswa rumpun ilmu kesehatan ditantang menghadirkan inovasi preventif dan terapeutik dalam menangani penyakit tropis di era pascapandemi.',
            'location' => 'online',
            'price' => 100000,
            'days_ahead' => 20,
            'duration_days' => 3,
            'organizer_slug' => 'bem-fakultas-kedokteran',
            'fallback_instance' => 'BEM Fakultas Kedokteran Universitas Udayana',
            'categories' => ['Karya Tulis Ilmiah', 'Essay', 'Olimpiade Kimia'],
            'participants' => ['SMA', 'Mahasiswa'],
            'details' => [
               'Tema Utama' => '"Integrasi Terapi Preventif Berkelanjutan Terhadap Endemik Tropis Asia Tenggara"',
               'Total Hadiah' => 'Juara 1: Rp 7.000.000, Juara 2: Rp 5.000.000, Juara 3: Rp 3.000.000 + Medali & Plakat',
               'Petunjuk Teknis' => 'Dapat diunduh melalui tautan resmi unud-event',
               'Contact Person' => 'Dr. I Gusti Ngurah (081333444555)',
            ],
            'timelines' => [
               ['desc' => 'Batas Pengumpulan Full Paper Ilmiah', 'days_offset' => 5, 'hour' => 23, 'duration' => 1],
               ['desc' => 'Pengumuman Finalis Presentasi Ilmiah', 'days_offset' => 15, 'hour' => 17, 'duration' => 1],
               ['desc' => 'Presentasi Karya Ilmiah & Uji Tanya Dewan Juri', 'days_offset' => 20, 'hour' => 8, 'duration' => 8],
               ['desc' => 'Awarding Night & Pengumuman Pemenang', 'days_offset' => 22, 'hour' => 19, 'duration' => 2],
            ],
         ],

         // 7. Lomba Debat Hukum Nasional
         [
            'type' => 'Lomba',
            'name' => 'Udayana Law Debate Competition: Penegakan Hukum Siber & Kedaulatan Digital',
            'description' => 'Kompetisi debat konstitusi dan hukum nasional antar-perguruan tinggi se-Indonesia. Menguji ketajaman argumentasi, konstruksi logika, dan pemahaman mahasiswa terhadap dinamika hukum teknologi di Indonesia.',
            'location' => 'offline',
            'price' => 150000,
            'days_ahead' => 18,
            'duration_days' => 2,
            'organizer_slug' => 'hima-ilmu-hukum',
            'fallback_instance' => 'HIMA Ilmu Hukum Fakultas Hukum',
            'categories' => ['Debat', 'Essay'],
            'participants' => ['Mahasiswa'],
            'details' => [
               'Format Kompetisi' => 'Sistem Debat Parlemen Asia (Asian Parliamentary)',
               'Dewan Juri' => 'Pakar Hukum Tata Negara, Praktisi Cyber Law, dan Hakim Mahkamah',
               'Hadiah' => 'Piala Bergilir Dekan Fakultas Hukum, Piagam Kemenpora, & Uang Pembinaan Total Rp 12.000.000',
               'Narahubung' => 'Gus De Kemenuh (081999888777)',
            ],
            'timelines' => [
               ['desc' => 'Technical Meeting & Drawing Motion', 'days_offset' => 17, 'hour' => 16, 'duration' => 2],
               ['desc' => 'Babak Penyisihan Grup Debat', 'days_offset' => 18, 'hour' => 8, 'duration' => 8],
               ['desc' => 'Semifinal, Grand Final, dan Awarding', 'days_offset' => 19, 'hour' => 9, 'duration' => 7],
            ],
         ],

         // 8. Workshop Fotografi & Videografi Pariwisata
         [
            'type' => 'Workshop',
            'name' => 'Creative Visual Workshop: Cinematic Video & Fotografi Promosi Destinasi Wisata',
            'description' => 'Workshop kreatif langsung di lapangan (on-field) membedah teknik pencahayaan, color grading, pemilihan sudut pandang sinematik, serta perancangan storytelling visual untuk mempromosikan destinasi ekowisata Bali.',
            'location' => 'offline',
            'price' => 60000,
            'days_ahead' => 10,
            'duration_days' => 1,
            'organizer_slug' => 'bem-fakultas-pariwisata',
            'fallback_instance' => 'BEM Fakultas Pariwisata Universitas Udayana',
            'categories' => ['Fotografi', 'Videografi'],
            'participants' => ['Mahasiswa', 'Umum'],
            'details' => [
               'Mentor' => 'Professional Travel Filmmaker & Fotografer National Geographic Contributor',
               'Lokasi Hunting' => 'Kawasan Budaya Garuda Wisnu Kencana & Pantai Melasti, Ungasan',
               'Benefit' => 'Tiket Masuk Lokasi, Coffee Break, Preset LUTs Video Pack, & Sertifikat Kompetensi',
               'Contact Person' => 'Rio Aryan (081234567119)',
            ],
            'timelines' => [
               ['desc' => 'Pemaparan Materi Teori & Teknik Kamera', 'days_offset' => 10, 'hour' => 8, 'duration' => 2],
               ['desc' => 'Sesi Hunting Foto & Video Praktik Lapangan', 'days_offset' => 10, 'hour' => 10, 'duration' => 4],
               ['desc' => 'Review Karya, Editing, & Color Grading Session', 'days_offset' => 10, 'hour' => 14, 'duration' => 3],
            ],
         ],

         // 9. Olimpiade Sains Siswa SMA
         [
            'type' => 'Lomba',
            'name' => 'Udayana Science Olympiad (USO): Olimpiade Matematika, Fisika, & Kimia',
            'description' => 'Ajang tahunan adu ketangkasan sains terbesar di Bali dan Nusa Tenggara untuk siswa tingkat SMP dan SMA. Bertujuan mengasah logika analitis serta mencetak bibit unggul peraih medali olimpiade sains nasional.',
            'location' => 'offline',
            'price' => 40000,
            'days_ahead' => 14,
            'duration_days' => 1,
            'organizer_slug' => 'hima-matematika',
            'fallback_instance' => 'HIMA Matematika Fakultas MIPA',
            'categories' => ['Olimpiade Matematika', 'Olimpiade Fisika', 'Olimpiade Kimia'],
            'participants' => ['SMP', 'SMA'],
            'details' => [
               'Kategori Lomba' => 'Tingkat SMP (IPA & Matematika), Tingkat SMA (Matematika, Fisika, Kimia)',
               'Hadiah' => 'Golden Ticket Masuk Jalur Prestasi FMIPA Unud, Trofi Juara, dan Beasiswa Pendidikan',
               'Fasilitas' => 'Soal & Pembahasan Cetak, Sertifikat Peserta & Guru Pendamping, Konsumsi',
               'Contact Person' => 'Agus Satria (087766554433)',
            ],
            'timelines' => [
               ['desc' => 'Babak Penyisihan Serentak Berbasis CBT', 'days_offset' => 14, 'hour' => 8, 'duration' => 3],
               ['desc' => 'Pengumuman 5 Besar & Babak Final Uraian', 'days_offset' => 14, 'hour' => 13, 'duration' => 2],
               ['desc' => 'Penganugerahan Juara & Foto Bersama', 'days_offset' => 14, 'hour' => 16, 'duration' => 1],
            ],
         ],

         // 10. Pengabdian Cek Kesehatan & Edukasi Gizi
         [
            'type' => 'Pengabdian',
            'name' => 'Bakti Sosial & Edukasi Gizi: Bersama Cegah Stunting di Desa Pegayaman',
            'description' => 'Kegiatan pengabdian masyarakat terintegrasi yang menghadirkan layanan pemeriksaan kesehatan gratis (tensi, gula darah, asam urat, kolesterol) dan penyuluhan gizi seimbang bagi ibu hamil dan balita.',
            'location' => 'offline',
            'price' => 0,
            'days_ahead' => 21,
            'duration_days' => 2,
            'organizer_slug' => 'hima-sarjana-kesehatan-masyarakat',
            'fallback_instance' => 'HIMA Kesehatan Masyarakat Fakultas Kedokteran',
            'categories' => ['Essay', 'Karya Tulis Ilmiah'],
            'participants' => ['Mahasiswa Dalam Kampus', 'Umum'],
            'details' => [
               'Bentuk Layanan' => 'Skrining Kesehatan Gratis, Pembagian 200 Paket PMT (Pemberian Makanan Tambahan)',
               'Mitra Kerja Sama' => 'Puskesmas Sukasada & Kader Posyandu Desa',
               'Kebutuhan Relawan' => 'Relawan Medis (Dokter Muda/Perawat) & Relawan Logistik Edukasi',
               'Contact Person' => 'Kadek Ayu (081888999000)',
            ],
            'timelines' => [
               ['desc' => 'Pemberangkatan Tim Medis & Relawan dari Denpasar', 'days_offset' => 21, 'hour' => 6, 'duration' => 3],
               ['desc' => 'Pelaksanaan Posko Kesehatan & Skrining Balita', 'days_offset' => 21, 'hour' => 9, 'duration' => 5],
               ['desc' => 'Konseling Gizi Door-to-Door & Evaluasi Program', 'days_offset' => 22, 'hour' => 9, 'duration' => 4],
            ],
         ],

         // 11. Webinar Karir & Data Science
         [
            'type' => 'Webinar',
            'name' => 'Webinar Data Science: Mengoptimalkan Big Data Analytics untuk Strategi Bisnis',
            'description' => 'Wawasan mendalam seputar tren kebutuhan praktisi data di industri modern. Membahas pipeline analisis data, machine learning untuk prediksi perilaku konsumen, dan studi kasus riil pemanfaatan data pada skala enterprise.',
            'location' => 'online',
            'price' => 0,
            'days_ahead' => 5,
            'duration_days' => 1,
            'organizer_slug' => 'hima-informatika',
            'fallback_instance' => 'HIMA Informatika Fakultas MIPA',
            'categories' => ['Big Data Analytic', 'Business Plan'],
            'participants' => ['Mahasiswa', 'Umum'],
            'details' => [
               'Narasumber' => 'Senior Data Scientist Unicorn Indonesia & Konsultan Business Intelligence',
               'Media Pertemuan' => 'Zoom Cloud Meeting',
               'Keuntungan' => 'E-Certificate SKP, Starter Kit Dataset Kaggle, Diskon Bootcamp Spesial',
               'Contact Person' => 'Admin HIMA Informatika (081234567899)',
            ],
            'timelines' => [
               ['desc' => 'Check-in Peserta & Sambutan Kaprodi', 'days_offset' => 5, 'hour' => 13, 'duration' => 1],
               ['desc' => 'Materi: Data Science Pipeline & Predictive Analytics', 'days_offset' => 5, 'hour' => 14, 'duration' => 2],
               ['desc' => 'Live Demo Python Modeling & Tanya Jawab', 'days_offset' => 5, 'hour' => 16, 'duration' => 2],
            ],
         ],

         // 12. Seminar Nasional Bisnis & Kewirausahaan
         [
            'type' => 'Seminar',
            'name' => 'Udayana Business Summit: Navigasi Startup Lokal Menembus Pendanaan Ventura',
            'description' => 'Konferensi kewirausahaan yang mempertemukan mahasiswa pendiri startup kampus dengan para angel investor dan venture capital. Membahas validasi produk, penentuan product-market fit, serta strategi pitching bisnis.',
            'location' => 'offline',
            'price' => 45000,
            'days_ahead' => 16,
            'duration_days' => 1,
            'organizer_slug' => 'hima-sarjana-manajemen',
            'fallback_instance' => 'HIMA Sarjana Manajemen Fakultas Ekonomi dan Bisnis',
            'categories' => ['Business Plan', 'Essay'],
            'participants' => ['Mahasiswa Dalam Kampus', 'Mahasiswa', 'Umum'],
            'details' => [
               'Pembicara' => 'Managing Partner Venture Capital & Founder Brand F&B Nasional Ternama',
               'Tempat' => 'Aula Gedung Pascasarjana Kampus Unud Sudirman, Denpasar',
               'Fasilitas' => 'Networking Session dengan Investor, Pitch Deck Review, Snack & Certificate',
               'Contact Person' => 'Wayan Dodi (082345678901)',
            ],
            'timelines' => [
               ['desc' => 'Registrasi & Morning Coffee Networking', 'days_offset' => 16, 'hour' => 8, 'duration' => 1],
               ['desc' => 'Keynote 1: Product-Market Fit & Unit Economics', 'days_offset' => 16, 'hour' => 9, 'duration' => 2],
               ['desc' => 'Keynote 2: How VCs Evaluate Early-Stage Startups', 'days_offset' => 16, 'hour' => 11, 'duration' => 2],
               ['desc' => 'Interactive Speed Pitching & Closing', 'days_offset' => 16, 'hour' => 14, 'duration' => 2],
            ],
         ],

         // 13. Lomba Business Plan Mahasiswa
         [
            'type' => 'Lomba',
            'name' => 'National Sustainable Business Plan Competition 2026',
            'description' => 'Kompetisi rancangan model bisnis berkelanjutan berbasis Environmental, Social, and Governance (ESG). Mendorong terciptanya ide-ide wirausaha muda yang solutif terhadap krisis iklim dan pemberdayaan ekonomi sirkular.',
            'location' => 'online',
            'price' => 80000,
            'days_ahead' => 25,
            'duration_days' => 2,
            'organizer_slug' => 'bem-fakultas-pertanian',
            'fallback_instance' => 'BEM Fakultas Pertanian Universitas Udayana',
            'categories' => ['Business Plan', 'Essay', 'Karya Tulis Ilmiah'],
            'participants' => ['Mahasiswa', 'Umum'],
            'details' => [
               'Fokus Ide' => 'Green Economy, Agroteknologi Berkelanjutan, dan Eco-Tourism Solution',
               'Total Dana Hibah' => 'Rp 25.000.000 (Hibah Pengembangan Bisnis) + Trofi Rektor Unud',
               'Buku Petunjuk' => 'Tersedia di tautan resmi pendaftaran formulir event',
               'Contact Person' => 'Ayu Lestari (087788991122)',
            ],
            'timelines' => [
               ['desc' => 'Batas Pengumpulan Business Model Canvas (BMC)', 'days_offset' => 10, 'hour' => 23, 'duration' => 1],
               ['desc' => 'Pengumuman 10 Finalis Pitching', 'days_offset' => 20, 'hour' => 16, 'duration' => 1],
               ['desc' => 'Demo Day & Pitching di Hadapan Dewan Juri', 'days_offset' => 25, 'hour' => 9, 'duration' => 6],
            ],
         ],

         // 14. Festival Seni & Tari Bali
         [
            'type' => 'Lomba',
            'name' => 'Festival Seni Tradisional Udayana: Lomba Tari Bali & Tabuh Baleganjur',
            'description' => 'Pergelaran akbar kompetisi tari klasik Bali dan keharmonisan tabuh baleganjur antarsekolah dan sanggar seni se-Bali. Menjadi panggung ekspresi generasi muda dalam melestarikan seni budaya adiluhung Pulau Dewata.',
            'location' => 'offline',
            'price' => 120000,
            'days_ahead' => 19,
            'duration_days' => 2,
            'organizer_slug' => 'bem-fakultas-ilmu-budaya',
            'fallback_instance' => 'BEM Fakultas Ilmu Budaya Universitas Udayana',
            'categories' => ['Dance', 'Konser', 'Fotografi'],
            'participants' => ['SD', 'SMP', 'SMA', 'Umum'],
            'details' => [
               'Kategori Tari' => 'Tari Legong Keraton (SMP/SMA) & Tari Tarunajaya (Mahasiswa/Umum)',
               'Hadiah' => 'Piala Gubernur Bali, Piagam Seni Budaya, dan Uang Tunai Puluhan Juta Rupiah',
               'Tempat' => 'Panggung Terbuka Ardha Candra, Taman Budaya Art Center Denpasar',
               'Contact Person' => 'Gusti Ayu Candra (085612345678)',
            ],
            'timelines' => [
               ['desc' => 'Registrasi & Uji Panggung Sanggar', 'days_offset' => 18, 'hour' => 15, 'duration' => 4],
               ['desc' => 'Lomba Babak Tari Klasik Bali', 'days_offset' => 19, 'hour' => 10, 'duration' => 8],
               ['desc' => 'Parade Tabuh Baleganjur & Penyerahan Penghargaan', 'days_offset' => 20, 'hour' => 16, 'duration' => 6],
            ],
         ],

         // 15. Workshop UI/UX & Design System
         [
            'type' => 'Workshop',
            'name' => 'Figma to Code: Masterclass Merancang UI/UX & Design System Berskala Industri',
            'description' => 'Pelatihan intensif bagi calon UI/UX Designer dan Frontend Developer untuk mempelajari pembuatan design tokens, auto-layout tingkat lanjut, manajemen komponen di Figma, hingga translasi langsung ke utility Tailwind CSS.',
            'location' => 'online',
            'price' => 35000,
            'days_ahead' => 7,
            'duration_days' => 1,
            'organizer_slug' => 'hima-teknik-arsitektur',
            'fallback_instance' => 'HIMA Arsitektur Fakultas Teknik',
            'categories' => ['UI/UX Design', 'Web Development'],
            'participants' => ['SMA', 'Mahasiswa', 'Umum'],
            'details' => [
               'Tutor' => 'Lead Product Designer di E-Commerce Ternama Indonesia',
               'Materi' => 'Design System Tokens, Component Variants, Interactive Prototyping, & Developer Handoff',
               'Benefit' => 'UI Kit Figma Senilai Rp 300rb, Akses Template Desain, & E-Sertifikat',
               'Contact Person' => 'Deas Meranggi (081234567072)',
            ],
            'timelines' => [
               ['desc' => 'Pengenalan Fundamental UI Heuristic & Design Token', 'days_offset' => 7, 'hour' => 10, 'duration' => 2],
               ['desc' => 'Praktik Langsung: Building Reusable Component System', 'days_offset' => 7, 'hour' => 13, 'duration' => 3],
               ['desc' => 'Design Critique Session & Tanya Jawab Portofolio', 'days_offset' => 7, 'hour' => 16, 'duration' => 1],
            ],
         ],
      ];

      foreach ($eventsData as $item) {
         $eventType = $types[$item['type']] ?? $types->first();

         // Cari admin yang paling cocok atau fallback ke random admin
         $matchedAdmin = $adminUsers->first(function ($admin) use ($item) {
            return $admin->username === $item['organizer_slug'];
         }) ?? $adminUsers->random();

         $startDate = Carbon::now()->addDays($item['days_ahead']);
         $endDate = (clone $startDate)->addDays($item['duration_days']);

         $instanceName = $item['fallback_instance'];
         if ($matchedAdmin->major) {
            $instanceName = 'Himpunan Mahasiswa ' . $matchedAdmin->major->name;
         } elseif ($matchedAdmin->faculty) {
            $instanceName = 'BEM ' . $matchedAdmin->faculty->name;
         }

         $event = Event::create([
            'user_id' => $matchedAdmin->id,
            'event_type_id' => $eventType->id,
            'name' => $item['name'],
            'description' => $item['description'],
            'faculty' => $matchedAdmin->faculty ? $matchedAdmin->faculty->name : 'Universitas Udayana',
            'major' => $matchedAdmin->major ? $matchedAdmin->major->name : null,
            'instance' => $instanceName,
            'picture' => 'home/image-event-test.png',
            'link' => 'https://docs.google.com/forms/d/e/1FAIpQLSe-dummy-event-unud/viewform',
            'location' => $item['location'],
            'price' => $item['price'],
            'start_date' => $startDate->toDateString(),
            'end_date' => $endDate->toDateString(),
            'status' => true,
         ]);

         // Hubungkan Categories yang relevan
         $categoryIds = [];
         foreach ($item['categories'] as $catName) {
            if (isset($categories[$catName])) {
               $categoryIds[] = $categories[$catName]->id;
            }
         }
         if (!empty($categoryIds)) {
            $event->categories()->sync($categoryIds);
         }

         // Hubungkan Participants yang relevan
         $participantIds = [];
         foreach ($item['participants'] as $partName) {
            if (isset($participants[$partName])) {
               $participantIds[] = $participants[$partName]->id;
            }
         }
         if (!empty($participantIds)) {
            $event->participants()->sync($participantIds);
         }

         // Masukkan detail_events yang kontekstual
         foreach ($item['details'] as $label => $val) {
            DetailEvent::create([
               'event_id' => $event->id,
               'label' => $label,
               'value' => $val,
            ]);
         }

         // Masukkan timelines yang terstruktur
         foreach ($item['timelines'] as $tl) {
            $tlStart = (clone $startDate)
               ->addDays($tl['days_offset'])
               ->setTime($tl['hour'], 0, 0);
            $tlEnd = (clone $tlStart)->addHours($tl['duration']);

            Timeline::create([
               'event_id' => $event->id,
               'description' => $tl['desc'],
               'start' => $tlStart,
               'end' => $tlEnd,
            ]);
         }
      }
   }
}
