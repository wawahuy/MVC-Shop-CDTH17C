<?php
    Func::Import("Admin/Model/Product.Model.php");
    Func::Import("Admin/Model/Categories.Model.php");

    class ProductController extends BaseController{
        public function Index(){
            $product = new Product();
            $info = $product -> getProduct();
            $code_data = "";
            foreach($info as $order_data){
                $code_data.= View::general_code(dirname(__FILE__).'/../View/Products/product_data.php',[
                    'name'=>$order_data['product_name'],
                    'image'=>json_decode($order_data['product_image'])[0],
                    'id'=>$order_data['product_id'],
                    'remai'=>$order_data['product_num_remai'],
                    'price'=>$order_data['product_price'],
                    'sold'=>$order_data['product_num_sold']
                ]);

            }

            View::bind_data('product_list',$code_data);
            parent::renderPage(
            "SShop - Trang chủ",
            dirname(__FILE__).'/../View/Home/Layout.php',
            dirname(__FILE__).'/../View/Products/product.php'
             
            );
        }


        public function add_product(){
            View::bind_data("chuyenmuc", (new CategoriesModel)->GetCategoriesNoChild());
            parent::renderPage(
                    "SShop - Trang chủ",
                    dirname(__FILE__).'/../View/Home/Layout.php',
                    dirname(__FILE__).'/../View/Products/Add/product_add.php'
                );
        }


        public function add_product_submit(){
            
            $name = $_POST["ten"] ?? "";
            $soluong = $_POST["soluong"] ?? -1;
            $gia = $_POST["gia"] ?? -1;
            $sao = $_POST["sao"] ?? 1;
            $giamgia = $_POST["giamgia"] ?? 0;
            $thongitn = $_POST["thongtin"] ?? "";
            $chuyemmuc = $_POST["chuyenmuc"] ?? -1;

            if(strlen($name) < 3){
                Javascript::InvokeSwal("Nhập tên >=3 kí tự!", "", "error");
                $this->add_product();
                return;
            }

            if($soluong < 1){
                Javascript::InvokeSwal("Nhập một số lượng đúng!", "", "error");
                $this->add_product();
                return;
            }


            if($gia < 0){
                Javascript::InvokeSwal("Nhập một giá đúng!", "", "error");
                $this->add_product();
                return;
            }

            if($chuyemmuc == -1){
                Javascript::InvokeSwal("Chọn một chuyên mục đúng đúng!", "", "error");
                $this->add_product();
                return;
            }

            $image = Func::UploadImage($_FILES['hinh']);
            if($image == ""){
                Javascript::InvokeSwal("Upload ảnh không hợp lệ!", "", "error");
                $this->add_product();
                return;
            }


            (new Product())->insert($name, $soluong, $thongitn, $gia, $giamgia, $sao, $chuyemmuc, $image, Session::GetIDAdminLogged());
            Javascript::InvokeSwal("Thêm sản phẩm thành công!", "", "success");
            $this->add_product();
        }


        public function edit_product($params){
            $data = (new Product)->getProductByID($params['id']);
            View::bind_data("chuyenmuc", (new CategoriesModel)->GetCategoriesNoChild());
            View::bind_data("id", $data['product_id']);
            View::bind_data("name", $data['product_name']);
            View::bind_data("deltail", $data['product_deltail']);
            View::bind_data("star", $data['product_star']);
            View::bind_data("price", $data['product_price']);
            View::bind_data("num_remai", $data['product_num_remai']);
            View::bind_data("sale", $data['product_sale']);
            View::bind_data("categorie_id", $data['categorie_id']);
            View::bind_data("image", json_decode($data['product_image'])[0]);

            parent::renderPage(
                    "SShop - Trang chủ",
                    dirname(__FILE__).'/../View/Home/Layout.php',
                    dirname(__FILE__).'/../View/Products/Edit/product_edit.php'
                );
        }

        public function edit_product_submit($params){
            $name = $_POST["ten"] ?? "";
            $soluong = $_POST["soluong"] ?? -1;
            $gia = $_POST["gia"] ?? -1;
            $sao = $_POST["sao"] ?? 1;
            $giamgia = $_POST["giamgia"] ?? 0;
            $thongitn = $_POST["thongtin"] ?? "";
            $chuyemmuc = $_POST["chuyenmuc"] ?? -1;

            if(strlen($name) < 3){
                Javascript::InvokeSwal("Nhập tên >=3 kí tự!", "", "error");
                $this->add_product();
                return;
            }

            if($soluong < 1){
                Javascript::InvokeSwal("Nhập một số lượng đúng!", "", "error");
                $this->add_product();
                return;
            }


            if($gia < 0){
                Javascript::InvokeSwal("Nhập một giá đúng!", "", "error");
                $this->add_product();
                return;
            }

            if($chuyemmuc == -1){
                Javascript::InvokeSwal("Chọn một chuyên mục đúng đúng!", "", "error");
                $this->add_product();
                return;
            }

            if($_FILES['hinh']['name'] == "")
                $image = $_POST['hinhcu'];
            else {
                @unlink(dirname(__FILE__)."/../..".$_POST['hinhcu']);
                $image = Func::UploadImage($_FILES['hinh']);
                if($image == ""){
                    Javascript::InvokeSwal("Upload ảnh không hợp lệ!", "", "error");
                    $this->add_product();
                    return;
                }
            }


            (new Product())->update($name, $soluong, $thongitn, $gia, $giamgia, $sao, $chuyemmuc, $image, $params['id']);
            Javascript::InvokeSwal("Cập nhật sản phẩm thành công!", "", "success");
            $this->edit_product($params);
        }

        public function delete_product($par){
            if((new Product())->delete($par['id'])){
                Javascript::InvokeSwal("Xóa thành công!", "", "success");
            }
            $this->Index();
        }

    }
?>