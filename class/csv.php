<?php
class csv
{
    // 変数
    private $keys = ['商品ID','商品名','金額','在庫'];
    private $csvArray = array();
    private $selectArray = array();
    private $file;
    private $type; 
    private $handle;
    private $data_count = 0;
    private $num = 0;
    private $serch = 0;

    private $id;
    private $name;
    private $price;
    private $stock;
    

    // コンストラクタ
    public function __construct($filename,$type) {
    // 変数の代入
    $this->file = $filename;
    $this->type = $type;
    $this->handle = fopen($this->file, $this->type);
    }


    public function getalldata(){

        while (($data = fgetcsv($this->handle)) !== FALSE) {
            $this->num = count($data);

            for ($c=0; $c < $this->num; $c++) {
                $this->csvArray[$this->data_count][$this->keys[$c]] = $data[$c];
            }
            $this->data_count++;
        }
        fclose($this->handle);
        return $this->csvArray;
    }

    public function selectdata($result,int $num){
        // echo $this->data_count;
        for( $i=0; $i < $this->data_count; $i++){
            if($result[$i]['商品ID'] === $result[$num-1]['商品ID']){
                $this->serch = $i;
                for($j=0; $j < $this->num; $j++){
                    $this->selectArray[$j] = $result[$i][$this->keys[$j]];
                }
            }
        }
        return $this->selectArray;
    }

    public function add($id,$name,$price,$stock){
        /* EUC-JPからUTF-7に変換 */
        // echo $name;
        // $name = mb_convert_encoding($name, "UTF-8");
        // echo $name;
        $text = "{$id},"."{$name},"."{$price},"."{$stock}\n";

        fputs($this->handle,$text);

        fclose($this->handle);
    }
    public function setid($id){
        $this->id = $id;
    }
    public function setname($name){
        $this->name = $name;
    }
    public function setprice($price){
        $this->price = $price;
    }
    public function setstock($stock){
        $this->stock = $stock;
    }

    public function edit($edit_id){
        
        $file = file($this->file);

        $after_text = $this->id . ',' . $this->name .','. $this->price .','. $this->stock."\n";

        $file = str_replace($file[$edit_id],htmlspecialchars($after_text),$file);

        file_put_contents($this->file,$file);
    
    }

    public function delete($del_id){

        $file = file($this->file);
        unset($file[$del_id]);

        file_put_contents($this->file,$file);
    }

}
?>