<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\DriverManager;



class DefaultController extends Controller
{
    /**
     * @Route("/{page}", name="homepage" ,defaults={"page"="index"})
     */
    public function indexAction(Request $request,$page="index")
    {


        // replace this example code with whatever you need
        return $this->render('default/'.$page.'.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }





    /**
     * @Route("/abonado/{page}", name="abonado" ,defaults={"page"="null"})
     */
    public function abonadoAction(Request $request,$page="index")
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

        if($page == "listado"){

            $abonados = $this->getAbonados();//$this->getInstanciaConexion();//$this->getAbonados();

            return $this->render(sprintf('default/%s.html.twig', "abonado_list"),
                            array("abonados" => $abonados,"debug"=>$abonados)); 
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
        $rsm->addFieldResult('a', 'telefono', 'telefono');
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
     * @param string                           $zona           Nombre de la zona
     *
     * @return array|null 
     */

    public  function getLocalidades($zona=""){

        $em = $this->getDoctrine()->getManager();
        $rsm = new ResultSetMapping();
        $rsm->addEntityResult('AppBundle:Localidad',  'l');
        $rsm->addFieldResult('l', 'idLocalidad',     'idlocalidad');
        $rsm->addFieldResult('l', 'nombreLocalidad', 'nombrelocalidad');
        $rsm->addFieldResult('l', 'codigoPostal',    'codigopostal');
        $rsm->addFieldResult('l', 'idZona',      'idzona');
        $rsm->addJoinedEntityResult('AppBundle:Zona' , 'z', 'l', 'idzona');
        $rsm->addFieldResult('z', 'nombreZona', 'nombrezona');

        $sql_localidades = "
                SELECT 
                    l.idLocalidad, l.nombreLocalidad, l.codigoPostal, z.nombre
                    FROM Localidad l
                    INNER JOIN Zona z  ON l.idZona = z.idZona "; //OK

        if($zona !=""){
            $sql_localidades .= " WHERE l.nombreZona = ?";
        }
        $query = $em->createNativeQuery($sql_localidades, $rsm);

        $query->setParameter(1, $zona);

        //Ejecuta y obtiene los resultados
        $localidades = $query->getResult();


        return $localidades;
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
                    c.idConexion, c.idLocalidad , c.direccion,
                    l.nombreLocalidad,
                    v.nombreViaComunicacion
                FROM ReclamosRealizado ra
                INNER JOIN Reclamo   As r ON ra.idReclamo = r.idReclamo
                INNER JOIN Abonado   As a ON ra.idAbonado = a.idAbonado
                INNER JOIN Conexion  As c ON ra.idConexion = c.idConexion
                INNER JOIN Localidad As l ON c.idLocalidad = l.idLocalidad 
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
     *
     * @return array|null 
     */
    public function getHojaDeRuta($fecha=""){

        $em = $this->getDoctrine()->getManager();

        //HojaRuta: idHojaRuta  fechaEmision

        //ConexionEnHojaRuta: idConexion  idHojaRuta

        //Trabajo: idTrabajo   idPrioridad estadoReclamo   idHojaRuta  idTarea

        //Tarea: idTarea    nombreTarea

        $sqlHojaRuta = "
            SELECT 
            h.idHojaRuta , h.fechaEmision,
            ceh.idConexion
            t.idPrioridad , t.estadoReclamo,
            ta.nombreTarea

            FROM HojaRuta h
            INNER JOIN ConexionEnHojaRuta ceh ON h.idHojaRuta = ceh.idHojaRuta 
            INNER JOIN Trabajo t ON h.idHojaRuta = t.idHojaRuta 
            INNER JOIN Tarea ta ON t.idTarea = ta.idTarea";

        if($fecha != ""){
            $sqlHojaRuta .= "";  
        }

        return null;

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
    * Ajax Reservas : Valida si un servicio está disponible para esa fecha y horario.
    *
    * @Route("/ajaxServicios/horarioServicio", name="ajax_diponibilidad_servicio")
    *
    * @param Request $request
    *
    * @return Response
    */
    public function ajaxDisponibilidadServicioAction(Request $request){

      $idServicio = $request->get("id_servicio");

      $horarios = $this->getHorariosServicios();

      $encoders = array(new JsonEncoder());
      $normalizers = array(new ObjectNormalizer());

      $serializer = new Serializer($normalizers, $encoders);

      $jsonHorarios = $serializer->serialize($horarios, 'json');

      return new JsonResponse(array('horarios' => $jsonHabitaciones));  
    }








    /*
        Funciones Auxiliares

    */

    public function getInstanciaConexion(){
        return $this->getDoctrine()->getConnection();

    }

}


