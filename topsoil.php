<?php
class Topsoil
{
    var $measurement_unit;
    var $depth_measurement_unit;
    var $dimension_width;
    var $dimension_length;
    var $dimension_depth;

    public function set_measurement_unit($munit) {
        $this->measurement_unit = $munit;
    }

    public function set_depth_measurement_unit($dunit) {
        $this->depth_measurement_unit = $dunit;
    }

    public function set_dimension($width,$length,$depth) {
        $this->dimension_width = $width;
        $this->dimension_length = $length;
        $this->dimension_depth = $depth;
    }

    public function calculate_bags() {
        if ($this->measurement_unit == 'feet') {
            $this->dimension_width = $this->dimension_width * 0.3048;
            $this->dimension_length = $this->dimension_length * 0.3048;
        } elseif ($this->measurement_unit == 'yard') {
            $this->dimension_width = $this->dimension_width * 0.9144;
            $this->dimension_length = $this->dimension_length * 0.9144;
        }

        if ($this->depth_measurement_unit == 'centimetres') {
            $this->dimension_depth = ($this->dimension_depth * 10) / 1000;
        } elseif ($this->depth_measurement_unit == 'inches') {
            $this->dimension_depth = ($this->dimension_depth * 25) / 1000;
        }

        $total_bags = round((($this->dimension_width * $this->dimension_length) * $this->dimension_depth) * 1.4);
        return $total_bags;
    }

    public function cost_calculator($totalbags) {
        $bag_cost = 72;
        $final_cost = $totalbags * $bag_cost;
        return $final_cost;
    }
}
