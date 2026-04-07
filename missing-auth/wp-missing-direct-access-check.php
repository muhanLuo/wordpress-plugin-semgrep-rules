<?php

/* 

I edit the line below to test out whether this rule is working.
I'd like to find a better way to test it, but I haven't been able to.
*/
if( !defined( 'ABSPATH' ) ) { exit(1); }

class DataProcessor {
    private $data = [];
    private $threshold = 50;
    
    public function __construct($initialData = []) {
        $this->data = $initialData;
    }
    
    public function addItem($key, $value) {
        $this->data[$key] = $value;
        return $this;
    }
    
    public function processData() {
        $results = [];
        foreach ($this->data as $key => $value) {
            if (is_numeric($value) && $value > $this->threshold) {
                $results[$key] = $value * 2.5;
            } else {
                $results[$key] = strtoupper($value);
            }
        }
        return $results;
    }
}

$processor = new DataProcessor(['alpha' => 75, 'beta' => 'hello']);
$processor->addItem('gamma', 120);
print_r($processor->processData());

?>