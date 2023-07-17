<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KelolaPenggunaController extends Controller
{
    public function index()
    {
        $this->authorize("kelola_pengguna");
        return view("kelola_pengguna", ["title" => "Kelola Pengguna", "users" => User::all()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|unique:users|max:20',
            'role' => 'required',
            'password' => 'required|min:5|max:20',
        ]);
        $validated['password'] = Hash::make($validated['password']);
        try {
            User::create($validated);
            return redirect('/kelola-pengguna')->with("success", "Berhasil Menambahkan Pengguna Baru!");
        } catch (\Throwable $th) {
            return redirect('/kelola-pengguna')->with("error", "Gagal Menambahkan Pengguna Baru!");
        }
    }

    public function update(Request $request, User $user)
    {
        $rules = [
            'role' => 'required',
            'password' => 'nullable|min:5|max:20',
        ];
        if ($request->username != $user->username) $rules["username"] = 'required|unique:users|max:20';
        $validated = $request->validate($rules);
        $validated['password'] = Hash::make($validated['password']);
        if (!$request->password) $validated['password'] = $user->password;
        try {
            User::where('id', $user->id)->update($validated);
            return redirect('/kelola-pengguna')->with("success", "Berhasil Mengubah Pengguna !");
        } catch (\Throwable $th) {
            return redirect('/kelola-pengguna')->with("error", "Gagal Mengubah Pengguna !");
        }
    }

    public function destroy(User $user)
    {
        try {
            User::destroy($user->id);
            return redirect('/kelola-pengguna')->with("success", "Berhasil Menghapus Pengguna !");
        } catch (\Throwable $th) {
            return redirect('/kelola-pengguna')->with("error", "Gagal Menghapus Pengguna !");
        }
    }
}
