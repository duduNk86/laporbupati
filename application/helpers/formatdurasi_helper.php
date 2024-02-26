<?php

if (!function_exists('formatDurasi')) {
    function formatDurasi($totalDetik)
    {
        $hari = floor($totalDetik / (24 * 60 * 60));
        $sisaDetik = $totalDetik % (24 * 60 * 60);
        $jam = floor($sisaDetik / (60 * 60));
        $sisaDetik = $sisaDetik % (60 * 60);
        $menit = floor($sisaDetik / 60);

        return "<b>{$hari}</b> hari <b>{$jam}</b> jam <b>{$menit}</b> menit";
    }
}
