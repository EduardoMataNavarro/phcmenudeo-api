<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Correo de registro</title>
</head>
    <body style="box-sizing:border-box;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,'Noto Sans',sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol','Noto Color Emoji';font-size:1rem;font-weight:400;line-height:1.5;color:#212529;text-align:left;background-color:#fff;" >
        <div class="container-fluid" id="main-container" style="box-sizing:border-box;width:100%;padding-right:15px;padding-left:15px;margin-right:auto;margin-left:auto;border-width:1px;border-style:solid;border-color:rgba(0, 0, 0, 0.15);border-radius:35px;margin-top:35px;" >
            <h3 class="text-center" style="box-sizing:border-box;margin-top:0;margin-bottom:.5rem;font-weight:500;line-height:1.2;font-size:1.75rem;text-align:center!important;" >Bienvenido a PHC Menudeo</h3>
            <div class="container" style="box-sizing:border-box;width:100%;padding-right:15px;padding-left:15px;margin-right:auto;margin-left:auto;" >
                <div class="row" id="holder" style="box-sizing:border-box;display:flex;-ms-flex-wrap:wrap;flex-wrap:wrap;margin-right:-15px;margin-left:-15px;background-color:#18A4E0;color:#ffffff;border-radius:15px;margin-bottom:30px;box-shadow:0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);" >
                    <div class="col-10 container" style="box-sizing:border-box;margin-right:auto;margin-left:auto;position:relative;width:100%;padding-right:15px;padding-left:15px;-ms-flex:0 0 83.333333%;flex:0 0 83.333333%;max-width:83.333333%;" >
                        <p class="text-center m-5" style="box-sizing:border-box;margin-top:3rem !important;margin-bottom:3rem !important;margin-right:3rem !important;margin-left:3rem !important;text-align:center!important;" >
                            Esta es su contraseña, con ella puede ingresar a nuestro sitio para comenzar a comprar!
                            <br/>
                            Gracias por su preferencia!
                        </p>
                        <div id="pass-holder" style="position:relative;box-sizing:border-box;display:block;margin-left:auto;margin-right:auto;margin-bottom:150px;width:55%;height:55px;border-radius:15px;background-color:rgb(255, 255, 255);color:rgba(0, 0, 0, 1);box-shadow:0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);" >
                            <h4 id="pass" class="text-center align-middle p-2" style="box-sizing:border-box;margin-top:0;margin-bottom:.5rem;font-weight:500;line-height:1.2;font-size:1.5rem;vertical-align:middle!important;padding-top:.5rem !important;padding-bottom:.5rem !important;padding-right:.5rem !important;padding-left:.5rem !important;text-align:center!important;" >
                                {{ $userpassword }} 
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>