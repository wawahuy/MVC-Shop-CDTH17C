<?php
    Func::Import("Model/UserModel.class");
    Func::Import("Model/ContactModel.class");

    class ProfileContactController extends BaseController {

        public function Index(){
            if(!Session::IsLogged()) Route::Redirect("/");

            $contacts = (new ContactModel)->GetContactList(Session::GetIDLogged());

            View::bind_data("contacts", $contacts);
            parent::renderPage(
                "Danh sách liên hệ",
                $GLOBALS['VIEW_DIR']."/Profile/Layout.php",
                $GLOBALS['VIEW_DIR']."/Profile/Contact/Contact.php"
            );
        }

        public function Action(){
            if(!Session::IsLogged()) Route::Redirect("/");

            $idcontact = $_POST["idcontact"] ?? -1;
            $action = $_POST["action"] ?? "";
            $phone = $_POST["phone"] ?? "";
            $address = $_POST["address"] ?? "";
            $modelContact = new ContactModel();

            if(strlen($phone) < 9 || strlen($phone) > 13){
                Javascript::InvokeSwal("Lỗi", "Sai SĐT!", "error");
            }
            else if(strlen($address) < 10 || strlen($address) > 200){
                Javascript::InvokeSwal("Lỗi", "Địa chí quá dài hoặc quá ngắn!", "error");
            }
            else switch($action){
                case "add":
                    $modelContact->Insert(Session::GetIDLogged(), $phone, $address);
                    Javascript::InvokeSwal("Thêm thành công", "", "success");
                    break;
                
                case "update":
                    $modelContact->Update(Session::GetIDLogged(), $idcontact, $phone, $address);
                    Javascript::InvokeSwal("Sửa thành công", "", "success");
                    break;

                case "delete":
                    $modelContact->Delete(Session::GetIDLogged(), $idcontact);
                    Javascript::InvokeSwal("Xóa thành công", "", "success");
                    break;
            }
  
            $this->Index();
        }

    }
