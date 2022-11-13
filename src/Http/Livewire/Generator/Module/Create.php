<?php

namespace LaraIO\Generator\Http\Livewire\Generator\Module;

use LaraIO\Core\Livewire\Modal;

class Create extends Modal
{
    public function mount()
    {
        $this->setTitle('Create New Module');
        $this->modal_size = Modal::Small;
    }
    public function render()
    {
        return $this->viewModal('generator::generator.module.create');
    }
}
