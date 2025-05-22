<?php
namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class CategoryController extends Controller
{
    public function index()
    {
        $categories = Categorie::latest()->paginate(10);
        return view('categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Categorie::create([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Category added successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Categorie::findOrFail($id);
        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Category updated successfully.');
    }
    public function show($id)
{
    $category = Categorie::findOrFail($id);
    return view('categories.show', compact('category'));
}


    public function destroy($id)
    {
        Categorie::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Category deleted successfully.');
    }
}
