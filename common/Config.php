<?php
class Config {
	private $id = null;
	private $tableName = 'config';
	private $loaded = false;
	private $voti_recupero_settembre_aperto;
	private $voti_recupero_novembre_aperto;
	private $ore_previsioni_aperto;
	private $ore_fatte_aperto;
	private $bonus_adesione_aperto;
	private $bonus_rendiconto_aperto;
	
	public function load() {
		require_once '../common/connect.php';
		$query = "SELECT * FROM `$this->tableName`";
		debug($query);
		$item = dbGetFirst($query);
		$this->id = $item['id'];
		$this->voti_recupero_settembre_aperto = $item['voti_recupero_settembre_aperto'];
		$this->voti_recupero_novembre_aperto = $item['voti_recupero_novembre_aperto'];
		$this->ore_previsioni_aperto = $item['ore_previsioni_aperto'];
		$this->ore_fatte_aperto = $item['ore_fatte_aperto'];
		$this->bonus_adesione_aperto = $item['bonus_adesione_aperto'];
		$this->bonus_rendiconto_aperto = $item['bonus_rendiconto_aperto'];
		$this->loaded = true;
	}

	public function save() {
		require_once '../common/connect.php';
		$query = '';
		if ($this->id != null) {
			$query = "  UPDATE `$this->tableName`
                        SET
                            `voti_recupero_settembre_aperto`=$this->voti_recupero_settembre_aperto,
                            `voti_recupero_novembre_aperto`=$this->voti_recupero_novembre_aperto,
                            `ore_fatte_aperto`=$this->ore_fatte_aperto,
                            `ore_previsioni_aperto`=$this->ore_previsioni_aperto,
                            `bonus_adesione_aperto`=$this->bonus_adesione_aperto,
                            `bonus_rendiconto_aperto`=$this->bonus_rendiconto_aperto
                        WHERE
                            id = $this->id
                        ;
                    ";
		} else {
			$query = "  INSERT INTO `$this->tableName`(
                            `voti_recupero_settembre_aperto`,
                            `voti_recupero_novembre_aperto`,
                            `ore_previsioni_aperto`,
                            `ore_fatte_aperto`,
                            `bonus_adesione_aperto`,
                            `bonus_rendiconto_aperto`)
                        VALUES (
                            $this->voti_recupero_settembre_aperto,
                            $this->voti_recupero_novembre_aperto,
                            $this->ore_previsioni_aperto,
                            $this->ore_fatte_aperto,
                            $this->bonus_adesione_aperto,
                            $this->bonus_rendiconto_aperto
                        );
                    ";

		}
		debug($query);
		dbExec($query);
	}

	public function getVoti_recupero_settembre_aperto() {
		if (!$this->loaded) {
			$this->load();
		}
		return $this->voti_recupero_settembre_aperto;
	}

	public function getVoti_recupero_novembre_aperto() {
		if (!$this->loaded) {
			$this->load();
		}
		return $this->voti_recupero_novembre_aperto;
	}

	public function getOre_previsioni_aperto() {
		if (!$this->loaded) {
			$this->load();
		}
		return $this->ore_previsioni_aperto;
	}

	public function getOre_fatte_aperto() {
		if (!$this->loaded) {
			$this->load();
		}
		return $this->ore_fatte_aperto;
	}
	
	public function getBonus_adesione_aperto() {
	    if (!$this->loaded) {
	        $this->load();
	    }
	    return $this->bonus_adesione_aperto;
	}
	
	public function getBonus_rendiconto_aperto() {
	    if (!$this->loaded) {
	        $this->load();
	    }
	    return $this->bonus_rendiconto_aperto;
	}
	
	public function setVoti_recupero_settembre_aperto($voti_recupero_settembre_aperto) {
		$this->voti_recupero_settembre_aperto = $voti_recupero_settembre_aperto;
	}

	public function setVoti_recupero_novembre_aperto($voti_recupero_novembre_aperto) {
		$this->voti_recupero_novembre_aperto = $voti_recupero_novembre_aperto;
	}

	public function setOre_previsioni_aperto($ore_previsioni_aperto) {
		$this->ore_previsioni_aperto = $ore_previsioni_aperto;
	}

	public function setOre_fatte_aperto($ore_fatte_aperto) {
		$this->ore_fatte_aperto = $ore_fatte_aperto;
	}

    public function setBonus_adesione_aperto($bonus_adesione_aperto) {
        $this->bonus_adesione_aperto = $bonus_adesione_aperto;
    }

    public function setBonus_rendiconto_aperto($bonus_rendiconto_aperto) {
        $this->bonus_rendiconto_aperto = $bonus_rendiconto_aperto;
    }

}
?>
