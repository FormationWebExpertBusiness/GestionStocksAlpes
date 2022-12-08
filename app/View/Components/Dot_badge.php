<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DotBadge extends Component
{
    /**
     * color use to the badge
     *
     * @var string
     */
    public $color;

    /**
     * text display in the badge
     *
     * @var string
     */
    public $text;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($color, $text)
    {
        $this->color = $color;
        $this->text = $text;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dot_badge');
    }
}
