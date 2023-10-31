<?php include("config.php"); ?>	

<?php


    #   Conectarse a la base de datos.

	function conectarBD() {
		
		try {		#	
		
			$conexion = new PDO("mysql:host=".HOST."; dbname=".DBNAME."; charset=utf8", USER, PASSWORD);	

			$conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
		} catch (PDOException $e) {		
			
			echo "Error: Error al conectarse con la base de datos: ". $e -> getMessage();

			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e -> getMessage(), FILE_APPEND);

			exit;
	
		}
		
		return $conexion;
		
	} 


	#   Desconectarse de la base de datos.

	function desconectarBD($conexion) {
		
		$conexion = NULL;
	
	}


    #   Añadir un nuevo usuario a la base de datos.

	function registro ($email, $password, $nombre, $apellidos, $direccion, $telefono) {

		$conexion = conectarBD();

		$password = password_hash ($password, PASSWORD_BCRYPT);

		try { 

			$sql = "INSERT INTO usuarios (email, password, nombre, apellidos, direccion, telefono, admin, online) VALUES (:email, :password, :nombre, :apellidos, :direccion, :telefono, 0, 1)";	

			$stmt = $conexion -> prepare($sql);

			$stmt -> bindParam(':email', $email);
			$stmt -> bindParam(':password',  $password);
            $stmt -> bindParam(':nombre', $nombre);
            $stmt -> bindParam(':apellidos', $apellidos);
            $stmt -> bindParam(':direccion', $direccion);	
            $stmt -> bindParam(':telefono', $telefono);

			$stmt -> execute();
		
		} catch (PDOException $e) {		

			echo "Error: Error al conectarse con la base de datos: ". $e -> getMessage();

			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e -> getMessage(), FILE_APPEND);

			exit;
				
		}

		$numfilas = $stmt -> rowCount();

		desconectarBD ($conexion);

		return $numfilas; 

	}


    #   Comprobar durante el registro que no existe un usuario con el email introducido.

	function seleccionar_email ($email) {

		$conexion = conectarBD();

		try { 

			$sql = "SELECT * FROM usuarios WHERE email = :email";

			$stmt = $conexion -> prepare($sql);

			$stmt -> bindParam(':email', $email);

			$stmt -> execute();
		
		} catch (PDOException $e) {		

			echo "Error: Error al conectarse con la base de datos: ". $e -> getMessage();

			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e -> getMessage(), FILE_APPEND);

			exit;
				
		}

		$numfilas = $stmt -> rowCount();

		desconectarBD($conexion);

		return $numfilas; 

	}


    #   Iniciar sesión.

	function login ($email, $password) {		

		$conexion = conectarBD();

		try {			

			$sql = "SELECT * FROM usuarios WHERE email = :email AND online = 1";  

			$stmt = $conexion -> prepare($sql);

			$stmt -> bindParam(':email', $email);

			$stmt -> execute();

			$row = $stmt -> fetch (PDO::FETCH_ASSOC);

		} catch (PDOException $e) {		

			echo "Error: Error al conectarse con la base de datos: ". $e -> getMessage();

			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e -> getMessage(), FILE_APPEND);

			exit;
				
		}

		return password_verify ($password, $row['password']);		

	}


    #   Consulta para mostrar todos los productos y hacer la paginación.

    function paginacion_productos ($inicio, $numelementos) {

        $conexion = conectarBD();

        try {

            $sql = "SELECT * from productos WHERE estado = 1 order by idProducto DESC LIMIT :inicio, :numelementos";

            $stmt = $conexion -> prepare($sql);

            $stmt -> bindParam(':inicio', $inicio, PDO::PARAM_INT);
            $stmt -> bindParam(':numelementos',  $numelementos, PDO::PARAM_INT);	

            $stmt -> execute();

            $rows = $stmt -> fetchAll(PDO::FETCH_ASSOC);		

        } catch (PDOException $e) {		

            echo "Error: Error al conectarse con la base de datos: ". $e -> getMessage();

            file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e -> getMessage(), FILE_APPEND);

            exit;
                
        }
        
        desconectarBD($conexion);

        return $rows;		

    }


    #   Necesario para paginación. Calcula el número de páginas a mostrar según el número de elementos de la base de datos.

    function num_paginas_productos ($numelementos) {

        $conexion = conectarBD();

        try {	

            $sql = "SELECT count(*) FROM productos WHERE estado = 1";

            $numproductos = $conexion -> query($sql) -> fetchColumn();

        } catch (PDOException $e) {		

            echo "Error: Error al conectarse con la base de datos: ". $e -> getMessage();

            file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e -> getMessage(), FILE_APPEND);

            exit;
                
        }

        $numpaginas = ceil ($numproductos / $numelementos);

        desconectarBD($conexion);

        return $numpaginas;		

    } 


    #   Consulta para mostrar todos los pedidos de un usuario y hacer la paginación.

    function paginacion_pedidos ($inicio, $numelementos, $idUsuario) {

        $conexion = conectarBD();

        try {

            $sql = "SELECT a.*, b.estado from pedidos a, estados b WHERE idUsuario = :idUsuario  AND a.idEstado = b.idEstado ORDER BY a.fecha DESC LIMIT :inicio, :numelementos";

            $stmt = $conexion -> prepare($sql);

            $stmt -> bindParam(':inicio', $inicio, PDO::PARAM_INT);
            $stmt -> bindParam(':numelementos',  $numelementos, PDO::PARAM_INT);
            $stmt -> bindParam(':idUsuario', $idUsuario);	

            $stmt -> execute();

            $rows = $stmt -> fetchAll(PDO::FETCH_ASSOC);		

        } catch (PDOException $e) {		

            echo "Error: Error al conectarse con la base de datos: ". $e -> getMessage();

            file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e -> getMessage(), FILE_APPEND);

            exit;
                
        }
        
        desconectarBD($conexion);

        return $rows;		

    }


     #   Necesario para paginación. Calcula el número de páginas a mostrar según el número de elementos de la base de datos.
   
    function num_paginas_pedidos ($numelementos) {

        $conexion = conectarBD();

        try {	

            $sql = "SELECT count(*) FROM pedidos WHERE idUsuario = :idUsuario";

            $stmt = $conexion -> prepare($sql);

            $stmt -> bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);

            $stmt -> execute();

            $numpedidos = $stmt -> fetchColumn();

        } catch (PDOException $e) {		

            echo "Error: Error al conectarse con la base de datos: ". $e -> getMessage();

            file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e -> getMessage(), FILE_APPEND);

            exit;
                
        }

        $numpaginas = ceil ($numpedidos / $numelementos);

        desconectarBD($conexion);

        return $numpaginas;		

    }
    

    #   Seleccionar todos los productos sin paginación.

    function seleccionar_todos_productos() {

        $conexion = conectarBD();

        try {		

            $sql = "SELECT * FROM productos";  

            $stmt = $conexion -> query($sql);

            $rows = $stmt -> fetchAll(PDO::FETCH_ASSOC);		

        } catch (PDOException $e) {		

            echo "Error: Error al conectarse con la base de datos: ". $e -> getMessage();

            file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e -> getMessage(), FILE_APPEND);

            exit;
                
        }
        
        desconectarBD($conexion);

        return $rows;		

    }


    #   Consulta para mostrar sólo los últimos cuatro productos añadidos (novedades).

    function seleccionar_novedades() {

        $conexion = conectarBD();

        try {		

            $sql = "SELECT * FROM productos order by idProducto DESC LIMIT 4";  

            $stmt = $conexion -> query($sql);

            $rows = $stmt -> fetchAll(PDO::FETCH_ASSOC);		

        } catch (PDOException $e) {		

            echo "Error: Error al conectarse con la base de datos: ". $e -> getMessage();

            file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e -> getMessage(), FILE_APPEND);

            exit;
                
        }
        
        desconectarBD($conexion);

        return $rows;		

    }


    #   Seleccionar un producto en concreto.
        
    function seleccionar_producto ($idProducto) {

        $conexion = conectarBD();

        try {		

            $sql = "SELECT * FROM productos WHERE idProducto = :idProducto";  

            $stmt = $conexion -> prepare($sql);

            $stmt -> bindParam(':idProducto', $idProducto);

            $stmt -> execute();

            $row = $stmt -> fetch(PDO::FETCH_ASSOC);		

        } catch (PDOException $e) {		

            echo "Error: Error al conectarse con la base de datos: ". $e -> getMessage();

            file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e -> getMessage(), FILE_APPEND);

            exit;

        }

        desconectarBD($conexion);

        return $row;		

    }

    #   Seleccionar un usuario en concreto.
    
    function seleccionar_usuario ($email) {

        $conexion = conectarBD();

        try {		

            $sql = "SELECT * FROM usuarios WHERE email = :email";  

            $stmt = $conexion -> prepare($sql);

            $stmt -> bindParam(':email', $email);

            $stmt -> execute();

            $row = $stmt -> fetch(PDO::FETCH_ASSOC);		

        } catch (PDOException $e) {		

            echo "Error: Error al conectarse con la base de datos: ". $e -> getMessage();

            file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e -> getMessage(), FILE_APPEND);

            exit;

        }

        desconectarBD($conexion);

        return $row;		

    }

#   Seleccionar un usuario en concreto V2.

    function seleccionar_usuario2 ($email) {

        $conexion = conectarBD();

        try {		

            $sql = "SELECT * FROM usuarios WHERE email = :email";  

            $stmt = $conexion -> prepare($sql);

            $stmt -> bindParam(':email', $email);

            $stmt -> execute();

            $row = $stmt -> fetchAll(PDO::FETCH_ASSOC);		

        } catch (PDOException $e) {		

            echo "Error: Error al conectarse con la base de datos: ". $e -> getMessage();

            file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e -> getMessage(), FILE_APPEND);

            exit;

        }

        desconectarBD($conexion);

        return $row;		

    }


    #   Añadir un pedido.

    function insertarPedido ($idUsuario, $carrito, $total) {

        $conexion = conectarBD();

        try {		

            $conexion -> beginTransaction();

            $sql = "INSERT INTO pedidos (idUsuario, total) VALUES (:idUsuario, :total)";  

            $stmt = $conexion -> prepare($sql);

            $stmt -> bindParam(':idUsuario', $idUsuario);

            $stmt -> bindParam(':total', $total);

            $stmt -> execute();

            $idPedido = $conexion -> lastInsertId();
            
            foreach ($carrito as $idProducto => $cantidad) {

                $producto = seleccionar_producto($idProducto);  

                $precio = $producto["precioOferta"];

                $sql2 = "INSERT INTO detallespedidos (idPedido, idProducto, cantidad, precio) VALUES (:idPedido, :idProducto, :cantidad, :precio)"; 

                $stmt = $conexion -> prepare($sql2);

                $stmt -> bindParam(':idPedido', $idPedido);
                $stmt -> bindParam(':idProducto', $idProducto);
                $stmt -> bindParam(':cantidad', $cantidad);
                $stmt -> bindParam(':precio', $precio);

                $stmt -> execute();

            }

            $conexion -> commit();

        } catch (PDOException $e) {	
            
            $conexion -> rollback();

            echo "Error: Error al conectarse con la base de datos: ". $e -> getMessage();

            file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e -> getMessage(), FILE_APPEND);

            exit;

        }

        desconectarBD($conexion);

        return $idPedido;	

    }


    #   Seleccionar un pedido en concreto.

    function seleccionar_pedido ($idPedido) {

        $conexion = conectarBD();

        try {

            $sql = "SELECT a.*, b.estado FROM pedidos a, estados b WHERE a.idPedido = :idPedido  AND a.idEstado = b.idEstado";

            $stmt = $conexion -> prepare($sql);

            $stmt -> bindParam(':idPedido', $idPedido);	

            $stmt -> execute();

            $rows = $stmt -> fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {		

            echo "Error: Error al conectarse con la base de datos: ". $e -> getMessage();

            file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e -> getMessage(), FILE_APPEND);

            exit;
                
        }
        
        desconectarBD($conexion);

        return $rows;

    }


    #   Seleccionar los detalles de un pedido. 
    
    function seleccionar_detalles_pedido ($idPedido) {

        $conexion = conectarBD();

        try {

            $sql = "SELECT a.*, b.* FROM detallespedidos a, productos b WHERE idPedido = :idPedido and a.idProducto = b.idProducto";

            $stmt = $conexion -> prepare($sql);

            $stmt -> bindParam(':idPedido', $idPedido);	

            $stmt -> execute();

            $rows = $stmt -> fetchAll(PDO::FETCH_ASSOC);	

        } catch (PDOException $e) {		

            echo "Error: Error al conectarse con la base de datos: ". $e -> getMessage();

            file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e -> getMessage(), FILE_APPEND);

            exit;
                
        }
        
        desconectarBD($conexion);

        return $rows;

    }


	function editar_usuario ($idUsuario, $email, $nombre, $apellidos, $direccion, $telefono) {

		$conexion = conectarBD();

		try {		

			$sql = "UPDATE usuarios SET email = :email, nombre = :nombre, apellidos = :apellidos, direccion = :direccion, telefono = :telefono WHERE idUsuario = :idUsuario"; 	

			$stmt = $conexion -> prepare($sql);

			$stmt -> bindParam(':idUsuario', $idUsuario);
			$stmt -> bindParam(':email', $email);
			$stmt -> bindParam(':nombre', $nombre);
			$stmt -> bindParam(':apellidos', $apellidos);
			$stmt -> bindParam(':direccion', $direccion);
			$stmt -> bindParam(':telefono', $telefono);

			$stmt -> execute();

		} catch (PDOException $e) {		

			echo "Error: Error al conectarse con la base de datos: ". $e -> getMessage();

			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e -> getMessage(), FILE_APPEND);

			exit;
				
		}

		$numfilas = $stmt -> rowCount();

		desconectarBD($conexion);

		return $numfilas;	

    }


	function cambiarPassword ($idUsuario, $passwordNew1) {

		$conexion = conectarBD();
		
		try {
			
			$sql = "UPDATE usuarios SET password = :passwordNew1 WHERE idUsuario = :idUsuario";	

			$stmt = $conexion -> prepare($sql);			

			$stmt -> bindParam(':idUsuario', $idUsuario);
			
			$passwordNew1 = password_hash($passwordNew1, PASSWORD_BCRYPT);

			$stmt -> bindParam(':passwordNew1', $passwordNew1);

			$stmt -> execute();
			
		} catch (PDOException $e) {		
			
			echo "Error: Error al conectarse con la base de datos: ". $e -> getMessage();

			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e -> getMessage(), FILE_APPEND);

			exit;
				
		}
		
		$numfilas = $stmt -> rowCount();

		desconectarBD($conexion);

		return $numfilas;	
		
	}

?>
