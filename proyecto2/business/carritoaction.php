<?php 
    session_start();
    //unset($_SESSION['carrito']);
    if(isset($_POST['agregar'])){
        if(isset($_POST['productoid'] ) && isset($_POST['productonombre']) && isset($_POST['productoprecio']) && isset($_POST['productocantidad'])){
            $id = $_POST['productoid'];
            $nombre = $_POST['productonombre'];
            $precio = $_POST['productoprecio'];
            $cantidad = $_POST['productocantidad'];

            if(!isset($_SESSION['carrito'])){
                $producto = array(
                    'productoid'=>$id,
                    'productonombre'=>$nombre,
                    'productoprecio'=>$precio,
                    'productocantidad'=>$cantidad
                );
                $_SESSION['carrito'][0] = $producto;
                header("location: ../view/index.php?pagina=1&mensaje=exito" );
            }else{
                $columnaids=array_column($_SESSION['carrito'],"productoid");

                if(in_array($id,$columnaids)){
                    header("location: ../view/index.php?pagina=1&mensaje=repetido" );
                }else{
                    $cantidadProductos = count($_SESSION['carrito']);
                    $producto = array(
                        'productoid'=>$id,
                        'productonombre'=>$nombre,
                        'productoprecio'=>$precio,
                        'productocantidad'=>$cantidad
                    );
                    $_SESSION['carrito'][$cantidadProductos] = $producto;
                    header("location: ../view/index.php?pagina=1&mensaje=exito" );
                }
                
            }
           

        }
    }
    else if(isset($_POST['eliminar'])){
        if(is_numeric($_POST['productoid'])){
            $id = $_POST['productoid'];
            foreach($_SESSION['carrito'] as $indice=>$producto){
                if($producto['productoid'] == $id){
                    unset($_SESSION['carrito'][$indice]);
                }
            }
        }
        header("location: ../view/carritoview.php?mensaje=Borrado con éxito :)");
    }
   

?>
