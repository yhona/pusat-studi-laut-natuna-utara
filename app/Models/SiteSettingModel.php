<?php

namespace App\Models;

use CodeIgniter\Model;

class SiteSettingModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'site_settings';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'address',
        'address_en',
        'email',
        'phone',
        'hours_weekday',
        'hours_friday',
        'hours_weekend',
        'youtube_url',
        'instagram_url',
        'twitter_url',
        'linkedin_url',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected static ?array $cachedSettings = null;

    /**
     * Get site settings with guaranteed fallbacks.
     */
    public static function getSettings(): array
    {
        if (self::$cachedSettings !== null) {
            return self::$cachedSettings;
        }

        $default = [
            'id'            => 1,
            'address'       => 'Gedung LPPM UMRAH Lantai 2, Kampus Terpadu Dompak, Jl. Politeknik, Kota Tanjungpinang, Kepulauan Riau 29111',
            'address_en'    => 'LPPM UMRAH Building, 2nd Floor, Dompak Main Campus, Jl. Politeknik, Tanjungpinang City, Riau Islands 29111, Indonesia',
            'email'         => 'pusatstudilautnatunautara@umrah.ac.id',
            'phone'         => '(0771) 4500089 / 4500090',
            'hours_weekday' => '08.00 – 16.00 WIB',
            'hours_friday'  => '08.00 – 16.30 WIB',
            'hours_weekend' => 'Tutup / Closed',
            'youtube_url'   => 'https://youtube.com/@umrah',
            'instagram_url' => 'https://instagram.com/umrah.ac.id',
            'twitter_url'   => 'https://x.com/umrah_official',
            'linkedin_url'  => 'https://linkedin.com/school/umrah',
        ];

        try {
            $model = new self();
            $row = $model->first();
            if ($row && is_array($row)) {
                self::$cachedSettings = array_merge($default, $row);
                return self::$cachedSettings;
            }
        } catch (\Throwable $e) {
            log_message('error', 'SiteSettingModel::getSettings error: ' . $e->getMessage());
        }

        self::$cachedSettings = $default;
        return self::$cachedSettings;
    }

    /**
     * Clear in-memory cache when settings are updated.
     */
    public static function clearSettingsCache(): void
    {
        self::$cachedSettings = null;
    }
}
