<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\DriverManager;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\JsonResponse;



class DefaultController extends Controller
{
        
    /**
     * @Route("/", name="index" )
     */
    public function indexAction(Request $request, $page="index")
    {

        return $this->render(sprintf('default/%s.html.twig', "index")); 
    }


    /**
     * @Route("/panel", name="homepage" )
     */
    public function panelAction(Request $request, $page="index")
    {

        $estadSist = $this->getEstadisticasSistema();


        return $this->render(sprintf('default/%s.html.twig', "panel_principal"),
                            array("estad"   => $estadSist)); 
    }

    /**
     * @Route("/abonado/{page}", name="abonado" ,defaults={"page"="null"})
     */
    public function abonadoAction(Request $request, $page="index")
    {
        if($page == "nuevo"){

            /* Los servicios disponibles */
            $servicios = $this->getServicios();

            /* Las localidades disponibles*/
            $localidades = $this->getLocalidades();

            return $this->render(sprintf('default/%s.html.twig', "abonado_form"),
                            array("servicios"   => $servicios,
                                  "localidades" => $localidades)); 

        }

        if($page =="guardarNuevo"){

            $params = array();
            $params["apellidoNombre"] = $request->get("inputApellido").",".$request->get("inputNombre");
            $params["dni"] = $request->get("inputDni");
            $params["email"] = $request->get("inputEmail");
            $params["direccion"] = $request->get("inputDireccion");
            
            $params["telefono"] = $request->get("inputTelFijo");
            $params["celular"] = $request->get("inputTelCelular");

            $params["idServicio"] = $request->get("inputServicio");
            $params["direccionInstalacion"] = $request->get("inputDireccionInstalacion");
            $params["idLocalidad"] = $request->get("inputLocalidad");
            $params["fechaInstalacion1"] = \DateTime::createFromFormat("d/ m /Y H:i", $request->get("inputFecha1")); //OK

            $params["fechaInstalacion2"] = \DateTime::createFromFormat("d/ m /Y H:i",$request->get("inputFecha2")); //OK


            $idAbonado = $this->persistirAbonado($params["dni"], $params["apellidoNombre"],$params["direccion"],$params["telefono"],$params["celular"],$params["email"]);

            $idEstadoConexion = 2;//$this->getIdEstadoConexion("nueva");


            $idConexion = $this->persistirConexion($params["direccionInstalacion"],"","",0,$idAbonado,$idEstadoConexion,$params["idServicio"],$params["idLocalidad"]);

            $ViaComunicacion = 1; ////$this->getIdViaComunicacion("nueva"); 

            $this->persistirContrataConexion($idAbonado,$idConexion,$ViaComunicacion,$params["fechaInstalacion1"],$params["fechaInstalacion2"]);

            return $this->render(sprintf('default/%s.html.twig', "abonado_creado"),
                 array("debug" => $idConexion,"idAbonado"=> $idAbonado, "idConexion" => $idConexion , "params" => $request->request->all())); 
        }

        if($page == "listado"){

            $abonados = $this->getAbonados();
            
            /* Los servicios disponibles */
            $servicios = $this->getServicios();

            /* Las localidades disponibles*/
            $localidades = $this->getLocalidades();

            return $this->render(sprintf('default/%s.html.twig', "abonado_list"),
                            array("abonados" => $abonados,"debug"=>$request->get("inputNombre"),
                                "servicios"=>$servicios , "localidades"=>$localidades)); 
        }
        // replace this example code with whatever you need
        return $this->render('default/s'.$page.'.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }


    /**
     * @Route("/reclamo/{page}", name="reclamo" ,defaults={"page"="null"})
     */
    public function reclamoAction(Request $request,$page="index")
    {
        //Un registro en tabla reclamos con, numero , estado PENDIENTE_REVISIÓN, fecha , la descripción y la vía por donde se relizo. Relaciona Abonado con la conexión.
        if($page == "nuevo") {
            //Parametros del nuevo reclamo
            $idAbonado =    $request->get();
            $idConexion =   $request->get();
            $descripcion =  $request->get();
            $via =          $request->get();
            $fecha =        new \DateTime();
            $estado =       "PENDIENTE_REVISIÓN"; //Hacer una clase abstracta como una enumeración

            $conn = $this->getInstanciaConexion();
            $query = $conn->prepare("
                INSERT INTO 
                Reclamo 
                ('descripcion','estadoReclamo') 
                VALUES (:descrip, :estado)");

            $query->bindParam(':descrip', $descrip);
            $query->bindParam(':estado', $estado);

            $query->execute();
            $idReclamo = $conn->lastInsertId();

            $query = $conn->prepare("
                INSERT INTO 
                RealizaReclamo
                ('idAbonado', 'idReclamo', 'idConexion', 'idVia', 'fechaReclamo')
                VALUES (:abonado,:reclamo, :conexion, :via, :fecha)");

            $query->bindParam(':abonado',  $idAbonado);
            $query->bindParam(':reclamo',  $idReclamo);
            $query->bindParam(':conexion', $idConexion);
            $query->bindParam(':via',      $via);
            $query->bindParam(':fecha',    $fecha);

            $result = false;
            if($query->execute()){
                   $resultado = true;
            }
            return $this->render(sprintf('default/%s.html.twig', "reclamo_result"),
                            array("resultado" => $resultado)); 
        }
        if($page == "listado"){

            $reclamos = $this->getReclamos();

            $arrayClassRow = array("CERRADO" => "success", "PENDIENTE" => "warning" , "PENDIENTE DE REVISION" => "danger");



            return $this->render(sprintf('default/%s.html.twig', "reclamo_list"),
                            array("reclamos" => $reclamos, "classRow" => $arrayClassRow)); 


        }
        return null;
    }



    /**
     * @Route("/hojaRuta/{page}", name="hojaRuta" ,defaults={"page"="null"})
     */
    public function hojaRutaAction(Request $request,$page="index")
    {

        $arrayClassRow = array("BAJA" => "success", "MEDIA" => "warning" , "ALTA" => "danger");
        if($page == "index"){
            $hojasRuta = $this->getHojaDeRuta();
            return $this->render(sprintf('default/%s.html.twig', "hoja_ruta_list"),
                            array("hojasRuta" => $hojasRuta));     
        }

        if($page == "detalle"){

            $idHojaRuta = $request->get("idHojaRuta");

            $hojaRuta =  $this->getHojaDeRuta($idHojaRuta);

            $detalleHoja = $this->getDetalleHojaDeRuta($idHojaRuta);

            return $this->render(sprintf('default/%s.html.twig', "hoja_ruta_detalle"),
                            array("detalleHoja" => $detalleHoja, "hoja"=> $hojaRuta[0],"classRow" => $arrayClassRow));     
        }


    }




    // Funciones para obtener todos los registros de las entidades de la base de datos. 


    //SOLO DE PRUEBA: Consutla sobre actores de la DB SAKILA , para probar
    // el mapeo a objeto de una consulta SQL NATIVA
    public function getActor($id = ""){

        //Conexión a la base de datos
        $em = $this->getDoctrine()->getManager();

        //Mappeo de resultados a objetos, necesario para converir una consulta en
        //SQL nativo y traer los datos como objeto. 
        $rsm = new ResultSetMapping();
        $rsm->addEntityResult('AppBundle:Actor', 'a');
        $rsm->addFieldResult('a', 'actor_id', 'actorId');  
        $rsm->addFieldResult('a', 'first_name', 'firstName');
        $rsm->addFieldResult('a', 'last_name', 'lastName');

        // Los abonados 
        $sql_abonado ='SELECT a.actor_id, a.first_name, a.last_name  FROM actor a';

        // Filtro, si existe.
        if($id != ""){

            $sql_abonado.=' WHERE a.actor_id = ?';
            
        }
        //Preparo la sentencia
        $query = $em->createNativeQuery($sql_abonado, $rsm);
        $query->setParameter(1, $id);

        //Ejecuta y obtiene los resultados
        $abonados = $query->getResult();
        return $abonados;
    }

    /**
     * Devuelve todo los abonados o uno si se especifica el filtro de idAbonado
     *
     * @param interger                           $id           ID del Abonado
     *
     * @return array|null 
     */



    public function getAbonados($id = ""){

        //Conexión a la base de datos
        $em = $this->getDoctrine()->getManager();

        //Mappeo de resultados a objetos, necesario para converir una consulta en
        //SQL nativo y traer los datos como objeto. 
        $rsm = new ResultSetMapping();
        $rsm->addEntityResult('AppBundle:Abonado', 'a');
        $rsm->addFieldResult('a', 'idAbonado', 'idabonado');  
        $rsm->addFieldResult('a', 'dni', 'dni');
        $rsm->addFieldResult('a', 'apellidoNombre', 'apellidonombre');
        $rsm->addFieldResult('a', 'direccion', 'direccion');
        $rsm->addFieldResult('a', 'telefono', 'telefono');
        $rsm->addFieldResult('a', 'celular', 'celular');
        $rsm->addFieldResult('a', 'email', 'email');


        // Los abonados 
        $sql_abonado ='SELECT 
                            a.idAbonado, a.dni, a.apellidoNombre,  
                            a.direccion, a.telefono, a.celular, a.email  
                        FROM Abonado a'; //OK

        // Filtro, si existe.
        if($id != ""){

            $sql_abonado.=' WHERE a.idAbonado = ?';
            
        }
        //Preparo la sentencia
        $query = $em->createNativeQuery($sql_abonado, $rsm);
        $query->setParameter(1, $id);

        //Ejecuta y obtiene los resultados
        $abonados = $query->getResult();
        return $abonados;
    }

    /**
     * Devuelve todo los servicios o uno si se especifica el filtro de tipo
     *
     * @param string                           $tipo           Tipo Servicio
     *
     * @return array|null 
     */
    public function getServicios($tipo=""){

        /* Servicio STD - Plus - Premium : Una sola tabla*/
         $em = $this->getDoctrine()->getManager();

        $sql_servicios = "
            SELECT 
                s.idServicio, s.nombreServicio , s.costo, s.cantCanales,
                s.cantCanalesHD, s.cantCanalesPelicula,s.esPremium, s.esPlus, s.esEstandar 
            FROM Servicio s "; //OK

        $rsm = new ResultSetMapping();
        $rsm->addEntityResult('AppBundle:Servicio', 's');
        $rsm->addFieldResult('s', 'idServicio', 'idservicio');
        $rsm->addFieldResult('s', 'nomServicio', 'nombreservicio');
        $rsm->addFieldResult('s', 'costo', 'costo');
        $rsm->addFieldResult('s', 'cantCanales', 'cantcanales');
        $rsm->addFieldResult('s', 'cantCanalesHD', 'cantcanaleshd');
        $rsm->addFieldResult('s', 'cantCanalesPelicula', 'cantcanalespelicula');
        $rsm->addFieldResult('s', 'esEstandar', 'esestandar');
        $rsm->addFieldResult('s', 'esPlus', 'esplus');
        $rsm->addFieldResult('s', 'esPremium', 'espremium');

        if($tipo !=""){
            $sql_servicios .= " WHERE ";
            switch ($tipo) {
                case "ESTANDAR":
                    $sql_servicios .= " s.esEstandar = 1";
                    break;
                case "PLUS":
                    $sql_servicios .= " s.esPlus = 1";
                    break;
                case "PREMIUM":
                    $sql_servicios .= " s.esPremium = 1";
                    break;
                default:
                    $sql_servicios .= " s.esEstandar = 1";
                    break;
            }
        }
        $query = $em->createNativeQuery($sql_servicios, $rsm);

        //Ejecuta y obtiene los resultados
        return $query->getResult();

    }

    /**
     * Devuelve todas las localidades o filtradas por Zona 
     *
     * @param string                           $zona           Id de la zona
     *
     * @return array|null 
     */

    public  function getLocalidades($idZona=""){

        $conn = $this->getInstanciaConexion();

        $sql_localidades = "
                SELECT 
                    l.idLocalidad, l.nombreLocalidad, l.codigoPostal, z.nombreZona
                FROM Localidad l
                INNER JOIN Zona z  ON l.idZona = z.idZona "; //OK

        if($idZona !=""){
            $sql_localidades .= " WHERE l.idZona = :zona";
        }
        
        $query = $conn->prepare($sql_localidades);
        $query->bindParam(':zona',$idZona);
        $query->execute();
        return $query->fetchAll();
        
    }

    /**
     * Devuelve todo los reclamos o uno si se especifica el filtro de estado y/o un abonado
     *
     * @param string                           $estado           estado de Reclamo
     * @param integer                          $idAbonado        ID del Abonado
     *
     * @return array|null 
     */

    public function getReclamos($estado="",$idAbonado=""){

        $params = array();

        /*
        Para los Join no vamos a usar el Resulset debido a que confunde mucho y demanda 
        mucha atención con la implementacion. 
        Usaremos directamente el el driver PDO que Doctrine ya instanció.


        $em = $this->getDoctrine()->getManager();
        $rsm = new ResultSetMapping();
        $rsm->addEntityResult('AppBundle:Reclamosrealizado',  'ra');
        $rsm->addFieldResult('ra', 'idConexion', 'idconexion');
        $rsm->addFieldResult('ra', 'idViaComunicacion', 'idviacomunicacion');
        $rsm->addFieldResult('ra', 'fechaReclamo', 'fechareclamo');
        $rsm->addFieldResult('ra', 'idReclamo', 'idreclamo');

        $rsm->addJoinedEntityResult('AppBundle:Reclamo' , 'r', 'ra', 'idreclamo');
        $rsm->addFieldResult('r', 'idReclamo',     'idreclamo');
        $rsm->addFieldResult('r', 'descripcion',   'descripcion');
        $rsm->addFieldResult('r', 'estadoReclamo', 'estadoreclamo');

        $rsm->addJoinedEntityResult('AppBundle:Abonado' , 'a', 'ra', 'idabonado');
        $rsm->addFieldResult('a', 'idAbonado', 'idabonado');
        $rsm->addFieldResult('a', 'apeNom', 'apellidonombre');
        $rsm->addFieldResult('a', 'email', 'email');

        $rsm->addJoinedEntityResult('AppBundle:Conexion' , 'c', 'ra', 'idconexion');
        $rsm->addFieldResult('c', 'idConexion', 'idconexion');
        $rsm->addFieldResult('c', 'idLocalidad', 'idlocalidad');

        $rsm->addJoinedEntityResult('AppBundle:Localidad' , 'l', 'c', 'idlocalidad');
        $rsm->addFieldResult('l', 'nombreLocalidad', 'nombrelocalidad');
        */

        $conn = $this->getInstanciaConexion();


        // Consulta reclamos
        $sql_reclamos= "
                SELECT 
                    r.idReclamo , r.descripcion , r.estadoReclamo,
                    ra.idConexion , ra.idViaComunicacion, ra.fechaReclamo,
                    a.idAbonado, a.apellidoNombre, a.email,
                    c.idConexion, c.idLocalidad , c.direccion , c.esMoroso ,
                    s.nombreServicio,
                    l.nombreLocalidad,
                    v.nombreViaComunicacion,
                    z.nombreZona
                FROM ReclamosRealizado ra
                INNER JOIN Reclamo   As r ON ra.idReclamo = r.idReclamo 
                INNER JOIN Abonado   As a ON ra.idAbonado = a.idAbonado 
                INNER JOIN Conexion  As c ON ra.idConexion = c.idConexion 
                INNER JOIN Servicio AS s ON c.idServicio = s.idServicio 
                INNER JOIN Localidad As l ON c.idLocalidad = l.idLocalidad 
                INNER JOIN Zona AS z ON l.idZona = z.idZona 
                INNER JOIN ViaComunicacion As v ON ra.idViaComunicacion = v.idViaComunicacion "; //OK


        // Filtros
        if($estado !="" || $idAbonado != ""){

            $sql_reclamos .= " WHERE ";

            if($estado !=""){
                $sql_reclamos .= " r.estadoReclamo = :estado";
                array_push($params, array('estado' =>  $estado));
            }
            
            if($idAbonado != ""){
                $sql_reclamos .= ($estado!="")? " AND  " :"";
                $sql_reclamos .= "a.idAbonado = :abonado";
                array_push($params, array('abonado' =>  $idAbonado));
            }
        }

        $query = $conn->prepare($sql_reclamos);
        //$query = $em->createNativeQuery($sql_reclamos, $rsm);

        //$query->setParameter($params);

        //return $query->getResult();
        $query->execute();
        return $query->fetchAll();
    }

    /**
     * Devuelve las zonas o filtra las zonas a la que pertence la localidad
     *
     * @param int                           $idLocalidad         Localidad buscada
     *
     * @return array|null 
     */

    public function getZona($idLocalidad=""){

        $em = $this->getDoctrine()->getManager();

        //nombreZona
        $sql_zonas = "
            SELECT z.nombre
            FROM ZONA ";

        $query = $em->createNativeQuery($sql_reclamos, $rsm);

        return $query->getResult();   
    }

    /**
     * Devuelve las conexiones de un abonado, filtrado por estado y/o morosidad
     *
     * @param integer                          $idAbonado        ID del Abonado
     * @param string                           $nombreEstado     nombreEstado Conexion
     * @param boolean                          $esMoroso         
     *
     * @return array|null 
     */

    public function getConexiones($idAbonado , $estado = "", $esMoroso=""){
        //idConexion  direccion   fechaInstalacionReal    coordenadas esMoroso    nombreEstado    idServicio  idLocalidad idAbonado
        $em = $this->getDoctrine()->getManager();

        $params = array("abonado" => $idAbonado);

        $sql_conexiones = "
                SELECT *
                FROM Conexion c
                WHERE c.idAbonado =:abonado"; //OK

        if($estado !=""){
            $sql_conexiones .= " AND c.nombreEstado = :estadoConexion ";
            array_push($params, array("estadoConexion" => $estado));
        }
        if($estadoCuenta !=""){
            $sql_conexiones .= " AND c.esMoroso = :esMoroso ";   
            array_push($params, array("esMoroso" => $esMoroso));
        }
        
        $query = $em->createNativeQuery($sql_conexiones, $rsm);

        $query->setParameter($params);

        return $query->getResult();
    }

    /**
     * Devuelve el/los equipo/s tecnico/s, filtrado por zona
     *
     * @param string                           $zona            Nombre de la zona
     *
     * @return array|null 
     */
    public function getEquipoTecnico($zona = ""){
        $em = $this->getDoctrine()->getManager();
        return null;
    }



    /**
     * Devuelve la hoja de ruta, con las conexiones asocidas, el trabajo a realizar
     * y la descripcion de la tarea.
     *
     * @param string                           $fecha           Format:("dd/mm/yyyy")
     * @param string                           $fecha           Format:("dd/mm/yyyy")
     *
     * @return array|null 
     */
    public function getHojaDeRuta($id="", $fecha=""){

        $conn = $this->getInstanciaConexion();

        $sql_hoja = "SELECT h.idHojaRuta, h.fechaEmision 
                    FROM HojaRuta AS h";

        if($id != ""){
            $sql_hoja.=" WHERE h.idHojaRuta = $id";
        }

        $query = $conn->prepare($sql_hoja);
        $query->execute();
        $query->bindValue("id",$id);
        $query->bindValue("fecha",$fecha);
        return $query->fetchAll();

    }


    /**
     * Devuelve la hoja de ruta, con las conexiones asocidas, el trabajo a realizar
     * y la descripcion de la tarea.
     *
     * @param int                           $id             El id de laHoja de Ruta
     *
     * @return array|null 
     */
    public function getDetalleHojaDeRuta($id=""){

        //HojaRuta: idHojaRuta  fechaEmision

        //ConexionEnHojaRuta: idConexion  idHojaRuta

        //Trabajo: idTrabajo   idPrioridad estadoReclamo   idHojaRuta  idTarea

        //Tarea: idTarea    nombreTarea

        $conn = $this->getInstanciaConexion();

        $sqlHojaRuta = "
            SELECT 
                h.idHojaRuta,
                h.fechaEmision,
                t.idTrabajo,
                c.idConexion , 
                t.estadoTrabajo, t.idPrioridadTrabajo , 
                rt.fechaTrabajo,
                et.idEquipoTecnico,
                i.nombreInsumo,
                p.nombrePrioridad,
                a.apellidoNombre,
                z.nombreZona


            FROM HojaRuta AS h
            INNER JOIN ConexionEnHojaRuta AS ch ON h.idHojaRuta = ch.idHojaRuta
            INNER JOIN Conexion c  ON  c.idConexion = ch.idConexion
            INNER JOIN Localidad l ON c.idLocalidad = l.idLocalidad
            INNER JOIN Zona z ON l.idZona = z.idZona 
            INNER JOIN Trabajo  t  ON t.idHojaRuta = h.idHojaRuta
            INNER JOIN TrabajoRealizado rt  ON  rt.idTrabajo = t.idTrabajo 
            INNER JOIN EquipoTecnico et  ON  et.idEquipoTecnico = rt.idEquipoTecnico
            INNER JOIN Insumo i  ON  i.idInsumo = rt.idInsumo
            INNER JOIN PrioridadTrabajo p ON p.idPrioridadTrabajo = t.idPrioridadTrabajo
            INNER JOIN Abonado a ON a.idAbonado = c.idAbonado
            WHERE h.idHojaRuta= :id";


        $query = $conn->prepare($sqlHojaRuta);
        $query->bindValue("id",$id);
        $query ->execute();

        return $query->fetchAll();

    }

    /**
     * Devuelve las tareas realiazas en un trabajo especificado por parametro
     * @param int                           $id             El id de Trabajo
     *
     * @return array|null 
     */
    public function getTareaPorTrabajo($idTrabajo){

        $conn = $this->getInstanciaConexion();

        $sql_trabajos_por_tarea = "SELECT 
                            t.idTrabajo,
                            ta.nombreTarea
                        FROM TareaPorTrabajo tpt
                        INNER JOIN Trabajo t ON tpt.idTrabajo = t.idTrabajo
                        INNER JOIN Tarea ta ON tpt.idTarea = ta.idTarea
                        WHERE tpt.idTrabajo = :idTrabajo";

        $query = $conn->prepare($sql_trabajos_por_tarea);
        $query->bindValue("idTrabajo",$idTrabajo);
        $query ->execute();

        return $query->fetchAll();
    }

    /**
     * Persiste en DB un Aboando nuevo
     *
     * @param integer                         $dni    
     * @param string                          $apellidoNombre    Apellido y nombre concatenados por una coma
     * @param string                          $direccion         Direccion el Abonado
     * @param string                          $telefono          Telefono fijo del Abonado
     * @param string                          $celular           Telefono celular del Abonado
     * @param string                          $email             Corre Electronico del Abonado
     *
     * @return integer|null       El ID asigando al Abonado
     */


    public function persistirAbonado($dni,$apellidoNombre,$direccion,$telefono,$celular,$email ){
        
        $sql_nuevo_abonado = "INSERT INTO 
                            Abonado
                               (dni,apellidoNombre,direccion,telefono,celular,email) 
                            VALUES
                                ($dni,'$apellidoNombre','$direccion','$telefono','$celular','$email')";

        $conn = $this->getInstanciaConexion();
        $query = $conn->prepare($sql_nuevo_abonado);
        $query->execute();
        return  $conn->lastInsertId();
    }

    /**
     * Persiste en DB una Conexion nuevo
     *
     * @param string                          $direccion        Dirreccion de instalacion solicitada
     * @param DateTime                        $fechaReal        Fecha en que se ha concretado la instalcion
     * @param string                          $coord            Coordenadas para geoLocalizacion
     * @param integer                         $esMoroso         1: Moroso , 0: No moroso
     * @param integer                         $idAbonado             
     * @param integer                         $idEstadoConexion      
     * @param integer                         $idServicio            
     * @param integer                         $idLocalidad           
     *
     * @return integer|null       El ID asigando a la conexion
     */

    public function persistirConexion($direccion,$fechaReal,$coord,$esMoroso,$idAbonado,$idEstadoConexion,$idServicio,$idLocalidad){

        $sql_nueva_conexion = "INSERT INTO
                        Conexion 
                        (direccion,fechaInstalacionReal,coordenadas, esMoroso, idAbonado, idEstadoConexion,idServicio, idLocalidad)
                        VALUES 
                        ('$direccion', NULL, NULL, $esMoroso, $idAbonado, $idEstadoConexion,$idServicio,$idLocalidad)";

        $conn = $this->getInstanciaConexion();
        $query = $conn->prepare($sql_nueva_conexion);
        $query->execute();
        return $conn->lastInsertId();
    }

    /**
     * Persiste en DB un Contrato de Conexion nuevo
     *
     * @param integer                         $idAbonado             
     * @param integer                         $idConexion             
     * @param integer                         $idViaComunicacion
     * @param DateTime                        $fechaIntalacion1        
     * @param DateTime                        $fechaIntalacion1
     *
     * @return true|false       
     */

    public function persistirContrataConexion($idAbonado, $idConexion, $idViaComunicacion,$fechaInstalacion1,$fechaInstalacion2){

        $fechaInstalacion1 = date_format($fechaInstalacion1,"Y-m-d H:i:s");
        $fechaInstalacion2 = date_format($fechaInstalacion2,"Y-m-d H:i:s");

        $sql_contra_conexion = "INSERT INTO
                        ContrataConexion 
                        (idAbonado,idConexion,idViaComunicacion,fechaInstalacion1,fechaInstalacion2) 
                        VALUES 
                        ($idAbonado, $idConexion, $idViaComunicacion, '$fechaInstalacion1','$fechaInstalacion2')";

        $conn = $this->getInstanciaConexion();
        $query = $conn->prepare($sql_contra_conexion);
        return  $query->execute();

    }

    /**
     * Obtiene la cantida de Abonados, Conexiones, Reclamos y Hojas de ruta
     *
     * @return array 
     */

    public function getEstadisticasSistema(){

        
        $conn = $this->getInstanciaConexion();
        $sql_count_abonado = 'SELECT Count(*) FROM Abonado ';
        $queryAbonado = $conn->prepare($sql_count_abonado);
        $queryAbonado->execute();
        $cantAbonados= $queryAbonado->fetchColumn();

        $sql_count_conexion = " SELECT COUNT(*) FROM Conexion";
        $queryConexion = $conn->prepare($sql_count_conexion);
        $queryConexion->execute();
        $cantConexion= $queryConexion->fetchColumn();


        $sql_count_hoja_ruta = " SELECT COUNT(*) FROM HojaRuta";
        $queryHojaRuta = $conn->prepare($sql_count_hoja_ruta);
        $queryHojaRuta->execute();
        $cantHojaRuta= $queryHojaRuta->fetchColumn();

        $sql_count_reclamo = " SELECT COUNT(*) FROM Reclamo";
        $queryReclamo = $conn->prepare($sql_count_reclamo);        
        $queryReclamo->execute();
        $cantReclamo = $queryReclamo->fetchColumn();

        $estadisticas = array("abonados"=>$cantAbonados,"conexiones"=>$cantConexion,
                              "hojasRuta"=>$cantHojaRuta,"reclamos"=>$cantReclamo);

        return $estadisticas;

    }


    // Funciones Ajax para consulta en linea a la base 

    /**
    * Ajax Abonado
    *
    * @Route("/ajaxServicios/abonadoExistente", name="ajax_abonado_existente")
    *
    * @param Request $request
    *
    * @return Response
    */

    public function ajaxAbonadoExistente(Request $request){
        $idAbonado = $request->get("dni_abonado");

        if($this->getAbonados($idAbonado)){
            return new JsonResponse(array('existeAbonado' => "true"));
        }
        return new JsonResponse(array('existeAbonado' => "false"));

    }

    /**
    * Ajax Conexiones de Abonado
    *
    * @Route("/ajaxServicios/abonadoConexiones", name="ajax_abonado_conexiones")
    *
    * @param Request $request
    *
    * @return Response
    */

    public function ajaxAbonadoConexiones(Request $request){

        $idAbonado = $request->get("dni_abonado");

        if($this->getConexiones($idAbonado)){
            $conexiones = $this->getConexiones($idAbonado);
            
            return new JsonResponse(array('existeConexion' => "true"));
        }

        return new JsonResponse(array('existeConexion' => "false"));

    }

    /**
    * Ajax Reclamo
    *
    * @Route("/ajaxServicios/reclamoNuevo", name="ajax_reclamo_nuevo")
    *
    * @param Request $request
    *
    * @return Response
    */

    public function ajaxReclamoNuevo(Request $request){


            //Parametros del nuevo reclamo
            $idAbonado =    $request->get();
            $idConexion =   $request->get();
            $descripcion =  $request->get();
            $via =          $request->get();
            $fecha =        new \DateTime();
            $estado =       "PENDIENTE_REVISION"; //Hacer una clase abstracta como una enumeración


            $conn = $this->getInstanciaConexion();
            $query = $conn->prepare("
                INSERT INTO 
                Reclamo 
                ('descripcion','estadoReclamo') 
                VALUES (:descrip, :estado)");

            $query->bindParam(':descrip', $descrip);
            $query->bindParam(':estado', $estado);

            $query->execute();
            $idReclamo = $conn->lastInsertId();

            $query = $conn->prepare("
                INSERT INTO 
                RealizaReclamo
                ('idAbonado', 'idReclamo', 'idConexion', 'idVia', 'fechaReclamo')
                VALUES (:abonado,:reclamo, :conexion, :via, :fecha)");

            $query->bindParam(':abonado',  $idAbonado);
            $query->bindParam(':reclamo',  $idReclamo);
            $query->bindParam(':conexion', $idConexion);
            $query->bindParam(':via',      $via);
            $query->bindParam(':fecha',    $fecha);

            if($query->execute()){
                return new JsonResponse(array('result' => "true"));
            }
            return new JsonResponse(array('result' => "false"));

    }

   
    /**
    * Ajax Tareas en Trabajo : 
    *
    * @Route("/ajaxServicios/tareasEnTrabajo", name="ajax_tareas_trabajo")
    *
    * @param Request $request
    *
    * @return Response
    */
    public function ajaxTareasTrabajoAction(Request $request){

      $idTrabajo= $request->get("idTrabajo");

      $tareas = $this->getTareaPorTrabajo($idTrabajo);

      $encoders = array(new JsonEncoder());
      $normalizers = array(new ObjectNormalizer());

      $serializer = new Serializer($normalizers, $encoders);

      $jsonTareas = $serializer->serialize($tareas, 'json');

      return new JsonResponse(array('Tareas' => $jsonTareas));  
    }


    /*
        Funciones Auxiliares

    */

    public function getInstanciaConexion(){
        return $this->getDoctrine()->getConnection();

    }

}


