<?php

use Carbon\Carbon;

if (!function_exists('swal_notif')) {
  function swal_notif($icon, $title, $text)
  {
    session()->flash('swal_icon', $icon);
    session()->flash('swal_title', $title);
    session()->flash('swal_text', $text);
  }
}

if (!function_exists('toast_notif')) {
  function toast_notif($icon, $title)
  {
    session()->flash('toast_icon', $icon);
    session()->flash('toast_title', $title);
  }
}

if (!function_exists('indoDate')) {
  function indoDate($tanggal)
  {
    return Carbon::parse($tanggal)->format('d/m/Y');
  }
}

if (!function_exists('indoDateFull')) {
  function indoDateFull($tanggal)
  {
    return Carbon::parse($tanggal)->translatedFormat('d F Y');
  }
}

if (!function_exists('resetTanggal')) {
  function resetTanggal($tanggal)
  {
    return \Carbon\Carbon::createFromFormat('d/m/Y', $tanggal)->format('Y-m-d');
  }
}

if (!function_exists('icon')) {
  function icon($p)
  {
    if ($p == 1) {
      $icon = 'fa-check-circle';
      $text = 'success';
    } elseif ($p == '2') {
      $icon = 'fa-info-circle';
      $text = 'primary';
    } else {
      $icon = 'fa-times-circle';
      $text = 'danger';
    }

    return [
      'icon' => $icon,
      'text' => $text,
    ];
  }
}

if (!function_exists('strTime')) {
  function strTime($time)
  {
    return $time != '' ? Carbon::parse($time)->format('d-m-Y H:i:s') : '';
  }
}
