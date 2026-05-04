<?php
require_once BASE_PATH . '/app/core/Model.php';

class MateriModel extends Model
{
    public function getMateriByKelas($kelasId)
    {
        // Sample data – replace with DB query
        // status: aktif | draft
        return [
            [
                'id'         => 1,
                'pertemuan'  => 'Pertemuan 1',
                'tanggal'    => '28 Maret 2026',
                'tipe'       => 'Tautan Youtube',
                'tipe_icon'  => 'youtube',
                'judul'      => 'Materi UI/UX',
                'status'     => 'aktif',
                'lampiran'   => [
                    [
                        'tipe'  => 'youtube',
                        'judul' => 'Tutorial cara menggunakan figma',
                        'url'   => 'https://www.youtube.com/watch?v=yS2AEWC1JeM&list=RDyS2AEWC1JeM&start_radio=1',
                    ]
                ],
            ],
            [
                'id'         => 2,
                'pertemuan'  => 'Pertemuan 2',
                'tanggal'    => '28 Februari 2026',
                'tipe'       => 'Unggahan file',
                'tipe_icon'  => 'file',
                'judul'      => 'Materi Pemrograman digital',
                'status'     => 'aktif',
                'lampiran'   => [
                    [
                        'tipe'  => 'file',
                        'judul' => 'MATERI PERTEMUAN 1.docx',
                        'url'   => '#',
                    ]
                ],
            ],
            [
                'id'         => 3,
                'pertemuan'  => 'Pertemuan 3',
                'tanggal'    => '07 Maret 2026',
                'tipe'       => 'Tautan Youtube',
                'tipe_icon'  => 'youtube',
                'judul'      => 'Materi HTML Dasar',
                'status'     => 'draft',
                'lampiran'   => [
                    [
                        'tipe'  => 'youtube',
                        'judul' => 'Belajar HTML untuk Pemula',
                        'url'   => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                    ]
                ],
            ],
        ];
    }
}
