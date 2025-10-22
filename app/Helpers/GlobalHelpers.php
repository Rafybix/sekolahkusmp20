<?php

namespace App\Helpers;

trait GlobalHelpers {

    // 🔹 FUNGSI LAMA
    public function generateNumber($request, $prefix = 'BOOK')
    {
        return $prefix . '-' . sprintf("%'.05d", $request->id);
    }

    // 🔹 FUNGSI BARU — Statistik Pengunjung
    public function getVisitorData()
    {
        $ip = request()->ip();
        $agent = request()->header('User-Agent');

        // Deteksi OS
        if (preg_match('/Windows/i', $agent)) {
            $os = 'Windows';
        } elseif (preg_match('/Mac/i', $agent)) {
            $os = 'Mac OS';
        } elseif (preg_match('/Linux/i', $agent)) {
            $os = 'Linux';
        } elseif (preg_match('/Android/i', $agent)) {
            $os = 'Android';
        } elseif (preg_match('/iPhone/i', $agent)) {
            $os = 'iOS';
        } else {
            $os = 'Unknown OS';
        }

        // Deteksi Browser
        if (preg_match('/Chrome/i', $agent)) {
            $browser = 'Chrome';
        } elseif (preg_match('/Safari/i', $agent)) {
            $browser = 'Safari';
        } elseif (preg_match('/Firefox/i', $agent)) {
            $browser = 'Firefox';
        } elseif (preg_match('/Edge/i', $agent)) {
            $browser = 'Edge';
        } elseif (preg_match('/MSIE|Trident/i', $agent)) {
            $browser = 'Internet Explorer';
        } else {
            $browser = 'Unknown Browser';
        }

        return [
            'ip' => $ip,
            'os' => $os,
            'browser' => $browser
        ];
    }
}
