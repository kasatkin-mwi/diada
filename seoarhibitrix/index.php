<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SeoArhiBitrix</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">SeoArhiBitrix</h1>
            <form>
                <!-- <div class="row justify-content-center align-items-center">
                    <div class="col-md-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1"><h5>ID инфоблока</h5></label>
                          <input type="text" class="form-control" id="IdInfoblockAB" aria-describedby="emailHelp" placeholder="Введите ID инфоблока">
                        </div>
                    </div>
                </div> -->
                <div class="row">
                    
                    <div class="col-md-6">
                        <div class="form-group text-center">
                          <label for="exampleInputPassword1"><h5>Символьный код(ы)</h5></label>
                          <textarea rows="5" cols="10" name="text" class="form-control" id="codeAB"></textarea>
                        </div>
                        <div class="form-group text-center">
                          <label for="exampleInputPassword1"><h5>Детальное(ые) описание(я)</h5></label>
                          <textarea rows="5" cols="10" name="text" class="form-control" id="detailTextAB"></textarea>
                        </div>
                        <div class="form-group text-center">
                          <label for="exampleInputPassword1"><h5>Детальная картинка(и)</h5></label>
                          <textarea rows="5" cols="10" name="text" class="form-control" id="detailTextAB"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group text-center">
                          <label for="exampleInputPassword1"><h5>Title(s)</h5></label>
                          <textarea rows="5" cols="10" name="text" class="form-control" id="titleAB"></textarea>
                        </div>
                        <div class="form-group text-center">
                          <label for="exampleInputPassword1"><h5>Description(s)</h5></label>
                          <textarea rows="5" cols="10" name="text" class="form-control" id="descriptionAB"></textarea>
                        </div>
                        <div class="form-group text-center">
                          <label for="exampleInputPassword1"><h5>Keywords(s)</h5></label>
                          <textarea rows="5" cols="10" name="text" class="form-control" id="keywordsAB"></textarea>
                        </div>
                        <button type="submit" class="btn btn-danger" id="buttonAB">Обновить</button>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>
    <!-- Модальное окно  -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Запустить модальное окно
</button>
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            ...
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
  </body>
</html>