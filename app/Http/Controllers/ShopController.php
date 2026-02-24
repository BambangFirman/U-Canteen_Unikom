<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShopRequest;
use App\Models\Shop;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Ramsey\Uuid\Uuid;

class ShopController extends Controller
{
    public function shopAdd():Response
    {
        return response()
            ->view('admin.shops.create', [
                'title' => "Tambah Toko | U-Canteen"
            ]);
    }

    public function shopAddPost(ShopRequest $request): RedirectResponse
    {
        try {
            $validate = $request->validated();

            $file = $request->file('img');
            $validate['img'] = time() .'_'. $file->getClientOriginalName();
            $file->storeAs('/img/shops/featured', time() .'_'. $file->getClientOriginalName() , 'public');
            Shop::query()->create([
                'id' => Uuid::uuid4()->toString(),
                'name' => $validate['name'],
                'img' => $validate['img']
            ]);

            return redirect('/admin/shops')
                ->with('success', 'Data berhasil di tambahkan');

        } catch (ValidationException $exception) {
            return redirect('/admin/shops/create')
                ->withErrors($exception->errors())
                ->withInput();
        } catch (\Exception $exception) {
            return redirect('/admin/shops/create')
                ->with('error', 'Gagal menambahkan toko: ' . $exception->getMessage())
                ->withInput();
        }
    }

    public function shopEdit(string $id): Response
    {
        $shop = Shop::query()->findOrFail($id);

        return response()
            ->view('admin.shops.edit', [
                'title' => 'Edit Toko | U-Canteen',
                'shop' => $shop
            ]);
    }

    public function shopUpdate(Request $request, string $id): RedirectResponse
    {
        try {
            $validate = $request->validate([
                'name' => 'required',
                'img' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp']
            ]);

            $shop = Shop::query()->findOrFail($id);
            $shop->name = trim($validate['name']);

            if ($request->hasFile('img')) {
                // Delete old image
                if ($shop->img) {
                    Storage::disk('public')->delete('/img/shops/featured/' . $shop->img);
                }
                $file = $request->file('img');
                $imgName = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('/img/shops/featured', $imgName, 'public');
                $shop->img = $imgName;
            }

            $shop->save();

            return redirect('/admin/shops')
                ->with('success', 'Data toko berhasil diperbarui');

        } catch (ValidationException $exception) {
            return redirect("/admin/shops/{$id}/edit")
                ->withErrors($exception->errors())
                ->withInput();
        }
    }

    public function shopDelete(string $id): RedirectResponse
    {
        try {
            $shop = Shop::query()->findOrFail($id);

            // Hapus semua data terkait menu milik toko ini
            $menus = $shop->menus;
            foreach ($menus as $menu) {
                \App\Models\Checkout::where('menu_id', $menu->id)->delete();
                \Illuminate\Support\Facades\DB::table('menus_carts')->where('menu_id', $menu->id)->delete();
                if ($menu->img) {
                    Storage::disk('public')->delete('/img/shops/menus/' . $menu->img);
                }
                $menu->delete();
            }

            if ($shop->img) {
                Storage::disk('public')->delete('/img/shops/featured/' . $shop->img);
            }

            $shop->delete();

            return redirect('/admin/shops')
                ->with('success', 'Data toko berhasil dihapus');
        } catch (\Exception $e) {
            return redirect('/admin/shops')
                ->with('error', 'Gagal menghapus toko: ' . $e->getMessage());
        }
    }
}
