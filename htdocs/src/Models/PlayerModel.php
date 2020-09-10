<?php
/**
 * src/Models/PlayerModel.php
 * @author ADRAR - Sept 2020
 * @version 1.0.0
 *  Modèle de stockage des informations relatives aux joueurs
 */
class PlayerModel {
    /**
     * @var int $id
     *  Identifiant du joueur
     */
    private $id;

    /**
     * @var string $name
     *  Nom du joueur
     */
    private $name;

    /**
     * @var \DateTime $time
     *  Temps mis pour finaliser la partie
     */
    private $time;

    public function __construct(?array $datas = null) {
        if (!is_null($datas)) {
            $this->_hydrate($datas);
        }
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id) {
        $this->id = $id;
    }
    
    public function setName(string $name) {
        $this->name = $name;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setTime(\DateTime $time) {
        $this->time = $time;
    }

    private function _setTimeFromFormat(string $time) {
        $this->time = \DateTime::createFromFormat('H:i:s', $time);
    }

    public function getTime(): string {
        return $this->time->format('H:i:s');
    }

    public function getCols(): array {
        $cols = [];

        foreach ($this as $property => $value) {
            $cols[] = $property;
        }

        return $cols;
    }

    private function _hydrate(array $datas): PlayerModel {
        foreach ($datas as $property => $value) {
            if (property_exists($this, $property)) {
                /**
                 * @todo Read property attributes and call the correct adapter to transform to
                 */
                if ($property !== 'time') {
                    $this->{$property} = $value;
                } else {
                    $this->_setTimeFromFormat($value);
                }
            }
        }
        return $this;
    }
}