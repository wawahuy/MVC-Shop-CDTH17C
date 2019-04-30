//ĐỒ ÁN FRONT END CŨ

/*
    - tạo alert tên cùng header
    - @typ: các định dạng cho alert
    - @text: văn bản
*/
// AlertLG = function ( typ, text ){
//     document.getElementById("lg-alert").innerHTML = "<span>"+text+"</span>";
//     document.getElementById("lg-alert").className = "lg-alert "+typ;
//     document.getElementById("lg-alert").style.display = "block";
// }




// /*
//     - file này thực hiện quá trình mô phỏng login, registry như thật

// */
// Login = {};

// //khởi động các thao tác sử lí cho Login
// Login.init = function (){
//     //Form login
//     Login.form = document.forms.fLogin;
//     //xử lí $_GET

//     switch( $_GET['do'] ){
//         //xử lí đăng xuất
//         case 'logout':
//             AlertLG("ok", "Đăng xuất thành công!");
//             CUser.Logout();
//         break;

//         //xử lí với đăng nhập thành công
//         case 'logok':
//             AlertLG("ok", "Chúc mừng bạn vừa đăng nhập thành công, đang chuyển hướng...");
//             setTimeout( function (){
//                 location.href = "index.html"
//             }, 1500);
//         break;

//         //xử lí với đăng kí thành công
//         case 'regok':
//             Login.writeBackInput();
//             AlertLG("ok", "Chúc mừng bạn vừa đăng kí tài khoản thành công, giờ hãy đăng nhập vào nào!");
//         break;

//         //xử lí với login = app
//         case 'app':
//             AlertLG("error", "Chúng tôi đang xây dựng tính năng đăng nhập với "+$_GET['name'].toUpperCase()+"!");
//         break;

//         //xử lí với login
//         case 'action':
//             if(CSDL.check('login')){
//                 //lấy các thuộc tính trong form nhờ việc lưu trước đó
//                 $_POST = decToTextArr(splitKeyValue(CSDL.get('login')));
//                 //kiểm tra sự tồn tại của email và pass
//                 if( (pos=CUser.checkEmail($_POST['email'])) != -1){
//                     if( CUser.checkPass(pos, $_POST['pass']) ){
//                         //gán trạng tháy đăng nhập
//                         CUser.Logged(pos);
//                         //chuyển về trang chủ
//                         location.href = "?do=logok";
//                         return;
//                     }
//                 }
//                 AlertLG("error", "Tài khoản hoặc mật khẩu bạn nhập không chính xác!")
//                 //viết lại thông tin trước đó
//                 Login.writeBackInput();
//             }
//         break;
//     }
//     //xóa post trước
//     CSDL.set('login','');
// }

// //viết lại các ô input
// Login.writeBackInput = function (){
//     //phân tích các URI thành json rồi chuyền vào các input tương úng
//     c = splitKeyValue(CSDL.get('login'));
//     for(k in c)
//          Login.form[k].value = decToText(c[k]);
// }

// //Chuyển form sang URI
// Login.cvURIForm = function (){
//     return "email="+textToDec(Login.form.email.value)+"&pass="+textToDec(Login.form.pass.value)+"&save="+textToDec(Login.form.save.value);
// }

// //khi người dùng nhấn submit
// Login.change = function (e){
//     //lưu giữ lại các thông tin vào csdl
//     CSDL.set("login", Login.cvURIForm());
// }





// /*
//     - xử lí page đăng kí
// */
Reg = {};

//khởi động các thao tác xử lí cho Register
Reg.init = function (){
    //lấy các document input
    Reg.form = document.forms.fReg;
    Reg.nameInput = ['fullname', 'pass', 'repass', 'email', 'sdt', 'address', 'cmnd', 'private'];
    //thêm sự kiện onsubmit cho form
    Reg.form.addEventListener("submit", Reg.change, false);
    //xử lí URI
    // switch( $_GET['do'] ){
    //     //xử lí đăng kí
    //     case 'action':
    //         $_POST = decToTextArr(splitKeyValue(CSDL.get('register')));

    //         //kiểm tra sự tồn tại của email
    //         if( (pos=CUser.checkEmail($_POST['email'])) != -1){
    //             AlertLG("error", "Email nà đã được sử dụng bởi một tài khoản khác!")
    //         }
    //         //thêm tài khoản và storage
    //         else {
    //             CUser.insertAccount($_POST);
    //             CSDL.set('login', 'email='+textToDec($_POST['email']));
    //             location.href = 'login.html?do=regok';
    //         }

    //         Reg.writeBackInput();
    //     break;

    // }
    // //xóa bỏ lịch sử post
    // CSDL.set('register', '');
}

// //Chuyển form sang URI
// Reg.cvURIForm = function (){
//     var curi = "";
//     for( var i in Reg.nameInput )
//         curi += Reg.nameInput[i]+"="+textToDec(Reg.form[Reg.nameInput[i]].value)+"&";
//     return curi.substr(0, curi.length-1);
// }

// //viết lại các ô input
// Reg.writeBackInput = function (){
//     //phân tích các URI thành json rồi chuyền vào các input tương úng
//     var c = splitKeyValue(CSDL.get('register'));
//     for(k in c)
//          Reg.form[k].value = decToText(c[k]);
// }

//khi người dùng nhấn submit
Reg.change = function (e){
    e.preventDefault();

    //kiểm tra form
    if( Reg.form.pass.value != Reg.form.repass.value ){
        swal("Lỗi", "Bạn vừa nhập lại mật khẩu không chính xác!" , "error");
        Reg.form.pass.value = "";
        Reg.form.repass.value = "";
    }
    else if( !Number(Reg.form.sdt.value) ){
        swal("Lỗi", "Vui lòng nhập đúng số điện thoại!", "error");
    }
    else if( !Number(Reg.form.sdt.value) ){
        swal("Lỗi", "Vui lòng nhập đúng số điện thoại!", "error");
    }
    else if( !Number(Reg.form.cmnd.value) ){
        swal("Lỗi", "Vui lòng nhập đúng số CMND!", "error");
    }
    else {
        Reg.form.submit();
    }
}