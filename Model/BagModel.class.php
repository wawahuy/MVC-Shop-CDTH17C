<?php
    Func::Import("Model/ProductModel.class");

    define("CART_COOKIE_NAME", "cart");
    define("CART_CONTACT_COOKIE_NAME", "cart_contact");

     class BagModel {

          public function getDataBag(){
               $data = Cookie::Get(CART_COOKIE_NAME) ?? "";
               $data = Cookie::decodeCookie($data );
               $data = $data == "" ? [] : json_decode($data);
               return $data ?? [];
          }


          public function setDataBag($data){
               Cookie::Set(CART_COOKIE_NAME, Cookie::encodeCookie(json_encode($data)));
          }


          public function getNumProduct(){
               return count($this->getDataBag());
          }



          public function getPriceProduct(){
               $data = $this->getDataBag() ?? [];
               $price = 0;
               foreach ($data as $dt) {
                    $model = (new ProductModel)->getProductByID($dt->id);
                    $price += $dt->num * ($model->price * (100-($model->sale ?? 0))/100.0);
               }
               return $price;
          }



          public function makeHTMLCart(){
               $data = $this->getDataBag() ?? [];
               $code = "";
               foreach ($data as $dt) {
                    $model = (new ProductModel)->getProductByID($dt->id);
                    $price = $model->price * (100-($model->sale ?? 0))/100.0;
                    $code .= View::general_code(dirname(__FILE__)."/../View/Bag/ProdCart.php", [
                         "image"        => $model->image[0],
                         "price"        => $price,
                         "title"        => $model->name,
                         "allprice"     => $price*$dt->num,
                         "num"          => $dt->num,
                         "id"           => $model->id
                    ]);
               }
               return $code;
          }



          public function add($id_product, $num, $option){
               $data = $this->getDataBag() ?? [];
               $len = count($data);
               $hasCart = false;

               #KT ID SP
               $prod = (new ProductModel)->getProductByID($id_product);
               if($prod == null)
                    return false;

               #Thêm SP
               for($i=0; $i<$len; $i++){
                    if($data[$i]->id == $id_product){
                         $data[$i]->num += $num;
                         $num =  $data[$i]->num;
                         $hasCart = true;
                    }
               }

               if(!$hasCart)
                    array_push($data, 
                    [
                         "id"      => $id_product,
                         "num"     => $num,
                         "option"  => $option
                    ]);

               #KT SL Sản phẩm
               if($num > $prod->numProductCurrent)
                    return false;


               $this->setDataBag($data);
               return true;
          }



          public function remove($id){
               $data = $this->getDataBag() ?? [];
               $newdata = [];
               $hasremove = false;
               foreach ($data as $dt) {
                    if($dt->id != $id){
                         array_push($newdata, $dt);
                    }
                    else 
                         $hasremove = true;
               }
               $this->setDataBag($newdata);
               return $hasremove;
          }



          public function update($id, $num){
               $data = $this->getDataBag() ?? [];
               $len = count($data);
               for($i=0; $i<$len; $i++){
                    if($data[$i]->id == $id){
                         if($num <= (new ProductModel)->getProductByID($id)->numProductCurrent && $num > 0)
                              $data[$i]->num = $num;
                    }
               }
               $this->setDataBag($data);
               return false;
          }


     }
?>