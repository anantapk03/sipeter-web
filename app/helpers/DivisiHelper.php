<?php

namespace App\Helpers;

class DivisiHelper
{
    // Constants to hold division names
    public const PROMOSI_KESEHATAN = 'promosi-kesehatan';
    public const KESEHATAN_LINGKUNGAN = 'kesehatan-lingkungan';
    public const KESEHATAN_IBU_ANAK_GIZI = 'kesehatan-ibu-anak-gizi';
    public const PENCEGAHAN_PENGENDALIAN_PENYAKIT = 'pencegahan-dan-pengendalian-penyakit';
    public const ADMIN = 'admin';

    // Optionally, you can create a method to get all divisions as an array
    public static function getAllDivisi()
    {
        return [
            self::PROMOSI_KESEHATAN,
            self::KESEHATAN_LINGKUNGAN,
            self::KESEHATAN_IBU_ANAK_GIZI,
            self::PENCEGAHAN_PENGENDALIAN_PENYAKIT,
            self::ADMIN,
        ];
    }
}
