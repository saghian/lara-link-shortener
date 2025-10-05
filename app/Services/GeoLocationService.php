<?php

namespace App\Services;

use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use Exception;

class GeoLocationService
{
    private $reader;

    public function __construct()
    {
        // استفاده از فایل dbip-city-lite
        $databasePath = storage_path('app/geoip/dbip-city-lite-2025-10.mmdb');

        // اگر فایل جدید وجود ندارد، از فایل قدیمی استفاده کن
        if (!file_exists($databasePath)) {
            $databasePath = storage_path('app/geoip/GeoLite2-City.mmdb');
        }

        if (!file_exists($databasePath)) {
            // اگر هیچ فایلی وجود ندارد، سیستم بدون موقعیت‌یابی کار می‌کند
            $this->reader = null;
            return;
        }

        try {
            $this->reader = new Reader($databasePath);
        } catch (Exception $e) {
            $this->reader = null;
        }
    }

    /**
     * دریافت اطلاعات موقعیت از IP
     */
    public function getLocationFromIP($ipAddress): array
    {
        // اگر IP لوکال هست
        if ($this->isLocalIP($ipAddress)) {
            return [
                'country' => 'ایران (لوکال)',
                'city' => 'لوکال',
                'country_code' => 'IR',
                'success' => true
            ];
        }

        // اگر reader وجود ندارد (فایل یافت نشد)
        if (!$this->reader) {
            return [
                'country' => 'نامشخص',
                'city' => 'نامشخص',
                'country_code' => null,
                'success' => false,
                'error' => 'فایل دیتابیس موقعیت‌یابی یافت نشد'
            ];
        }

        try {
            $record = $this->reader->city($ipAddress);

            // تبدیل نام کشور به فارسی برای ایران
            $country = $record->country->name ?? 'نامشخص';
            $city = $record->city->name ?? 'نامشخص';

            // if ($country === 'Iran' || $record->country->isoCode === 'IR') {
            //     $country = 'ایران';
            //     // تبدیل نام شهرهای ایران به فارسی (در صورت نیاز)
            //     $city = $this->translateIranianCity($city);
            // }

            return [
                'country' => $country,
                'city' => $city,
                'country_code' => $record->country->isoCode ?? null,
                'success' => true
            ];
        } catch (AddressNotFoundException $e) {
            return [
                'country' => 'نامشخص',
                'city' => 'نامشخص',
                'country_code' => null,
                'success' => false,
                'error' => 'آی‌پی در دیتابیس یافت نشد'
            ];
        } catch (Exception $e) {
            return [
                'country' => 'نامشخص',
                'city' => 'نامشخص',
                'country_code' => null,
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * ترجمه نام شهرهای ایران به فارسی
     */
    private function translateIranianCity($englishCityName): string
    {
        $cityTranslations = [
            'Tehran' => 'تهران',
            'Mashhad' => 'مشهد',
            'Isfahan' => 'اصفهان',
            'Karaj' => 'کرج',
            'Tabriz' => 'تبریز',
            'Shiraz' => 'شیراز',
            'Qom' => 'قم',
            'Ahvaz' => 'اهواز',
            'Kermanshah' => 'کرمانشاه',
            'Urmia' => 'ارومیه',
            'Rasht' => 'رشت',
            'Zahedan' => 'زاهدان',
            'Hamadan' => 'همدان',
            'Kerman' => 'کرمان',
            'Yazd' => 'یزد',
            'Ardabil' => 'اردبیل',
            'Bandar Abbas' => 'بندرعباس',
            'Arak' => 'اراک',
            'Eslamshahr' => 'اسلامشهر',
            'Zanjan' => 'زنجان',
            'Sanandaj' => 'سنندج',
            'Qazvin' => 'قزوین',
            'Khorramabad' => 'خرم آباد',
            'Gorgan' => 'گرگان',
            'Sari' => 'ساری',
            'Shahriar' => 'شهریار',
            'Malard' => 'ملارد',
            'Qods' => 'قدس',
            'Kashan' => 'کاشان',
            'Varamin' => 'ورامین',
            'Semnan' => 'سمنان',
            'Saveh' => 'ساوه',
            'Mahshahr' => 'ماهشهر',
            'Khomeini Shahr' => 'خمینی شهر',
            'Najafabad' => 'نجف آباد',
            'Borujerd' => 'بروجرد',
            'Neyshabur' => 'نیشابور',
            'Babol' => 'بابل',
            'Amol' => 'آمل',
            'Khoy' => 'خوی',
            'Sirjan' => 'سیرجان',
            'Birjand' => 'بیرجند',
            'Bojnurd' => 'بجنورد',
            'Ilam' => 'ایلام',
            'Bushehr' => 'بوشهر',
            'Sabzevar' => 'سبزوار',
            'Quchan' => 'قوچان',
            'Maragheh' => 'مراغه',
            'Shahrud' => 'شاهرود',
            'Gonbad-e Qabus' => 'گنبد کاووس',
            'Kashmar' => 'کاشمر',
            'Shadegan' => 'شادگان',
            'Marvdasht' => 'مرودشت',
            'Bandar-e Anzali' => 'بندر انزلی',
            'Fasa' => 'فسا',
            'Kangan' => 'کنگان',
            'Behbehan' => 'بهبهان',
            'Yasuj' => 'یاسوج',
            'Chabahar' => 'چابهار',
            'Robat Karim' => 'رباط کریم',
            'Pakdasht' => 'پاکدشت',
            'Kish' => 'کیش',
            'Qeshm' => 'قشم',
        ];

        return $cityTranslations[$englishCityName] ?? $englishCityName;
    }

    /**
     * بررسی IP لوکال
     */
    private function isLocalIP($ipAddress): bool
    {
        $localIPs = [
            '127.0.0.1',
            '::1',
            'localhost'
        ];

        return in_array($ipAddress, $localIPs) ||
            substr($ipAddress, 0, 3) === '10.' ||
            substr($ipAddress, 0, 8) === '192.168.' ||
            substr($ipAddress, 0, 7) === '172.16.';
    }

    /**
     * بررسی وجود دیتابیس
     */
    public function isDatabaseAvailable(): bool
    {
        return $this->reader !== null;
    }

    /**
     * دریافت اطلاعات فایل دیتابیس
     */
    public function getDatabaseInfo(): array
    {
        if (!$this->reader) {
            return ['available' => false];
        }

        try {
            $metadata = $this->reader->metadata();

            return [
                'available' => true,
                'database_type' => $metadata->databaseType,
                'binary_version' => $metadata->binaryFormatMajorVersion . '.' . $metadata->binaryFormatMinorVersion,
                'build_time' => $metadata->buildDate->format('Y-m-d H:i:s'),
                'node_count' => $metadata->nodeCount,
                'record_size' => $metadata->recordSize,
            ];
        } catch (Exception $e) {
            return ['available' => false, 'error' => $e->getMessage()];
        }
    }
}
