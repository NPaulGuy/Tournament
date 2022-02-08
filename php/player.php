<?php

    class Player {
        private $name;
        private $city;

        public function __construct($name) {
            $this->name = $name;
        }

        public function setCity($city) {
            $this->city = $city;
            return $this;
        }

        public function getCity() {
            return $this->city;
        }

        public function setName($name) {
            $this->name = $name;
            return $this;
        }

        public function getName() {
            return $this->name;
        }
    }
?>
