<?php
// Bài toán phâm tích thông số kỹ thuật
$pricePass = 900;

class Laptop{
    public function __construct(public $price ,public  $insura ,public  $active)
    {}

    public function getPrice()
    {
        return $this->price;
    }

    public function getInsura()
    {
        return $this->insura;
    }

    public function getActive()
    {
        return $this->active;
    }
}
// $laptop = new Laptop(1000,10,true);
// if(
//     $laptop->getPrice() > $pricePass && 
//     $laptop->getInsura() > 9 &&
//     $laptop->getActive()
// ) echo ' True';

interface ILaptop{
    public function bValue(Laptop $laptop) : bool;
}

class LaptopPriceCheck implements ILaptop{
    public function bValue($laptop) : bool
    {
        return $laptop->price > 900;
    }
}

class LaptopInsuraCheck implements ILaptop{
    public function bValue($laptop) : bool
    {
        return $laptop->insura > 9;
    }
}

class LaptopActiveCheck implements ILaptop{
    public function bValue($laptop) : bool
    {
        return $laptop->active;
    }
}

class Hp{
    private $modules;
    public function add(ILaptop $iLaptop){
        $this->modules[] = $iLaptop;
        return $this;
    }

    public function resole(Laptop $laptop)
    {
        $countTrue = 0;
        foreach($this->modules as $module){
            if($module->bValue($laptop))  $countTrue++;
        }
        if($countTrue !== count($this->modules)) return 'false';
        return 'true';
    }
}

$result = (new Hp())
            ->add(new LaptopPriceCheck())
            ->add(new LaptopActiveCheck())
            ->add(new LaptopInsuraCheck())
            ->resole(new Laptop(1000,15,true));
echo $result;