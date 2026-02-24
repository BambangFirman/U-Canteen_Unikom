<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Ramsey\Uuid\Uuid;

class CategoryController extends Controller
{
    public function index(): Response
    {
        $categories = Category::all();

        return response()
            ->view('admin.categories.index', [
                'title' => 'Kategori | U-Canteen',
                'categories' => $categories
            ]);
    }

    public function create(): Response
    {
        return response()
            ->view('admin.categories.create', [
                'title' => 'Tambah Kategori | U-Canteen'
            ]);
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $validate = $request->validate([
                'categoryName' => 'required|unique:categories,categoryName',
                'desc' => 'nullable|max:100'
            ], [
                'categoryName.required' => 'Nama kategori wajib diisi',
                'categoryName.unique' => 'Nama kategori sudah ada',
                'desc.max' => 'Deskripsi maksimal 100 karakter'
            ]);

            Category::query()->create([
                'id' => Uuid::uuid4()->toString(),
                'categoryName' => trim($validate['categoryName']),
                'desc' => trim($validate['desc'] ?? ''),
                'created_at' => date('Y-m-d H:i:s')
            ]);

            return redirect('/admin/categories')
                ->with('success', 'Kategori berhasil ditambahkan');

        } catch (ValidationException $exception) {
            return redirect('/admin/categories/create')
                ->withErrors($exception->errors())
                ->withInput();
        } catch (\Exception $exception) {
            return redirect('/admin/categories/create')
                ->with('error', 'Gagal menambahkan kategori: ' . $exception->getMessage())
                ->withInput();
        }
    }

    public function edit(string $id): Response
    {
        $category = Category::query()->findOrFail($id);

        return response()
            ->view('admin.categories.edit', [
                'title' => 'Edit Kategori | U-Canteen',
                'category' => $category
            ]);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        try {
            $validate = $request->validate([
                'categoryName' => 'required|unique:categories,categoryName,' . $id,
                'desc' => 'nullable|max:100'
            ], [
                'categoryName.required' => 'Nama kategori wajib diisi',
                'categoryName.unique' => 'Nama kategori sudah ada',
                'desc.max' => 'Deskripsi maksimal 100 karakter'
            ]);

            $category = Category::query()->findOrFail($id);
            $category->categoryName = trim($validate['categoryName']);
            $category->desc = trim($validate['desc'] ?? '');
            $category->save();

            return redirect('/admin/categories')
                ->with('success', 'Kategori berhasil diperbarui');

        } catch (ValidationException $exception) {
            return redirect("/admin/categories/{$id}/edit")
                ->withErrors($exception->errors())
                ->withInput();
        }
    }

    public function destroy(string $id): RedirectResponse
    {
        try {
            $category = Category::query()->findOrFail($id);

            $menus = $category->menus;
            foreach ($menus as $menu) {
                \App\Models\Checkout::where('menu_id', $menu->id)->delete();
                \Illuminate\Support\Facades\DB::table('menus_carts')->where('menu_id', $menu->id)->delete();
                if ($menu->img) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete('/img/shops/menus/' . $menu->img);
                }
                $menu->delete();
            }

            $category->delete();

            return redirect('/admin/categories')
                ->with('success', 'Kategori berhasil dihapus');
        } catch (\Exception $e) {
            return redirect('/admin/categories')
                ->with('error', 'Gagal menghapus kategori: ' . $e->getMessage());
        }
    }
}
