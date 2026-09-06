<?php

namespace App\Controllers;

class Layanan extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Layanan & Jasa Konsultasi Kemaritiman - UMRAH',
            
            'services' => [
                [
                    'id'          => 'batimetri',
                    'icon'        => 'fa-water',
                    'title'       => 'Jasa Survei Batimetri & Hidro-Oseanografi',
                    'desc'        => 'Pemetaan batimetri detail untuk alur pelayaran kapal, perencanaan dermaga/pelabuhan, studi erosi pantai, dan analisis sedimentasi pelabuhan.',
                    'instruments' => ['Singlebeam & Multibeam Echosounder', 'Acoustic Doppler Current Profiler (ADCP)', 'Tide Gauge Sensor Otomatis', 'RTK-DGPS Kelautan'],
                    'deliverables'=> ['Peta Batimetri Skala 1:1000 - 1:5000', 'Model Hidrodinamika Arus dan Pasang Surut', 'Laporan Analisis Oseanografi Berstandar IHO']
                ],
                [
                    'id'          => 'amdal',
                    'icon'        => 'fa-flask-vial',
                    'title'       => 'Jasa Analisis Kualitas Air Laut & AMDAL Pesisir',
                    'desc'        => 'Uji laboratorium parameter oseanografi kimia, biologi, dan fisika guna keperluan izin lingkungan industri perkapalan, pariwisata bahari, dan tambak.',
                    'instruments' => ['CTD (Conductivity, Temperature, Depth)', 'Spectrophotometer UV-Vis Kelautan', 'Water Sampler Van Dorn & Niskin', 'DO/Salinity/pH Multi-parameter Probe'],
                    'deliverables'=> ['Sertifikat Hasil Uji Laboratorium Terakreditasi', 'Kajian Daya Dukung Lingkungan Perairan', 'Dokumen Rona Lingkungan Awal AMDAL / UKL-UPL']
                ],
                [
                    'id'          => 'zonasi',
                    'icon'        => 'fa-map-location-dot',
                    'title'       => 'Kajian RZWP-3-K & Perencanaan Ruang Laut',
                    'desc'        => 'Konsultasi teknis dan pendampingan penyusunan rencana zonasi wilayah pesisir dan pulau-pulau kecil, penetapan kawasan konservasi daerah, dan analisis spasial tumpang tindih pemanfaatan ruang laut.',
                    'instruments' => ['Software GIS Kelautan & Geodatabase Spasial', 'Citra Satelit Sentinel & Landsat Resolusi Tinggi', 'Drone Surveillance Wilayah Pesisir'],
                    'deliverables'=> ['Peta Tematik Spasial Berstandar BIG', 'Naskah Akademis Kebijakan Zonasi Kelautan', 'Model Penyelesaian Konflik Ruang Pemanfaatan']
                ],
                [
                    'id'          => 'pelatihan',
                    'icon'        => 'fa-chalkboard-user',
                    'title'       => 'Pelatihan Teknis & Sertifikasi GIS Kelautan',
                    'desc'        => 'Program pelatihan intensif bagi instansi pemerintah (Dinas Kelautan/Bappeda), konsultan lingkungan, periset, dan mahasiswa profesional.',
                    'instruments' => ['Laboratorium Komputasi GIS Kampus Dompak', 'Modul Berbasis Open Source & ArcGIS', 'Data Spasial Nyata Selat Malaka & Natuna'],
                    'deliverables'=> ['Sertifikat Pelatihan Resmi LPPM UMRAH', 'Portofolio Peta Analisis Kelautan', 'Konsultasi Pasca-Pelatihan Bersama Instruktur']
                ],
            ]
        ];

        return view('pages/layanan', $data);
    }
}
