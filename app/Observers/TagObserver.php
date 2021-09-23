<?php

namespace App\Observers;

use App\Models\Tag;

class TagObserver
{
    /**
     *  Listen to the Tag on creating event.
     *
     * @param  mixed $tag
     * @return void
     */
    public function saving(Tag $tag)
    {
        if ($tag->slug == '')
        {
            $tag->slug = generate_slug($tag->name);
        }
        return $tag;
    }
}
