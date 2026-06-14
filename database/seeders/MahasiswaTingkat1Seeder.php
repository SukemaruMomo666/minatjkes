<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MahasiswaTingkat1Seeder extends Seeder
{
    public function run(): void
    {
        $kelas1A = Kelas::create([
            'nama_kelas' => '1A Keperawatan',
            'angkatan' => 2025,
            'is_active' => true,
        ]);

        $kelas1B = Kelas::create([
            'nama_kelas' => '1B Keperawatan',
            'angkatan' => 2025,
            'is_active' => true,
        ]);

        $kelas1C = Kelas::create([
            'nama_kelas' => '1C Keperawatan',
            'angkatan' => 2025,
            'is_active' => true,
        ]);

        $kelas1D = Kelas::create([
            'nama_kelas' => '1D Keperawatan',
            'angkatan' => 2025,
            'is_active' => true,
        ]);

        $kelas1E = Kelas::create([
            'nama_kelas' => '1E Keperawatan',
            'angkatan' => 2025,
            'is_active' => true,
        ]);

        $mahasiswa = [
            // Kelas 1A (31 mahasiswa)
            ['nim' => '10407001', 'nama' => 'Aat Tamara', 'kelas_id' => $kelas1A->id],
            ['nim' => '10407006', 'nama' => 'Alena Feriska Alzahra', 'kelas_id' => $kelas1A->id],
            ['nim' => '10407011', 'nama' => 'Alika Nagita Zahra', 'kelas_id' => $kelas1A->id],
            ['nim' => '10407016', 'nama' => 'Amelia Putri', 'kelas_id' => $kelas1A->id],
            ['nim' => '10407021', 'nama' => 'Andri Aditia Nugraha', 'kelas_id' => $kelas1A->id],
            ['nim' => '10407026', 'nama' => 'Azrina Shefyra P.', 'kelas_id' => $kelas1A->id],
            ['nim' => '10407036', 'nama' => 'Devi Rahma Natasari', 'kelas_id' => $kelas1A->id],
            ['nim' => '10407041', 'nama' => 'Dinie Novitawidiana', 'kelas_id' => $kelas1A->id],
            ['nim' => '10407046', 'nama' => 'Eva Septiana', 'kelas_id' => $kelas1A->id],
            ['nim' => '10407051', 'nama' => 'Fika Azalia Renata', 'kelas_id' => $kelas1A->id],
            ['nim' => '10407056', 'nama' => 'Gina Nurul Agniya', 'kelas_id' => $kelas1A->id],
            ['nim' => '10407061', 'nama' => 'Hany Isnaeny Fairus', 'kelas_id' => $kelas1A->id],
            ['nim' => '10407066', 'nama' => 'Indri', 'kelas_id' => $kelas1A->id],
            ['nim' => '10407071', 'nama' => 'Kirana Lady Griselda', 'kelas_id' => $kelas1A->id],
            ['nim' => '10407076', 'nama' => 'M Irpan Abdul Hakim', 'kelas_id' => $kelas1A->id],
            ['nim' => '10407081', 'nama' => 'Meisya Aulia Azzahra', 'kelas_id' => $kelas1A->id],
            ['nim' => '10407086', 'nama' => 'Mustika Mely Salamah', 'kelas_id' => $kelas1A->id],
            ['nim' => '10407091', 'nama' => 'Naurah Fairuz Nadhifa', 'kelas_id' => $kelas1A->id],
            ['nim' => '10407096', 'nama' => 'Nimatul Khoirina', 'kelas_id' => $kelas1A->id],
            ['nim' => '10407101', 'nama' => 'Novia Pertiwi', 'kelas_id' => $kelas1A->id],
            ['nim' => '10407106', 'nama' => 'Puji Lestari', 'kelas_id' => $kelas1A->id],
            ['nim' => '10407111', 'nama' => 'Rahmatul Fuadah', 'kelas_id' => $kelas1A->id],
            ['nim' => '10407116', 'nama' => 'Refina Pramudya Yofalik', 'kelas_id' => $kelas1A->id],
            ['nim' => '10407121', 'nama' => 'Revania Anggisha', 'kelas_id' => $kelas1A->id],
            ['nim' => '10407126', 'nama' => 'Risya Ardanis Fanisa', 'kelas_id' => $kelas1A->id],
            ['nim' => '10407131', 'nama' => 'Sazkia Putri Nurizqiati', 'kelas_id' => $kelas1A->id],
            ['nim' => '10407136', 'nama' => 'Silvani Dwi Julianty', 'kelas_id' => $kelas1A->id],
            ['nim' => '10407141', 'nama' => 'Susan Agustina', 'kelas_id' => $kelas1A->id],
            ['nim' => '10407146', 'nama' => 'Tania Tessalonika Sinaga', 'kelas_id' => $kelas1A->id],
            ['nim' => '10407151', 'nama' => 'Winda Nur Riezka Apriliana', 'kelas_id' => $kelas1A->id],
            ['nim' => '10407156', 'nama' => 'Zalva Azzahra Ramadhani Rahmat', 'kelas_id' => $kelas1A->id],

            // Kelas 1B (31 mahasiswa)
            ['nim' => '10407002', 'nama' => 'Agisca Nisfi Azzahra', 'kelas_id' => $kelas1B->id],
            ['nim' => '10407007', 'nama' => 'Ales Fermatasari', 'kelas_id' => $kelas1B->id],
            ['nim' => '10407012', 'nama' => 'Alikha Yara Mulyadin', 'kelas_id' => $kelas1B->id],
            ['nim' => '10407017', 'nama' => 'Ana Falerian', 'kelas_id' => $kelas1B->id],
            ['nim' => '10407022', 'nama' => 'Anggi Suryani', 'kelas_id' => $kelas1B->id],
            ['nim' => '10407027', 'nama' => 'Baruna Fata Hardani', 'kelas_id' => $kelas1B->id],
            ['nim' => '10407032', 'nama' => 'Chicha Dahlia', 'kelas_id' => $kelas1B->id],
            ['nim' => '10407037', 'nama' => 'Dian Ayu Pasya', 'kelas_id' => $kelas1B->id],
            ['nim' => '10407042', 'nama' => 'Dwi Andini', 'kelas_id' => $kelas1B->id],
            ['nim' => '10407047', 'nama' => 'Fachrul Adha Kurniadi', 'kelas_id' => $kelas1B->id],
            ['nim' => '10407052', 'nama' => 'Firda Ratna Olivia', 'kelas_id' => $kelas1B->id],
            ['nim' => '10407057', 'nama' => 'Gita Manda Wulandari', 'kelas_id' => $kelas1B->id],
            ['nim' => '10407062', 'nama' => 'Hazimah Zulfa Rahmah', 'kelas_id' => $kelas1B->id],
            ['nim' => '10407067', 'nama' => 'Insiyat Haura Mamnun', 'kelas_id' => $kelas1B->id],
            ['nim' => '10407072', 'nama' => 'Kurniawati', 'kelas_id' => $kelas1B->id],
            ['nim' => '10407082', 'nama' => 'Meita Sania Lestari', 'kelas_id' => $kelas1B->id],
            ['nim' => '10407087', 'nama' => 'Mutiara Tri Delya', 'kelas_id' => $kelas1B->id],
            ['nim' => '10407092', 'nama' => 'Naya Khoirunisa', 'kelas_id' => $kelas1B->id],
            ['nim' => '10407097', 'nama' => 'Ningrumsari', 'kelas_id' => $kelas1B->id],
            ['nim' => '10407102', 'nama' => 'Nuzma Hamdah', 'kelas_id' => $kelas1B->id],
            ['nim' => '10407107', 'nama' => 'Putri Ayu', 'kelas_id' => $kelas1B->id],
            ['nim' => '10407112', 'nama' => 'Rasya Afdhal Ramadhan', 'kelas_id' => $kelas1B->id],
            ['nim' => '10407117', 'nama' => 'Rena Delima', 'kelas_id' => $kelas1B->id],
            ['nim' => '10407122', 'nama' => 'Revty Novira Putri', 'kelas_id' => $kelas1B->id],
            ['nim' => '10407127', 'nama' => 'Rizqi Annisa', 'kelas_id' => $kelas1B->id],
            ['nim' => '10407132', 'nama' => 'Selfiana Anggraeni', 'kelas_id' => $kelas1B->id],
            ['nim' => '10407137', 'nama' => 'Siska Amelia', 'kelas_id' => $kelas1B->id],
            ['nim' => '10407142', 'nama' => 'Syahira Ramadhani', 'kelas_id' => $kelas1B->id],
            ['nim' => '10407147', 'nama' => 'Tayudin', 'kelas_id' => $kelas1B->id],
            ['nim' => '10407152', 'nama' => 'Windi Tri Hapsari', 'kelas_id' => $kelas1B->id],
            ['nim' => '10407157', 'nama' => 'Zulfa Rasyidah', 'kelas_id' => $kelas1B->id],

            // Kelas 1C (30 mahasiswa)
            ['nim' => '10407003', 'nama' => 'Agista Aprillia Rosita', 'kelas_id' => $kelas1C->id],
            ['nim' => '10407008', 'nama' => 'Alexca Putri Darmawan', 'kelas_id' => $kelas1C->id],
            ['nim' => '10407013', 'nama' => 'Aliyah Hadi Meilani', 'kelas_id' => $kelas1C->id],
            ['nim' => '10407023', 'nama' => 'Anggia Wulandari', 'kelas_id' => $kelas1C->id],
            ['nim' => '10407028', 'nama' => 'Bunga Keyla Juliyanti', 'kelas_id' => $kelas1C->id],
            ['nim' => '10407033', 'nama' => 'Clarissa Salsabilla Maulani', 'kelas_id' => $kelas1C->id],
            ['nim' => '10407038', 'nama' => 'Dian Pramudita', 'kelas_id' => $kelas1C->id],
            ['nim' => '10407043', 'nama' => 'Elsa Noviana', 'kelas_id' => $kelas1C->id],
            ['nim' => '10407048', 'nama' => 'Farah Suci Andriana', 'kelas_id' => $kelas1C->id],
            ['nim' => '10407053', 'nama' => 'Frisci Elikha', 'kelas_id' => $kelas1C->id],
            ['nim' => '10407058', 'nama' => 'Hafsah Nuraisah', 'kelas_id' => $kelas1C->id],
            ['nim' => '10407063', 'nama' => 'Heksa Indah Triana', 'kelas_id' => $kelas1C->id],
            ['nim' => '10407068', 'nama' => 'Intan Mariani', 'kelas_id' => $kelas1C->id],
            ['nim' => '10407073', 'nama' => 'Lea Hayati', 'kelas_id' => $kelas1C->id],
            ['nim' => '10407078', 'nama' => 'Mardiah Nur Azizah', 'kelas_id' => $kelas1C->id],
            ['nim' => '10407083', 'nama' => 'Melvi Umul Hasanah', 'kelas_id' => $kelas1C->id],
            ['nim' => '10407088', 'nama' => 'Nadine Alifka Khairunisa', 'kelas_id' => $kelas1C->id],
            ['nim' => '10407093', 'nama' => 'Nazwa Muluddari', 'kelas_id' => $kelas1C->id],
            ['nim' => '10407098', 'nama' => 'Nissa Aulia Nuralifah', 'kelas_id' => $kelas1C->id],
            ['nim' => '10407103', 'nama' => 'Nysrina Nursyahbani Santosa', 'kelas_id' => $kelas1C->id],
            ['nim' => '10407108', 'nama' => 'Putri Ediestyani', 'kelas_id' => $kelas1C->id],
            ['nim' => '10407113', 'nama' => 'Ratna Indahwati', 'kelas_id' => $kelas1C->id],
            ['nim' => '10407118', 'nama' => 'Renita Nadia Irhana', 'kelas_id' => $kelas1C->id],
            ['nim' => '10407123', 'nama' => 'Rezkyani Dwi Ramadhan', 'kelas_id' => $kelas1C->id],
            ['nim' => '10407128', 'nama' => 'Saila Nuril Afiva', 'kelas_id' => $kelas1C->id],
            ['nim' => '10407133', 'nama' => 'Selvia Septianti', 'kelas_id' => $kelas1C->id],
            ['nim' => '10407138', 'nama' => 'Siti Mulia Rahmah Azzahra', 'kelas_id' => $kelas1C->id],
            ['nim' => '10407143', 'nama' => 'Syaikh Pahlevi Kurniawan', 'kelas_id' => $kelas1C->id],
            ['nim' => '10407148', 'nama' => 'Tiara Dewi Wulansari', 'kelas_id' => $kelas1C->id],
            ['nim' => '10407153', 'nama' => 'Yulianti Sri Rahmawati', 'kelas_id' => $kelas1C->id],

            // Kelas 1D (31 mahasiswa)
            ['nim' => '10407004', 'nama' => 'Agni Azkaidi Kencana Putri', 'kelas_id' => $kelas1D->id],
            ['nim' => '10407009', 'nama' => 'Alfha Farrel Geraldo', 'kelas_id' => $kelas1D->id],
            ['nim' => '10407014', 'nama' => 'Alsya Meylani', 'kelas_id' => $kelas1D->id],
            ['nim' => '10407019', 'nama' => 'Andhini Dwi Syahfitri', 'kelas_id' => $kelas1D->id],
            ['nim' => '10407024', 'nama' => 'Anisa Yustari Oktavia', 'kelas_id' => $kelas1D->id],
            ['nim' => '10407029', 'nama' => 'Cahaya Khoirunnisa Pratiwi', 'kelas_id' => $kelas1D->id],
            ['nim' => '10407034', 'nama' => 'Cut Puan Kamelia Fonna', 'kelas_id' => $kelas1D->id],
            ['nim' => '10407039', 'nama' => 'Dinar Khairunnisa', 'kelas_id' => $kelas1D->id],
            ['nim' => '10407044', 'nama' => 'Esti Nugroho', 'kelas_id' => $kelas1D->id],
            ['nim' => '10407049', 'nama' => 'Farhan Nurmahmudin', 'kelas_id' => $kelas1D->id],
            ['nim' => '10407054', 'nama' => 'Fuzy Febriyanti', 'kelas_id' => $kelas1D->id],
            ['nim' => '10407059', 'nama' => 'Handika Maulana', 'kelas_id' => $kelas1D->id],
            ['nim' => '10407064', 'nama' => 'Helena Sophia Ardianty', 'kelas_id' => $kelas1D->id],
            ['nim' => '10407069', 'nama' => 'Intan Novita', 'kelas_id' => $kelas1D->id],
            ['nim' => '10407074', 'nama' => 'Lizelit Syarif', 'kelas_id' => $kelas1D->id],
            ['nim' => '10407079', 'nama' => 'Mares Kaur Sula Lintang', 'kelas_id' => $kelas1D->id],
            ['nim' => '10407084', 'nama' => 'Moulidya Aprilliansyah', 'kelas_id' => $kelas1D->id],
            ['nim' => '10407089', 'nama' => 'Nagita Sutrisno', 'kelas_id' => $kelas1D->id],
            ['nim' => '10407094', 'nama' => 'Neilan El Nazziah', 'kelas_id' => $kelas1D->id],
            ['nim' => '10407099', 'nama' => 'Nita Ernika Dewi', 'kelas_id' => $kelas1D->id],
            ['nim' => '10407104', 'nama' => 'Panji Al Fathdry', 'kelas_id' => $kelas1D->id],
            ['nim' => '10407109', 'nama' => 'Rahmah Fauziah Fatimah', 'kelas_id' => $kelas1D->id],
            ['nim' => '10407114', 'nama' => 'Ratna Sari', 'kelas_id' => $kelas1D->id],
            ['nim' => '10407119', 'nama' => 'Resta Saskia Hafsari', 'kelas_id' => $kelas1D->id],
            ['nim' => '10407124', 'nama' => 'Riska Febrianty', 'kelas_id' => $kelas1D->id],
            ['nim' => '10407129', 'nama' => 'Salsabila Rizqya Putri', 'kelas_id' => $kelas1D->id],
            ['nim' => '10407134', 'nama' => 'Septiani Putri Ramadhani', 'kelas_id' => $kelas1D->id],
            ['nim' => '10407139', 'nama' => 'Siwi Hastiwi Pramesti', 'kelas_id' => $kelas1D->id],
            ['nim' => '10407144', 'nama' => 'Syifa Aulia Rahman', 'kelas_id' => $kelas1D->id],
            ['nim' => '10407149', 'nama' => 'Versa Resviana', 'kelas_id' => $kelas1D->id],
            ['nim' => '10407154', 'nama' => 'Yuni Komalasari', 'kelas_id' => $kelas1D->id],

            // Kelas 1E (30 mahasiswa)
            ['nim' => '10407005', 'nama' => 'Agnia Istiazah Safarani', 'kelas_id' => $kelas1E->id],
            ['nim' => '10407010', 'nama' => 'Alfira Chelsa Riani', 'kelas_id' => $kelas1E->id],
            ['nim' => '10407015', 'nama' => 'Alya Rizza Rahmawati', 'kelas_id' => $kelas1E->id],
            ['nim' => '10407020', 'nama' => 'Andina Umar Ramadhani', 'kelas_id' => $kelas1E->id],
            ['nim' => '10407025', 'nama' => 'Annisa Rodliatul Qulub', 'kelas_id' => $kelas1E->id],
            ['nim' => '10407030', 'nama' => 'Cantika Nurul Zalilah', 'kelas_id' => $kelas1E->id],
            ['nim' => '10407035', 'nama' => 'Daryatul Alifah', 'kelas_id' => $kelas1E->id],
            ['nim' => '10407040', 'nama' => 'Dinda Tiara Hasna', 'kelas_id' => $kelas1E->id],
            ['nim' => '10407045', 'nama' => 'Esty Arya Ditasya', 'kelas_id' => $kelas1E->id],
            ['nim' => '10407050', 'nama' => 'Fifi Dwiyanti', 'kelas_id' => $kelas1E->id],
            ['nim' => '10407055', 'nama' => 'Giazi Al Rasyid Mulyawan', 'kelas_id' => $kelas1E->id],
            ['nim' => '10407060', 'nama' => 'Hanufah Nur Aulisa Hijri', 'kelas_id' => $kelas1E->id],
            ['nim' => '10407065', 'nama' => 'Icha Aulia Predika', 'kelas_id' => $kelas1E->id],
            ['nim' => '10407070', 'nama' => 'Khairun Nisa', 'kelas_id' => $kelas1E->id],
            ['nim' => '10407075', 'nama' => 'Lulu Aulia Fitriyatunnisa', 'kelas_id' => $kelas1E->id],
            ['nim' => '10407080', 'nama' => 'Maulinda Atikah', 'kelas_id' => $kelas1E->id],
            ['nim' => '10407085', 'nama' => 'Muhamad Farel Suryapratama', 'kelas_id' => $kelas1E->id],
            ['nim' => '10407095', 'nama' => 'Nida Estuningtyas', 'kelas_id' => $kelas1E->id],
            ['nim' => '10407100', 'nama' => 'Nova Nurazizah', 'kelas_id' => $kelas1E->id],
            ['nim' => '10407105', 'nama' => 'Pipik Diana Erawati', 'kelas_id' => $kelas1E->id],
            ['nim' => '10407110', 'nama' => 'Rahmathunissa Ilma Aulia Dinata', 'kelas_id' => $kelas1E->id],
            ['nim' => '10407115', 'nama' => 'Rd. Ratu Gustiana Yusi Winarti', 'kelas_id' => $kelas1E->id],
            ['nim' => '10407120', 'nama' => 'Reva Naufal Aprilia Kusnadi', 'kelas_id' => $kelas1E->id],
            ['nim' => '10407125', 'nama' => 'Riska Irma Wulansari', 'kelas_id' => $kelas1E->id],
            ['nim' => '10407130', 'nama' => 'Sarah Syaheera', 'kelas_id' => $kelas1E->id],
            ['nim' => '10407135', 'nama' => 'Shaquille Alzam Hidayat', 'kelas_id' => $kelas1E->id],
            ['nim' => '10407140', 'nama' => 'Sulekha', 'kelas_id' => $kelas1E->id],
            ['nim' => '10407145', 'nama' => 'Syifa Ragil Fadillah', 'kelas_id' => $kelas1E->id],
            ['nim' => '10407150', 'nama' => 'Winda Lydia Putri', 'kelas_id' => $kelas1E->id],
            ['nim' => '10407155', 'nama' => 'Zahra Putri Satibi', 'kelas_id' => $kelas1E->id],
        ];

        foreach ($mahasiswa as $data) {
            User::create([
                'nim_nidn' => $data['nim'],
                'nama' => $data['nama'],
                'email' => strtolower(str_replace(' ', '.', $data['nim'])).'@student.polsub.ac.id',
                'password' => Hash::make($data['nim']),
                'role' => UserRole::Mahasiswa,
                'kelas_id' => $data['kelas_id'],
                'is_active' => true,
            ]);
        }
    }
}
