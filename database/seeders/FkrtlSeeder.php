<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fkrtl;

class FkrtlSeeder extends Seeder
{
    public function run(): void
    {
      
        Fkrtl::truncate();

        
        $data = [
            ["id_fkrtl" => "0120A046", "kode_rumah_sakit" => "RS001", "nama_rumah_sakit" => "Apotik IF RS AMC BANDUNG", "jenis" => "Apotik"],
            ["id_fkrtl" => "0120A044", "kode_rumah_sakit" => "RS002", "nama_rumah_sakit" => "Apotik IF RSUD Cicalengka", "jenis" => "Apotik"],
            ["id_fkrtl" => "0120A042", "kode_rumah_sakit" => "RS003", "nama_rumah_sakit" => "Apotik IF RSUD MAJALAYA", "jenis" => "Apotik"],
            ["id_fkrtl" => "0120A068", "kode_rumah_sakit" => "RS004", "nama_rumah_sakit" => "IF HERMINA SOREANG", "jenis" => "Instalasi Farmasi"],
            ["id_fkrtl" => "0120A070", "kode_rumah_sakit" => "RS005", "nama_rumah_sakit" => "IF KU Hasna Medika Bandung", "jenis" => "Instalasi Farmasi"],
            ["id_fkrtl" => "0120A076", "kode_rumah_sakit" => "RS006", "nama_rumah_sakit" => "IF RS BEDAS KERTASARI", "jenis" => "Instalasi Farmasi"],
            ["id_fkrtl" => "0120A075", "kode_rumah_sakit" => "RS007", "nama_rumah_sakit" => "IF RS LANUD SULAIMAN", "jenis" => "Instalasi Farmasi"],
            ["id_fkrtl" => "0120A071", "kode_rumah_sakit" => "RS008", "nama_rumah_sakit" => "IF RS OETOMO", "jenis" => "Instalasi Farmasi"],
            ["id_fkrtl" => "1002A009", "kode_rumah_sakit" => "RS009", "nama_rumah_sakit" => "IF RSUD Al Ihsan", "jenis" => "Instalasi Farmasi"],
            ["id_fkrtl" => "0120A074", "kode_rumah_sakit" => "RS010", "nama_rumah_sakit" => "IF RSUD BEDAS CIMAUNG", "jenis" => "Instalasi Farmasi"],
            ["id_fkrtl" => "0120A043", "kode_rumah_sakit" => "RS011", "nama_rumah_sakit" => "IF RSUD OTO ISKANDAR DI NATA", "jenis" => "Instalasi Farmasi"],
            ["id_fkrtl" => "0120A065", "kode_rumah_sakit" => "RS012", "nama_rumah_sakit" => "IF RS UKM", "jenis" => "Instalasi Farmasi"],
            ["id_fkrtl" => "0120A066", "kode_rumah_sakit" => "RS013", "nama_rumah_sakit" => "IF RSUD KESEHATAN KERJA", "jenis" => "Instalasi Farmasi"],
            ["id_fkrtl" => "0120A067", "kode_rumah_sakit" => "RS014", "nama_rumah_sakit" => "IF RSU KPBS", "jenis" => "Instalasi Farmasi"],
            ["id_fkrtl" => "0120A069", "kode_rumah_sakit" => "RS015", "nama_rumah_sakit" => "IF KU GENTA ARAS SALAMA", "jenis" => "Instalasi Farmasi"],
            ["id_fkrtl" => "0120A073", "kode_rumah_sakit" => "RS016", "nama_rumah_sakit" => "IF RSMBS", "jenis" => "Instalasi Farmasi"],
            ["id_fkrtl" => "0120S001", "kode_rumah_sakit" => "RS017", "nama_rumah_sakit" => "KU GENTA ARAS SALAMA", "jenis" => "Klinik Utama"],
            ["id_fkrtl" => "0120S003", "kode_rumah_sakit" => "RS018", "nama_rumah_sakit" => "KU HASNA MEDIKA BANDUNG", "jenis" => "Klinik Utama"],
            ["id_fkrtl" => "0120R014", "kode_rumah_sakit" => "RS019", "nama_rumah_sakit" => "RSU KPBS", "jenis" => "Rumah Sakit"],
            ["id_fkrtl" => "0120O005", "kode_rumah_sakit" => "OPT001", "nama_rumah_sakit" => "KING OPTIK", "jenis" => "Optik"],
            ["id_fkrtl" => "0120O006", "kode_rumah_sakit" => "OPT002", "nama_rumah_sakit" => "MERCURY OPTIKAL", "jenis" => "Optik"],
            ["id_fkrtl" => "0120R022", "kode_rumah_sakit" => "RS020", "nama_rumah_sakit" => "MUHAMMADIYAH BANDUNG SELATAN", "jenis" => "Rumah Sakit"],
            ["id_fkrtl" => "0120O002", "kode_rumah_sakit" => "OPT003", "nama_rumah_sakit" => "OPTIK IMAN", "jenis" => "Optik"],
            ["id_fkrtl" => "0120O007", "kode_rumah_sakit" => "OPT004", "nama_rumah_sakit" => "OPTIK INTERNASIONAL", "jenis" => "Optik"],
            ["id_fkrtl" => "0120O004", "kode_rumah_sakit" => "OPT005", "nama_rumah_sakit" => "OPTIK KRIDA", "jenis" => "Optik"],
            ["id_fkrtl" => "0120R007", "kode_rumah_sakit" => "RS021", "nama_rumah_sakit" => "RS AMC", "jenis" => "Rumah Sakit"],
            ["id_fkrtl" => "0120R018", "kode_rumah_sakit" => "RS022", "nama_rumah_sakit" => "RS HERMINA SOREANG", "jenis" => "Rumah Sakit"],
            ["id_fkrtl" => "0120R012", "kode_rumah_sakit" => "RS023", "nama_rumah_sakit" => "RS LANUD SULAIMAN", "jenis" => "Rumah Sakit"],
            ["id_fkrtl" => "0120R020", "kode_rumah_sakit" => "RS024", "nama_rumah_sakit" => "RS RUMAH SAKIT OETOMO", "jenis" => "Rumah Sakit"],
            ["id_fkrtl" => "0120R015", "kode_rumah_sakit" => "RS025", "nama_rumah_sakit" => "RS UNGGUL KARSA MEDIKA(UKM)", "jenis" => "Rumah Sakit"],
            ["id_fkrtl" => "1002R005", "kode_rumah_sakit" => "RS026", "nama_rumah_sakit" => "RSUD AL IHSAN", "jenis" => "Rumah Sakit"],
            ["id_fkrtl" => "0120R023", "kode_rumah_sakit" => "RS027", "nama_rumah_sakit" => "RSUD BEDAS CIMAUNG", "jenis" => "Rumah Sakit"],
            ["id_fkrtl" => "0120R024", "kode_rumah_sakit" => "RS028", "nama_rumah_sakit" => "RSUD BEDAS KERTASARI", "jenis" => "Rumah Sakit"],
            ["id_fkrtl" => "0120R004", "kode_rumah_sakit" => "RS029", "nama_rumah_sakit" => "RSUD CICALENGKA", "jenis" => "Rumah Sakit"],
            ["id_fkrtl" => "0120R017", "kode_rumah_sakit" => "RS030", "nama_rumah_sakit" => "RSUD KESEHATAN KERJA", "jenis" => "Rumah Sakit"],
            ["id_fkrtl" => "1002R002", "kode_rumah_sakit" => "RS031", "nama_rumah_sakit" => "RSUD MAJALAYA", "jenis" => "Rumah Sakit"],
            ["id_fkrtl" => "1002R006", "kode_rumah_sakit" => "RS032", "nama_rumah_sakit" => "RSUD OTO ISKANDAR DI NATA", "jenis" => "Rumah Sakit"],
            ["id_fkrtl" => "0120S004", "kode_rumah_sakit" => "RS033", "nama_rumah_sakit" => "KLINIK UTAMA MATA PRIME AKSARA", "jenis" => "Klinik Utama"]	
        ];

        Fkrtl::insert($data);
    }
}
