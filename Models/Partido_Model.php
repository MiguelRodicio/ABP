<?php
/**
 * Created by PhpStorm.
 * User: migui
 * Date: 02/11/2019
 * Time: 22:55
 */
class Partido_Model{

    var $id_partido;
    var $fecha_partido;
    var $hora_partido;
    var $id_pista;
    var $mysqli;

    /**
     * Partido_Model constructor.
     * @param $id_partido
     * @param $fecha_partido
     * @param $id_pista
     */
    public function __construct($id_partido, $fecha_partido, $id_pista, $hora_partido)
    {
        $this->id_partido = $id_partido;
        $this->fecha_partido = $fecha_partido;
        $this->id_pista = $id_pista;
        $this->hora_partido = $hora_partido;

    }

    function Search(){
        $sql = "select ID_PARTIDO,FECHA_PARTIDO,HORA_PARTIDO,ID_PISTA
                from PARTIDO
                where ID_PARTIDO LIKE '%$this->id_partido%') &&
                    FECHA_PARTIDO LIKE '%$this->fecha_partido%') &&
                    ID_PISTA LIKE '%$this->id_pista%') &&
					HORA_PARTIDO LIKE '%$this->hora_partido%')";

					if ( !( $resultado = $this->mysqli->query( $sql ) ) ) {
			return 'Error en la consulta sobre la base de datos';
		} else { // si la busqueda es correcta devolvemos el recordset resultado

			return $resultado;
		}
	}


    function ADD() {
        if ( ( $this->id_partido <> '' ) ) { // si el atributo clave de la entidad no esta vacio

            // construimos el sql para buscar esa clave en la tabla
            $sql = "SELECT * FROM partido WHERE (  ID_PARTIDO = '$this->id_partido')";

            if ( !$result = $this->mysqli->query( $sql ) ) {
                return 'No se ha podido conectar con la base de datos';
            } else {
                if ( $result->num_rows != 0 ) {
                    return 'Ya existe ese partido en la base de datos';

                } else {

                    $sql = "INSERT INTO partido (
                                ID_PARTIDO,
								FECHA_PARTIDO,
								HORA_PARTIDO
                                 ) 
								VALUES(
                                '$this->id_partido',
                                '$this->fecha_partido',
                                '$this->hora_partido'
								)";
                    /*include_once '../Models/USU_GRUPO_MODEL.php';//incluimos el modelo USU_GRUPO
                    $USU_GRUPO = new USU_GRUPO($this->login,'00001A');//instanciamos un objeto del modelo USU_GRUPO donde metemos un  usuario en el grupo alumnos
                    $mensaje = $USU_GRUPO->ADD();//insertamos el login en el grupo alumnos*/

                    //var_dump($sql);
                    // exit;
                    if ( !$this->mysqli->query( $sql )) { // si da error en la ejecución del insert devolvemos mensaje
                        return 'Error en la inserción';
                    } else { //si no da error en la insercion devolvemos mensaje de exito

                        /*if($mensaje == 'Inserción realizada con éxito'){//miramos si la inserción en USU_GRUPO tuvo exito
                            return 'Inserción realizada con éxito'; //operacion de insertado correcta
                        }else{//si la insercion no tuvo exito
                            return $mensaje;
                        }*/
                        return 'Insercion realizada con exito';

                    }

                }

            }
        } else { // si el atributo clave de la bd es vacio solicitamos un valor en un mensaje
            return 'Introduzca un valor'; // introduzca un valor para el usuario
        }

    }

    function DELETE() {
        // se construye la sentencia sql de busqueda con los atributos de la clase
        $sql = "SELECT * FROM partido WHERE (ID_PARTIDO = '$this->id_partido')";
        // se ejecuta la query
        $result = $this->mysqli->query( $sql );


        if ( $result->num_rows == 1 ) {// si existe una tupla con ese valor de clave
            // se construye la sentencia sql de borrado
            $sql = "DELETE FROM partido WHERE (ID_PARTIDO = '$this->id_partido' )";
            // se ejecuta la query
            $this->mysqli->query( $sql );
            // se devuelve el mensaje de borrado correcto
            return "Borrado correctamente";
        } // si no existe el login a borrar se devuelve el mensaje de que no existe
        else
            return "No existe";
    } // fin metodo DELETE


    


}