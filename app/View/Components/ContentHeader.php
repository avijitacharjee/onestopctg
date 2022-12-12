<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ContentHeader extends Component
{
    public $name;
    public $directory;
    public $subDirectory;
    public $subDirectoryUrl;
    public function __construct($name,$subDirectory,$subDirectoryUrl)
    {
        $this->name = $name;
        $this->directory = "Home";
        $this->subDirectory = $subDirectory;
        $this->subDirectoryUrl = $subDirectoryUrl;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.content-header');
    }
}
