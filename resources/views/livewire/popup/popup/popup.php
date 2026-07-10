<?php

use Livewire\Attributes\Modelable;
use Livewire\Component;

new class () extends Component {
    #[Modelable]
    public bool $show_flag = false;
};
