<?php

namespace CFPP\Shipping\ShippingMethods\Traits;

class ValidationRules
{
    /** @var array $rules */
    private $rules;

    /**
     * ValidationRules constructor.
     */
    public function __construct()
    {
        $this->rules = ['height', 'width', 'length', 'weight', 'total_cost', 'sum_height_width_length'];
        foreach ($this->rules as $rule) {
            $this->{$rule} = [];
        }
    }

    public function getRules()
    {
        $this->normalizeValidationRules();
        return [
          'height' => $this->height,
          'width' => $this->width,
          'length' => $this->length,
          'weight' => $this->weight,
          'total_cost' => $this->total_cost,
          'sum_height_width_length' => $this->sum_height_width_length,
        ];
    }

    /**
     * Set a value to a rule without overwriting
     * if already set
     *
     * @param $handler
     * @param null $min
     * @param null $max
     */
    public function setDefault($handler, $min = null, $max = null)
    {
        if (property_exists($this, $handler)) {
            if ( ! empty($max) && empty($this->{$handler}['max'])) {
                $this->setMax($handler, $max);
            }
            if ( ! empty($min) && empty($this->{$handler}['min'])) {
                $this->setMin($handler, $min);
            }
        }
    }

    /**
     * @return bool
     */
    public function hasRules()
    {
        $has_rules = false;
        foreach ($this->rules as $rule) {
            if (!empty($this->{$rule})) {
                $has_rules = true;
                break;
            }
        }
        return $has_rules;
    }

    /**
     * Set a "Max" value to a rule
     *
     * @param $handler
     * @param $max
     */
    public function setMax($handler, $max)
    {
        if (property_exists($this, $handler) && is_numeric($max)) {
            $this->{$handler}['max'] = (float) $max;
        }
    }

    /**
     * Set a "Min" value to a rule
     *
     * @param $handler
     * @param $min
     */
    public function setMin($handler, $min)
    {
        if (property_exists($this, $handler) && is_numeric($min)) {
            $this->{$handler}['min'] = (float) $min;
        }
    }

    /**
     * If no rule is set, fill max and min values with
     * PHP_INT_MAX and 0, respectively.
     */
    protected function normalizeValidationRules()
    {
        foreach ($this->rules as $rule) {
            if (empty($this->{$rule}['max'])) {
                $this->setMax($rule, PHP_INT_MAX);
            }
            if (empty($this->{$rule}['min'])) {
                $this->setMin($rule, 0);
            }
        }
    }
}