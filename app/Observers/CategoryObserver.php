<?php

namespace App\Observers;

use App\Models\Category;

class CategoryObserver
{

    /**
     *  Listen to the Category on creating event.
     *
     * @param  mixed $category
     * @return void
     */
    public function saving(Category $category)
    {
        if ($category->slug == '')
        {
            $category->slug = generate_slug($category->name);
        }
        return $category;
    }
}
