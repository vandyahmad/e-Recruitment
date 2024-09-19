<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class PelamarNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $nama;
    public $status;
    public $minat;
    public $minat_lokasi;
    public $activity;
    public $lokasi;
    public $jadwal;
    public $keterangan;
    public $id_pelamar;
    public $isFirstInterview;

    public function __construct($nama, $status, $minat, $minat_lokasi, $activity, $lokasi, $jadwal, $keterangan, $id_pelamar, $isFirstInterview)
    {
        $this->nama = $nama;
        $this->status = $status;
        $this->minat = $minat;
        $this->minat_lokasi = $minat_lokasi;
        $this->activity = $activity;
        $this->lokasi = $lokasi;
        $this->jadwal = $jadwal;
        $this->keterangan = $keterangan;
        $this->id_pelamar = $id_pelamar;
        $this->isFirstInterview = $isFirstInterview;

    }

    public function build()
    {
        return $this->view('emails.email-activity-pelamar')
            ->subject("Rekrutmen ecoCare Group Company (" . $this->minat . ")")
            ->with([
                'nama' => $this->nama,
                'status' => $this->status,
                'minat' => $this->minat,
                'minat_lokasi' => $this->minat_lokasi,
                'this_activity' => $this->activity,
                'lokasi' => $this->lokasi,
                'jadwal' => $this->jadwal,
                'keterangan' => $this->keterangan,
                'id_pelamar' => $this->id_pelamar,
                'isFirstInterview' => $this->isFirstInterview,
            ]);
    }
}
