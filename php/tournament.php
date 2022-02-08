<?php
    class Tournament {
        private $name;
        private $date;
        private $players = [];
        public function __construct() {
            $count = func_num_args();
            $params = func_get_args();

            switch($count) {
                case 0: {
                    return "Too low parameters!";
                }

                case 1: 
                {
                    $this->name = $params[0];
                    # date is equal to today's time + 24 hours => tomorrow        
                    $this->date = date("d.m.Y", time());
                    break;
                }
                case 2: 
                {
                    $this->name = $params[0]; 

                    $pattern = "#^(\d{4})\.(\d{2})\.(\d{2})$#";
                    $date = $params[1];
                    if(!preg_match($pattern, $date)) {
                        $this->date = date("d.m.Y", time());
                    }
                    else {
                        $replacement = "$3.$2.$1";
                        $this->date = preg_replace($pattern,$replacement,$date);
                    }
                    break;
                }
                default:
                {
                    return "Too many parameters!";
                }
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
                        #echo $players[$j]->getName() . ' - ' . $players[$k]->getName() . '<br>';
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
