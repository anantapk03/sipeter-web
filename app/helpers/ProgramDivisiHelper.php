<?php

namespace App\Helpers;

class ProgramDivisiHelper
{
    const KESEHATAN_UMUM_DESA = 'kesehatan-umum-desa';
    const ANOTHER_PROMKES = 'another-program-promkes';
    const UKS = 'program Usaha Kesehatan Sekolah';
    const ANOTHER_KIA_GIZI = 'another-program-kia-gizi';
    const IMUNISASI = 'imunisasi';
    const ANOTHER_P2P = 'another-program-pengendalian-penyakit';
    const ALL_KESEHATAN_LINGKUNGAN = 'all-kesehatan-lingkungan';
    const ADMIN_ACCESS = 'admin-access';

    public static function getProgramList()
    {
        return [
            self::KESEHATAN_UMUM_DESA,
            self::ANOTHER_PROMKES,
            self::UKS,
            self::ANOTHER_KIA_GIZI,
            self::IMUNISASI,
            self::ANOTHER_P2P,
            self::ALL_KESEHATAN_LINGKUNGAN,
            self::ADMIN_ACCESS,
        ];
    }
}
