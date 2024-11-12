<?php

namespace App\Http\Controllers;

use App\Http\Requests\Room\RoomStoreRequest;
use App\Http\Requests\Room\RoomUpdateRequest;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    public function index(){
        return view('room.index', [
            'rooms' => Room::all(),
        ]);
    }
    public function show(){

    }
    public function edit($id)
    {
        $room = Room::find($id);
    
        if (!$room) {

            return redirect()->route('rooms.index')->with('error', 'Error habitación no encontrada.');

        }
    
        return view('room.edit', compact('room'));
    }
    public function update(RoomUpdateRequest $request, $id)
    {
        $room = Room::findOrFail($id);
    
        $validatedData = $request->validated();
    
        if ($request->hasFile('photo')) {

            $photoPath = $request->file('photo')->store('photos', 'public');
            $validatedData['photo_path'] = $photoPath;
    
            if ($room->photo_path) {
                Storage::disk('public')->delete($room->photo_path);
            }
        }
    
        $room->update($validatedData);
    
        return redirect()->route('rooms.index')->with('status', 'La habitación ha sido actualizada exitosamente.');
    }
    
    public function create(){
        return view('room.create');
    }
    public function store(RoomStoreRequest $request)
    {
        $validatedData = $request->validated();

        $photoPath = null;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
        }
    
        Room::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'photo_path' => $photoPath, 
        ]);

        return redirect()->route('rooms.index')->with('status', 'La habitación ha sido creada exitosamente.');

       
        
    }
    public function destroy($id)
    {
        $room = Room::find($id);
    
        if (!$room) {
            return redirect()->route('rooms.index')->with('error', 'La habitación no existe.');
        }
    
        try {
            $room->delete();
    
            return redirect()->route('rooms.index')->with('status', 'La habitación ha sido eliminada exitosamente.');
    
        } catch (\Exception $e) {
            
            return redirect()->route('rooms.index')->with('error', 'Error al eliminar la habitación.');
        }
    }
    
}
