<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $images = [
            ['name' => 'Sala de Reuniones con Librería', 'description' => 'Sala acogedora con una mesa redonda, sillas cómodas y una amplia librería al fondo.', 'filename' => 'sala1.jpeg'],
            ['name' => 'Oficina Ejecutiva con Vista a la Ciudad', 'description' => 'Oficina moderna con una vista impresionante de la ciudad.', 'filename' => 'sala2.jpeg'],
            ['name' => 'Sala de Consultoría Elegante', 'description' => 'Sala decorada con estilo moderno, equipada con un escritorio elegante y sillas cómodas.', 'filename' => 'sala3.jpeg'],
            ['name' => 'Sala de Conferencias Corporativa', 'description' => 'Amplia sala de conferencias equipada con una mesa rectangular grande y sillas ergonómicas.', 'filename' => 'sala4.jpeg'],
            ['name' => 'Sala de Formación Modular', 'description' => 'Sala versátil con mesas modulares y sillas dispuestas en forma de "U".', 'filename' => 'sala5.jpeg'],
            ['name' => 'Sala de Juntas Minimalista', 'description' => 'Sala de juntas con un diseño minimalista, equipada con una mesa alargada y sillas ejecutivas.', 'filename' => 'sala6.jpeg'],
        ];
    
        foreach ($images as $image) {
            $filePath = Storage::disk('public')->putFileAs('photos', new \Illuminate\Http\File(resource_path("assets/{$image['filename']}")), $image['filename']);
    
            Room::create([
                'name' => $image['name'],
                'description' => $image['description'],
                'photo_path' => $filePath,
            ]);
        }
    }
}
