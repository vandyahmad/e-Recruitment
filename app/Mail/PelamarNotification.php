<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
// use Illuminate\Mail\Mailables\Content;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PelamarNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    /**
     * Build the message.
     *
     * @return $this
     */

    public $nama;
    public $status;
    public $minat;
    public $activity;
    public $lokasi;
    public $jadwal;
    public $keterangan;
    public $id_pelamar;


    public function __construct($nama, $status, $minat, $activity, $lokasi, $jadwal, $keterangan, $id_pelamar)
    {
        $this->nama = $nama;
        $this->status = $status;
        $this->minat = $minat;
        $this->activity = $activity;
        $this->lokasi = $lokasi;
        $this->jadwal = $jadwal;
        $this->keterangan = $keterangan;
        $this->id_pelamar = $id_pelamar;
    }

    public function build()
    {
        // return $this->view('emails.email-activity-pelamar');
        return $this->view('emails.email-activity-pelamar')
        ->subject("Your Application Status Update (".$this->minat.")")
            ->with(
                [
                    'nama' => $this->nama,
                    'status' => $this->status,
                    'minat' => $this->minat,
                    'this_activity' => $this->activity,
                    'lokasi' => $this->lokasi,
                    'jadwal' => $this->jadwal,
                    'keterangan' => $this->keterangan,
                    'id_pelamar' => $this->id_pelamar,
                ]
            );
    }
}
