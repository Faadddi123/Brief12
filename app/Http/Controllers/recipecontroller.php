<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

use App\Models\Recipe;
use App\Models\Categories;
use App\Models\Tags;
use App\Models\RecipeTags;

class recipecontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recipes = Recipe::all();

        $recipes_tags = RecipeTags::all();  

        return view('recipes.index', compact('recipes'));
    }


    /**
     * Handle the recipe search.
     */
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        
        // Perform the search logic using $searchTerm
        $recipes = Recipe::where('title', 'like', '%' . $searchTerm . '%')
            ->orWhere('content', 'like', '%' . $searchTerm . '%')
            ->get();

        return view('recipes.index', compact('recipes'));
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::all(); // Replace 'Category' with your actual category model
        $tags = Tags::all(); // Replace 'Tag' with your actual tag model

        return view('recipes.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'rating' => 'required',
            'category_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags' => 'required|array'
        ]);
        
        
        $imageName = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::slug($request->title) . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images', $imageName);
        }


        $recipes = new Recipe();
        
        $recipes->title = $request->title;
        $recipes->content = $request->content;
        $recipes->rating = $request->rating;
        $recipes->image = $imageName;
        $recipes->category_id = $request->category_id;

        $recipes->save();

        foreach ($request->tags as $tagId) {
            $recipeTags = new RecipeTags();
            $recipeTags->recipe_id = $recipes->id;
            $recipeTags->tag_id = $tagId;
            $recipeTags->save();
        }


        // Correct way to associate the category
        // Save the image path relative to the public directory
        // Assuming you have $imageName defined somewhere
        // $recipes->image = 'images/' . $imageName;
        
        
        
        
        return redirect()->route('recipes.index')->with('success', 'Recipe created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $recipe = Recipe::findOrFail($id);
        return view('recipes.show', compact('recipe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
{
    $recipe = Recipe::findOrFail($id);
    $categories = Categories::all(); // Replace 'Category' with your actual category model
    $tags = Tags::all(); // Replace 'Tag' with your actual tag model

    return view('recipes.edit', compact('recipe', 'categories', 'tags'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'tags' => 'array', // Tags are optional now
        ]);

        $recipe = Recipe::findOrFail($id);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::slug($request->title) . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images', $imageName);
            $recipe->image = $imageName;
        }

        // Update other fields
        $recipe->title = $request->title;
        $recipe->content = $request->content;


        if ($request->filled('category_id')) {
            $recipe->category_id = $request->category_id;
        }
    
        // Update tags relationship if provided
        if ($request->filled('tags')) {
            $recipe->tags()->sync($request->tags);
        }

        

        $recipe->save();

        return redirect()->route('recipes.index')->with('success', 'Recipe updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */

        public function destroy($id)
        {
            $recipe = Recipe::findOrFail($id);
            $recipe->recipe_tags()->detach();
            $recipe->delete();

            return redirect()->route('recipes.index')->with('success', 'Recipe deleted successfully!');
        }
}
