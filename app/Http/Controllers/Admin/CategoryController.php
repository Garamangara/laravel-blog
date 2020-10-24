<?php

namespace App\Http\Controllers\Admin;

use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $objCategory = new Category();
        $categories = $objCategory->get();

        return view('admin.categories.index', ['categories' => $categories]);
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
                'description' => 'required|string|min:3|max:250'
            ]);
            $objCategory = new Category();
            $objCategory = $objCategory->create([
               'title' => $request->input('title'),
                'description' => $request->input('description')
            ]);
            if($objCategory) {
                return redirect()->route('categories')->with('success', 'Категория успешно добавлена!');
            }
            return back()->with('error', 'Не удалось добавить категорию!');

        } catch (ValidationException $e) {
            \Log::error($e->getMessage());
            return back()->with('error', 'Не удалось добавить категорию: '.$e->getMessage());
        }
    }

    public function editCategory(int $id)
    {
        $category = Category::find($id);
        if(!$category) {
            return abort(404);
        }
        return view('admin.categories.edit', ['category' => $category]);
    }

    public function editRequestCategory(Request $request, int $id)
    {
        try{
            $this->validate($request, [
                'title' => 'required|string|min:3|max:30',
                'description' => 'required|string|min:3|max:250'
            ]);
            $objCategory = Category::find($id);

            if(!$objCategory) {
                return abort(404);
            }
            $objCategory->title = $request->input('title');
            $objCategory->description = $request->input('description');

            if($objCategory->save()) {
                return redirect()->route('categories')->with('success', 'Категория успешно изменена!');
            }
            return back()->with('error', 'Не удалось изменить категорию!');

        } catch (ValidationException $e) {
            \Log::error($e->getMessage());
            return back()->with('error', 'Не удалось изменить категорию: '.$e->getMessage());
        }
    }

    public function deleteCategory(Request $request)
    {
        if($request->ajax()) {
            $id = (int)$request->input('id');
            $objCategory = new Category();

            $objCategory->where('id', $id)->delete();

            echo 'success';
        }
    }
}
