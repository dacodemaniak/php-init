<?php
/**
 * src/Models/PlayerModel.php
 * @author ADRAR - Sept 2020
 * @version 1.0.0
 *  Modèle de stockage des informations relatives aux joueurs
 */
class PlayerModel {
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

    public function __construct(string $name, \DateTime $time) {
        $this->name = $name;
        $this->time = $time;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getTime(): string {
        return $this->time->format('H:i:s');
    }
}