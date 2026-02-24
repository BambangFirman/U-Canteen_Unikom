<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuRequest;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Shop;
use App\Service\MenuService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Ramsey\Uuid\Uuid;

class MenuController extends Controller
{

    private MenuService $menuService;

    /**
     * @param MenuService $menuService
     */
    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function menu(string $shopName): Response
    {
        $shop = Shop::query()->where('name', '=',ucwords(Str::slug($shopName,' ')))->first();
        $menus = Menu::query()
            ->join('categories', 'menus.category_id', '=', 'categories.id')
            ->join('shops', 'menus.shop_id', '=', 'shops.id')
            ->orderBy('categories.categoryName')
            ->select(
                'menus.id',
                'menus.menuName',
                'menus.category_id',
                'categories.categoryName',
                'categories.desc as category_desc',
                'menus.price',
                'menus.desc as menu_desc',
                'menus.img',
                'shops.name'
            )->where('name', '=', ucwords(Str::slug($shopName,' ')))
            ->get();

        return response()
            ->view('features.menu', [
                "title" => "Menu | $shop->name",
                "shop" => $shop,
                'menus' => $menus
            ]);
    }

    public function menuAdd(string $shopId): Response
    {
        $shop = Shop::query()->findOrFail($shopId);
        $categories = Category::all();

        return response()
            ->view('admin.menus.create', [
                'title' => "Tambah Menu — {$shop->name} | U-Canteen",
                'categories' => $categories,
                'shop' => $shop
            ]);
    }

    public function menuAddPost(MenuRequest $request, string $shopId): RedirectResponse
    {
        try {
            $shop = Shop::query()->findOrFail($shopId);
            $validate = $request->validated();

            //auto add ID
            $validate['id'] = Uuid::uuid4()->toString();

            // set shop_id otomatis dari URL
            $validate['shop'] = $shop->id;

            //get real name file
            $file = $request->file('img');
            $validate['img'] = time() .'_'. $file->getClientOriginalName();

            $file->storeAs('/img/shops/menus', $validate['img'] , 'public');

            $result = $this->menuService->save($validate);
            if ($result) {
                return redirect("/admin/shops/{$shopId}/menus")
                    ->with('success', 'Data menu berhasil di tambahkan');
            }
            return redirect("/admin/shops/{$shopId}/menus/create")
                ->with('error', 'Data duplikat, telah ditambahkan sebelumnya');

        } catch (ValidationException $exception) {
            return redirect("/admin/shops/{$shopId}/menus/create");
        }
    }

    public function menuEdit(string $shopId, string $id): Response
    {
        $shop = Shop::query()->findOrFail($shopId);
        $menu = Menu::query()->findOrFail($id);
        $categories = Category::all();

        return response()
            ->view('admin.menus.edit', [
                'title' => "Edit Menu — {$shop->name} | U-Canteen",
                'menu' => $menu,
                'categories' => $categories,
                'shop' => $shop
            ]);
    }

    public function menuUpdate(Request $request, string $shopId, string $id): RedirectResponse
    {
        try {
            $shop = Shop::query()->findOrFail($shopId);

            $validate = $request->validate([
                'name' => 'required',
                'category' => 'required',
                'price' => 'required',
                'desc' => ['required', 'max:100'],
                'img' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:1024']
            ]);

            $menu = Menu::query()->findOrFail($id);
            $menu->menuName = $validate['name'];
            $menu->category_id = $validate['category'];
            $menu->shop_id = $shop->id;
            $menu->price = $validate['price'];
            $menu->desc = $validate['desc'];

            if ($request->hasFile('img')) {
                if ($menu->img) {
                    Storage::disk('public')->delete('/img/shops/menus/' . $menu->img);
                }
                $file = $request->file('img');
                $imgName = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('/img/shops/menus', $imgName, 'public');
                $menu->img = $imgName;
            }

            $menu->save();

            return redirect("/admin/shops/{$shopId}/menus")
                ->with('success', 'Data menu berhasil diperbarui');

        } catch (ValidationException $exception) {
            return redirect("/admin/shops/{$shopId}/menus/{$id}/edit")
                ->withErrors($exception->errors())
                ->withInput();
        }
    }

    public function menuDelete(string $shopId, string $id): RedirectResponse
    {
        try {
            $menu = Menu::query()->findOrFail($id);

            \App\Models\Checkout::where('menu_id', $menu->id)->delete();
            \Illuminate\Support\Facades\DB::table('menus_carts')->where('menu_id', $menu->id)->delete();

            if ($menu->img) {
                Storage::disk('public')->delete('/img/shops/menus/' . $menu->img);
            }

            $menu->delete();

            return redirect("/admin/shops/{$shopId}/menus")
                ->with('success', 'Data menu berhasil dihapus');
        } catch (\Exception $e) {
            return redirect("/admin/shops/{$shopId}/menus")
                ->with('error', 'Gagal menghapus menu: ' . $e->getMessage());
        }
    }
}
