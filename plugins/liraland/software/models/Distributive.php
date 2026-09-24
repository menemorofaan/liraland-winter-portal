<?php namespace Liraland\Software\Models;

use Model;

class Distributive extends Model
{
    public $table = 'liraland_software_distributives';
    protected $guarded = [];

    public $attachOne = [
        'file' => ['System\Models\File', 'public' => false]
    ];

    /**
     * Динамический список файлов из папки сервера (storage/app/protected_distributives)
     * Winter CMS автоматически вызывает этот метод для поля 'file_path'
     */
    public function getFilePathOptions()
    {
        $dir = storage_path('app/protected_distributives');

        if (!is_dir($dir)) {
            return [];
        }

        $files = glob($dir . '/*');
        $options = [];

        foreach ($files as $filePath) {
            if (is_file($filePath)) {
                $baseName = basename($filePath);
                $sizeInBytes = filesize($filePath);

                // Человекопонятный размер
                if ($sizeInBytes >= 1073741824) {
                    $sizeFormatted = round($sizeInBytes / 1073741824, 2) . ' GB';
                } else {
                    $sizeFormatted = round($sizeInBytes / 1048576, 1) . ' MB';
                }

                $options[$baseName] = "📁 {$baseName} ({$sizeFormatted})";
            }
        }

        return $options;
    }
}
