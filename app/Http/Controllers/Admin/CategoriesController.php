<?php

namespace App\Http\Controllers\Admin;

use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Category;

class CategoriesController extends Controller
{
    public function index()
    {
        return view('admin.categories.index');
    }

    public function addCategory()
    {
        return view('admin.categories.add');
    }

    public function addRequestCategory(Request $request)
    {
        try{
            $this->validate($request, [
                'title' => 'required|string|min:3|max:30',
                'description' => 'string|min:3|max:250'
            ]);
            $objCategory = new Category();
            $objCategory = $objCategory->create([
               'title' => $request->input('title'),
                'description' => $request->input('description')
            ]);
            if($objCategory) {
                return back()->with('success', 'Категория успешно добавлена!');
            }
            return back()->with('error', 'Не удалось добавить категорию!');

        } catch (ValidationException $e) {
            \Log::error($e->getMessage());
            return back()->with('error', 'Не удалось добавить категорию: '.$e->getMessage());
        }

    }

    public function editCategory(int $id)
    {

    }

    public function deleteCategory(Request $request)
    {
        if($request->ajax()) {

        }
    }
}
