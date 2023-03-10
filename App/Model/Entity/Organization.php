<?php

    namespace App\Model\Entity;

    /**
     * Summary of Organization
     */
    class Organization{


        private $id;
        private $name;
        private $site;
        private $description;
        private $sellValue;
        private $productStock;
        private $productImage;

        

        // /**
        //  * ID do Varejo
        //  * @var integer
        //  */
        // public $id = 1;

        // /**
        //  * Nome do Varejo
        //  * @var string
        //  */
        // public $name = 'Varejo Teste';

        // /**
        //  * Site do Varejo
        //  * @var string
        //  */
        // public $site = 'https://github.com/mvmsantos/php-native-api-challenge';

        // /**
        //  * Descrição ou sobre do Varejo
        //  * @var string
        //  */
        // public $description = 'Esta é somente uma descrição do Varejo criado, é estatico ainda não provem do banco de dados';

        // /**
        //  * Valor do Varejo
        //  * @var integer
        //  */
        // public $sellValue = 80000;

        // /**
        //  * Estoque do varejo
        //  * @var integer
        //  */
        // public $productStock = 60;

        // /**
        //  * Imagem dos produtos do varejo
        //  * @var string
        //  */
        // public $productImage = 'Teste Imagem';

    
    
	/**
	 * @return mixed
	 */
	public function getProductImage() {
		return $this->productImage;
	}
	
	/**
	 * @param mixed $productImage 
	 * @return self
	 */
	public function setProductImage($productImage): self {
		$this->productImage = $productImage;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getProductStock() {
		return $this->productStock;
	}
	
	/**
	 * @param mixed $productStock 
	 * @return self
	 */
	public function setProductStock($productStock): self {
		$this->productStock = $productStock;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getSellValue() {
		return $this->sellValue;
	}

	/**
	 * @param mixed $sellValue 
	 * @return self
	 */
	public function setSellValue($sellValue): self {
		$this->sellValue = $sellValue;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @param mixed $description 
	 * @return self
	 */
	public function setDescription($description): self {
		$this->description = $description;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getSite() {
		return $this->site;
	}

	/**
	 * @param mixed $site 
	 * @return self
	 */
	public function setSite($site): self {
		$this->site = $site;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param mixed $name 
	 * @return self
	 */
	public function setName($name): self {
		$this->name = $name;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param mixed $id 
	 * @return self
	 */
	public function setId($id): self {
		$this->id = $id;
		return $this;
	}

    /**
     * SUMARIO DA CONEXÃO COM O BANCO
     * @return \PDO
     */
    public function connection() :\PDO
    {
        return new \PDO("mysql:host=localhost;dbname=db_crud", "root", "");
    }

    /**
     * METODO CREATE
     * @return array
     */
    public function create() :array
    {
        $con = $this->connection();
        $stmt = $con->prepare("INSERT INTO product1 VALUES (NULL, :_description, :_sellValue, :_productStock, :_productImage, :_name, :_site)");
        $stmt->bindValue(":_description", $this->getDescription(), \PDO::PARAM_STR);
        $stmt->bindValue(":_sellValue", $this->getSellValue(), \PDO::PARAM_INT);
        $stmt->bindValue(":_productStock", $this->getProductStock(), \PDO::PARAM_INT);
        $stmt->bindValue(":_productImage", $this->getProductImage(), \PDO::PARAM_STR);
        $stmt->bindValue(":_name", $this->getName(), \PDO::PARAM_STR);
        $stmt->bindValue(":_site", $this->getSite(), \PDO::PARAM_STR);
        if ($stmt->execute()){
            $this->setId($con->lastInsertId());
            return $this->read();
        }
        return [];
    }

    /**
     * METODO READ FINDALL E FINDONE
     * @return array
     */
    public function read() :array
    {
        $con = $this->connection();
        if ($this->getId()=== 0){
            $stmt = $con->prepare("SELECT * FROM product1");

            if ($stmt->execute()){
                return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            }
        } elseif ($this->getId() > 0){
            $stmt = $con->prepare("SELECT * FROM product1 WHERE id = :_id");
            $stmt->bindValue(":_id", $this->getId(), \PDO::PARAM_INT);
            if ($stmt->execute()){
                return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            }
        }

        return [];
    }

    /**
     * METODO DE UPDATE
     * @return array
     */
    public function update() :array
    {
        $con = $this->connection();

        $stmt = $con->prepare("UPDATE product1 SET sellValue    = :_sellValue,
                                                   description  = :_description,
                                                   productStock = :_productStock,
                                                   productImage = :_productImage,
                                                   name         = :_name,
                                                   site         = :_site WHERE id = :_id");

        $stmt->bindValue(":_description", $this->getDescription(), \PDO::PARAM_STR);
        $stmt->bindValue(":_sellValue", $this->getSellValue(), \PDO::PARAM_INT);
        $stmt->bindValue(":_productStock", $this->getProductStock(), \PDO::PARAM_INT);
        $stmt->bindValue(":_productImage", $this->getProductImage(), \PDO::PARAM_STR);
        $stmt->bindValue(":_name", $this->getName(), \PDO::PARAM_STR);
        $stmt->bindValue(":_site", $this->getSite(), \PDO::PARAM_STR);
        $stmt->bindValue(":_id", $this->getId(), \PDO::PARAM_INT);
        if ($stmt->execute()){
            return $this->read();
        }
        return [];
    }

    /**
     * METODO DE DELETE
     * @return array
     */
    public function delete() :array
    {
        $product = $this->read();
        $con = $this->connection();

        $stmt = $con->prepare("DELETE FROM product1 WHERE id = :_id");
        $stmt->bindValue(":_id", $this->getId(), \PDO::PARAM_INT);
        if ($stmt->execute()){
            return $product;
        }
        return [];
    }
}

?>