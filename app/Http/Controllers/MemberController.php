<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    public function index()
    {
        // Hanya ambil user yang rolenya 'member' (Admin tidak ikut tampil)
        $members = User::where('role', 'siswa')->latest()->get();
        $memberToEdit = null;
        
        return view('members.index', compact('members', 'memberToEdit'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'siswa',
        ]);

        return redirect()->route('members.index')->with('success', 'Anggota baru berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $members = User::where('role', 'siswa')->latest()->get();
        $memberToEdit = User::findOrFail($id);
        
        return view('members.index', compact('members', 'memberToEdit'));
    }

    public function update(Request $request, string $id)
    {
        $member = User::findOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:255',
            // Validasi email: boleh pakai email yang sama asalkan milik dia sendiri
            'email'    => 'required|string|email|max:255|unique:users,email,' . $member->id,
            'password' => 'nullable|string|min:8', 
        ]);

        $member->name = $request->name;
        $member->email = $request->email;
        
        // Kalau kolom password diisi, berarti dia mau ganti password
        if ($request->filled('password')) {
            $member->password = Hash::make($request->password);
        }
        
        $member->save();

        return redirect()->route('members.index')->with('success', 'Data anggota berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $member = User::findOrFail($id);
        $member->delete();

        return redirect()->route('members.index')->with('success', 'Anggota berhasil dihapus!');
    }
}