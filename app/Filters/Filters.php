<?php


namespace App\Filters;


use Illuminate\Http\Request;

abstract class Filters {

    protected $request, $builder, $filters = [];

    public function __construct (Request $request) {
        $this->request = $request;
    }

    public function apply ($builder) {
        //  we apply out filters to the builder
        $this->builder = $builder;

        //  each filter type should be a separate method in child class
        //  filter should be as a key in request
        foreach ($this->getFilters() as $filter => $value) {
            if (method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }

        return $builder;
    }

    protected function getFilters () {
        return $this->request->intersect($this->filters);
    }
}