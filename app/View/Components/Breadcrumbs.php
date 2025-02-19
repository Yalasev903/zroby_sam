<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Breadcrumbs extends Component
{
    /**
     * Массив хлебных крошек.
     *
     * Каждый элемент массива должен иметь ключи 'title' и 'url'.
     *
     * @var array
     */
    public array $breadcrumbs;

    /**
     * Создание нового экземпляра компонента.
     *
     * @param array $breadcrumbs
     */
    public function __construct(array $breadcrumbs)
    {
        $this->breadcrumbs = $breadcrumbs;
    }

    /**
     * Получить представление для компонента.
     */
    public function render()
    {
        return view('components.breadcrumbs');
    }
}
