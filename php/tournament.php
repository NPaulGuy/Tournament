<?php
    class Tournament {
        private $name;
        private $date;
        private $players = [];
        public function __construct($name, $date = NULL) {
            $this->name = $name;
            if($date !== NULL) {
                $this->date = $date;
            }
            else {
                $this->date = date("d.m.Y", time());
            }
        }

        public function addPlayer(Player $player) {
            $this->players[] = $player;
            return $this;
        } 

        public function createPairs() {
            $playersCount = count($this->players);
            $players = $this->players;
            if($playersCount % 2 != 0) {
                # empty player for showing that another player don't play the match
                $players[] = NULL;
                $playersCount++;
            }

            for($i = 1; $i < $playersCount; $i++) {

                echo "$this->name, " . 
                    date("d.m.Y", strtotime($this->date) + $i * 60 * 60 * 24) . "<br>";
                for($j = 0, $k = $playersCount - 1; $j < $k; $j++, $k--) {
                    if(!empty($players[$j]) && !empty($players[$k])) {
                        echo $players[$j]->getName() . ' ';
                        echo (!empty($players[$j]->getCity())) ? '(' . $players[$j]->getCity() . ')' : "";
                        echo ' - ';
                        echo $players[$k]->getName() . ' ';
                        echo (!empty($players[$k]->getCity())) ? '(' . $players[$k]->getCity() . ')' : "";
                        echo '<br>';
                    }
                }
                $this->rollPlayers($players);
            }
        }

        private function shiftInLeft(&$arr) {
            $item = array_shift($arr);
            array_push($arr,$item);
        }

        private function rollPlayers(&$arr) {
            $firstPlayer = array_shift($arr);
            $this->shiftInLeft($arr);
            array_unshift($arr,$firstPlayer);
        }
    }
?>
